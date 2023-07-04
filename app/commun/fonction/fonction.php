<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function verifier_info($info): bool
{
	return (isset($info) and !empty($info));
}

/*********Cette fonction permet de connecter à la base de données */
function connect_db()
{

	$db = null;

	try {
		$db = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8', DATABASE_USERNAME, DATABASE_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (\Exception $e) {
		$db = "Oups! Une erreur s'est produite lors de la connexion a la base de donnée.";
	}

	return $db;
}

/**
 * Cette fonction permet de verifier si un utilisateur dans la base de donnée ne possède pas cette adresse mail.
 * @param string $email L'email a vérifié.
 *
 * @return bool $check
 */
function check_email_exist_in_db(string $email)
{

	$check = false;

	$db = connect_db();

	$requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE email = :email and est_supprimer = :est_supprimer";

	$verifier_email = $db->prepare($requette);

	$resultat = $verifier_email->execute([
		'email' => $email,
		'est_supprimer' => 0,
	]);

	if ($resultat) {

		$nbr_utilisateur = $verifier_email->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

		$check = ($nbr_utilisateur > 0) ? true : false;
	}

	return $check;
}

/**
 * Cette fonction permet de verifier si un utilisateur dans la base de donnée ne possède pas ce nom d'utilisateur.
 * @param string $nom_utilisateur Le nom d'utilisateur a vérifié.
 *
 * @return bool $check
 */
function check_user_name_exist_in_db(string $nom_utilisateur)
{

	$check = false;

	$db = connect_db();

	$requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur and est_supprimer = :est_supprimer";

	$verifier_nom_utilisateur = $db->prepare($requette);

	$resultat = $verifier_nom_utilisateur->execute([
		'nom_utilisateur' => $nom_utilisateur,
		'est_supprimer' => 0,
	]);

	if ($resultat) {

		$nbr_utilisateur = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

		$check = ($nbr_utilisateur > 0) ? true : false;
	}

	return $check;
}


/**
 * .3++++++
 *
 * Send mail.
 *
 * @param string $destination The destination.
 * @param string $subject The subject.
 * @param string $body The body.
 * @return bool The result.
 */
function send_email(string $destination, string $subject, string $body): bool
{
	// passing true in constructor enables exceptions in PHPMailer
	$mail = new PHPMailer(true);
	$mail->CharSet = "UTF-8";

	try {

		// Server settings
		// for detailed debug output
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;

		$mail->Username = MAIL_ADDRESS;
		$mail->Password = MAIL_PASSWORD;

		// Sender and recipient settings
		$mail->setFrom('akaisukibibliotheque@gmail.com', htmlspecialchars_decode('Bibliotheque AKAITSUKI'));
		$mail->addAddress($destination, 'UTILISATEUR');
		$mail->addReplyTo('akaisukibibliotheque@gmail.com', htmlspecialchars_decode('Bibliotheque AKAITSUKI'));

		// Setting the email content
		$mail->IsHTML(true);
		$mail->Subject = htmlspecialchars_decode($subject);
		$mail->Body = $body;

		return $mail->send();
	} catch (Exception $e) {
		return false;
	}
}

//Fonction buffer pour récupérer du html

function buffer_html_file($filename)
{
	ob_start(); //démarre la temporisation de sortie

	include $filename; //Inclut des fichier html dans le tampon

	$html = ob_get_contents(); // Récupère le contenu du tampon
	ob_end_clean(); // Arrête et vide la tamporisation de sortie

	return $html; // Retourne le contenu du fichier html
}


/** 
 * Cette fonction permet de générer un token pour la validation du compte en fonction de l'id de l'utilsateur 

 * @param int $user_id
 * @param string $type
 * @param string $token
 *@return bool $insertion_token
 */

function insertion_token(int $user_id, string $type, string $token): bool
{

	$insertion_token = false;

	$db = connect_db();

	$request = "INSERT INTO token (user_id, type, token) VALUES (:user_id, :type, :token)";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute(
		[
			'user_id' => $user_id,
			'type' => $type,
			'token' => $token
		]
	);

	if ($request_execution) {

		$insertion_token = true;
	}

	return $insertion_token;
}


/** 
 * Cette fonction permet de recupérer le token générer un token pour la validation du compte en fonction de l'id de l'utilsateur 

 * @param int $user_id
 *@return bool $token
 */
function recuperer_token(string $user_id)
{
	$token = [];

	$db = connect_db();

	$request = "SELECT token FROM token WHERE user_id=:user_id";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute([
		'user_id' => $user_id
	]);

	if ($request_execution) {

		$data = $request_prepare->fetchAll(PDO::FETCH_ASSOC);

		if (isset($data) && !empty($data) && is_array($data)) {
			$token = $data;
		}
	}
	return $token;
}

/**
 * Cette fonction permet de récupérer l'id de l'utilisateur grace a son adresse mail.
 *
 * @param string $email L'email de l'utilisateur.
 * @return int $user_id L'id de l'utilisateur.
 */
function recuperer_id_utilisateur_par_son_mail(string $email): int
{

	$user_id = 0;

	$db = connect_db();

	if (is_object($db)) {

		$request = "SELECT id FROM utilisateur WHERE email=:email";

		$request_prepare = $db->prepare($request);

		$request_execution = $request_prepare->execute([
			'email' => $email
		]);

		if ($request_execution) {
			$data = $request_prepare->fetch(PDO::FETCH_ASSOC);
			if (isset($data) && !empty($data) && is_array($data)) {
				$user_id = $data["id"];
			}
		}
	}
	return $user_id;
}

/**
 * Cette fonction permet de verifier si le id_utilisateur existe dans la table token dans la base de donnée .
 * @param string $nom_utilisateur Le nom d'utilisateur a vérifié.
 *
 * @return bool $check
 */
function check_token_exist(int $user_id, string $token, string $type, int $est_actif = 1, int $est_supprimer = 0): bool
{

	$check = false;

	$db = connect_db();

	if (is_object($db)) {

		$requette = "SELECT * FROM token WHERE user_id = :user_id and token= :token and type= :type and est_actif= :est_actif and $est_supprimer= :est_supprimer";

		$verifier_id_utilisateur = $db->prepare($requette);

		$resultat = $verifier_id_utilisateur->execute([
			'user_id' => $user_id,
			'token' => $token,
			'type' => $type,
			'est_actif' => $est_actif,
			'est_supprimer' => $est_supprimer
		]);

		if ($resultat) {

			$data = $verifier_id_utilisateur->fetchAll(PDO::FETCH_ASSOC);

			if (isset($data) && !empty($data) && is_array($data)) {

				$check = true;
			}
		}
	}
	return $check;
}


/** 
 * Cette fonction permet de supprimer le token générer pour la validation du compte en fonction de l'id de l'utilsateur en faisant passé le est_supprimer de la table token à zéro

 * @param int $id_utilisateur l'identifiant de l'utilisateur
 *@return bool $suppression_logique_token
 */

function suppression_logique_token(int $id_utilisateur): bool
{

	$suppression_logique_token = false;

	$date = date("Y-m-d H:i:s");

	$db = connect_db();

	$request = "UPDATE token SET est_actif = :est_actif, est_supprimer = :est_supprimer, maj_le = :maj_le WHERE user_id= :id_utilisateur";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute(
		[
			'id_utilisateur' => $id_utilisateur,
			'est_actif' => 0,
			'est_supprimer' => 1,
			'maj_le' => $date
		]
	);

	if ($request_execution) {

		$suppression_logique_token = true;
	}

	return $suppression_logique_token;
}


/** 
 * Cette fonction permet d'activer le compte de l'utilisateur en faisant passée le est_actif à 1

 * @param int $id_utilisateur identifiant de l'utilisateur
 *@return bool $activation_compte_utilisateur
 */
function activation_compte_utilisateur(int $id_utilisateur): bool
{

	$activation_compte_utilisateur = false;

	$date = date("Y-m-d H:i:s");

	$db = connect_db();

	$request = "UPDATE utilisateur SET est_actif = :est_actif, maj_le = :maj_le WHERE id= :id_utilisateur";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute(
		[
			'id_utilisateur' => $id_utilisateur,
			'est_actif' => 1,
			'maj_le' => $date,

		]
	);

	if ($request_execution) {

		$activation_compte_utilisateur = true;
	}

	return $activation_compte_utilisateur;
}


/**
 * Cette fonction permet de verifier si le id_utilisateur existe dans la base de donnée .
 * @param string $nom_utilisateur Le nom d'utilisateur a vérifié.
 *
 * @return bool $check
 */
function check_id_utilisateur_exist_in_db(int $user_id, string $type, string $token, int $est_actif, int $est_supprimer): bool
{

	$check = false;

	$db = connect_db();

	$requette = "SELECT * FROM token WHERE user_id = :user_id and type= :type and token= :token and est_actif= :est_actif and est_supprimer= :est_supprimer";

	$verifier_id_utilisateur = $db->prepare($requette);

	$resultat = $verifier_id_utilisateur->execute([
		'user_id' => $user_id,
		'type' => $type,
		'token' => $token,
		'est_actif' => $est_actif,
		'est_supprimer' => $est_supprimer
	]);

	if ($resultat) {

		$data = $verifier_id_utilisateur->fetchAll(PDO::FETCH_ASSOC);

		if (isset($data) && !empty($data) && is_array($data)) {

			$check = true;
		}
	}

	return $check;
}

/**
 * Cette fonction permet de verifier si un utilisateur (nom utilisateur + mot de passe) existe dans la base de donnée.
 *
 * @param string $nom_utilisateur Le nom de l'utilisateur.
 * @param string $mot_de_passe Le mot de passe de l'utilisateur.
 * @param string $profil Le profil de l'utilisateur.
 * @param int $est_actif Est-ce que l'utilisateur est actif ou pas.
 *
 * @return array $user Les informations de l'utilisateur.
 */
function check_if_user_exist(string $nom_utilisateur, string $mot_de_passe, string $profil, int $est_actif = 1): array
{

	$user = [];

	$db = connect_db();

	$requette = "SELECT id, nom, prenom, sexe, email, nom_utilisateur, avatar, profil, telephone, adresse, date_naissance FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur and mot_de_passe = :mot_de_passe and profil = :profil and est_actif = :est_actif";

	$verifier_nom_utilisateur = $db->prepare($requette);

	$resultat = $verifier_nom_utilisateur->execute([
		'nom_utilisateur' => $nom_utilisateur,
		'mot_de_passe' => sha1($mot_de_passe),
		'profil' => $profil,
		'est_actif' => $est_actif,
	]);

	if ($resultat) {
		$data = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC);
		if (is_array($data) && !empty($data)){
			$user = $data;
		}
	}
	return $user;
}


/*function check_if_user_connected(): bool
{
	return !empty($_SESSION["utilisateur_connecter"]);
}*/


/**
 *Cette fonction permet de rechercher si le mot de passe existe et appartient à l'utilisateur enregistrer dans la base de donnée 
 * @param string $mot_de_passe Le mot de passe de l'utilisateur.
 * @param int $id l'identifiant de l'utilisateur.
 *
 * @return bool $users .
 */
function check_password_exist(string $mot_de_passe, int $id)
{
	$users = "false";
	$db = connect_db();
	$req = $db->prepare('SELECT id from utilisateur WHERE mot_de_passe=:mot_de_passe AND id=:id');
	$req->execute(array(
		'mot_de_passe' => sha1($mot_de_passe),
		'id' => $id
	));
	$users = $req->fetch();
	if ($users) {
		$users = true;
	}
	return $users;
}

/** 
 *Cette fonction permet de mettre à jour le mot de passe dans le champ mot_de_passe de la table utilisateur dans la base de donnée
 * @param int $id L'id ded l'utilisatuer.
 * @param string $mot_de_passe Le mot de passe de l'utilisateur.
 * @return bool $update_passwordu_in_db.
 */
function update_password_in_db(int $id, string $mot_de_passe)
{
	$update_password = "false";


	$db = connect_db();
	$requete = "UPDATE utilisateur SET mot_de_passe=:mot_de_passe WHERE id= :id";
	$requete_prepare = $db->prepare($requete);
	$requete_execute = $requete_prepare->execute(array(
		'mot_de_passe' => sha1($mot_de_passe),
		'id' => $id
	));

	if ($requete_execute) {
		$update_password = true;
	}
	return $update_password;
}

/**
 * Cette fonction permet de mettre a jour les information de l'utilisateur a partir de son identifiant (id).
 *
 * @param int $id
 * @param string|null $nom
 * @param string|null $prenom
 * @param string|null $sexe
 * @param string|null $date_naissance
 * @param string|null $telephone
 * @param string|null $avatar
 * @param string|null $nom_utilisateur
 * @param string|null $adresse
 *
 * @return bool
 */
function mettre_a_jour_informations_utilisateur(int $id, string $nom = null, string $prenom = null, string $sexe = null, string $date_naissance = null, string $telephone = null, /*string $avatar = null,*/ string $nom_utilisateur = null, string $adresse = null): bool
{
	$mettre_a_jour_informations_utilisateur = false;
	$data = ["id" => $id, "maj_le" => date("Y-m-d H:i:s")];
	$db = connect_db();
	if (is_object($db)) {
		$request = "UPDATE utilisateur SET";
		if (!empty($nom)) {
			$request .= " nom = :nom,";
			$data["nom"] = $nom;
		}

		if (!empty($prenom)) {
			$request .= " prenom = :prenom,";
			$data["prenom"] = $prenom;
		}

		if (!empty($sexe)) {
			$request .= " sexe = :sexe,";
			$data["sexe"] = $sexe;
		}

		if (!empty($date_naissance)) {
			$request .= " date_naissance = :date_naissance,";
			$data["date_naissance"] = $date_naissance;
		}

		if (!empty($telephone)) {
			$request .= " telephone = :telephone,";
			$data["telephone"] = $telephone;
		}

		/*if (!empty($avatar)) {
			$request .= " avatar = :avatar,";
			$data["avatar"] = $avatar;
		}*/

		if (!empty($adresse)) {
			$request .= " adresse = :adresse,";
			$data["adresse"] = $adresse;
		}

		if (!empty($nom_utilisateur)) {
			$request .= " nom_utilisateur = :nom_utilisateur,";
			$data["nom_utilisateur"] = $nom_utilisateur;
		}

		$request .= " maj_le = :maj_le";

		$request .= " WHERE id= :id";

		$request_prepare = $db->prepare($request);

		$request_execution = $request_prepare->execute($data);

		if ($request_execution) {
			$mettre_a_jour_informations_utilisateur = true;
		}
	}

	return $mettre_a_jour_informations_utilisateur;
}


/** 

 *  Cette fonction permet de recuperer les nouvelles infos UTILISATEUR
 *
 * @param  int $id
 * @return array
 */

 function recuperer_mettre_a_jour_informations_utilisateur($id): array
 {
 
	 $recup = [];
 
	 $db = connect_db();
 
	 if (is_object($db)) {
 
		 $request_recupere = $db->prepare('SELECT  id, nom, prenom, sexe, email, telephone, nom_utilisateur, avatar, adresse, date_naissance, profil FROM utilisateur WHERE id= :id');
 
		 $resultat = $request_recupere->execute(array(
			 'id' => $id,
		 ));
 
		 if ($resultat) {
			 $recup = $request_recupere->fetch(PDO::FETCH_ASSOC);
		 }
	 }
 
	 return $recup;
 }

/**
 * Cette fonction permet de désactiver un utilisatreur en faisant passé le est_actif de la table utilisateur à zéro
 * @param int $id l'id de l'utilisateur
 * @return bool $profile_active 
 */
function desactiver_utilisateur(int $id): bool
{

	$profile_active = false;

	$date = date("Y-m-d H:i:s");

	$db = connect_db();

	$request = "UPDATE utilisateur SET  est_actif = :est_actif, maj_le = :maj_le WHERE id= :id";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute(array(
		'id' => $id,
		'est_actif' => 0,
		'maj_le' => $date
	));

	if ($request_execution) {

		$profile_active = true;
	}

	return $profile_active;
}


/**
 * Cette fonction permet de supprimer un utilisateur en faisant passé le est_actif de la table utilisateur à 0 et le est_supprimer à 0
 * @param int $id  l'id de l'utilisateur
 * @return bool $profile_supprimer
 */

function supprimer_utilisateur(int $id): bool
{

	$profile_supprimer = false;

	$date = date("Y-m-d H:i:s");

	$db = connect_db();

	$request = "UPDATE utilisateur SET  est_actif = :est_actif, est_supprimer = :est_supprimer, maj_le = :maj_le WHERE id= :id";

	$request_prepare = $db->prepare($request);

	$request_execution = $request_prepare->execute(array(
		'id' => $id,
		'est_actif' => 0,
		'est_supprimer' => 1,
		'maj_le' => $date
	));
	if ($request_execution) {

		$profile_supprimer = true;
	}

	return $profile_supprimer;
}


/** Cette fonction permet d'inserer un utilisateur de profile MEMBRE
 * @param int $id
 * @return bool
 */
function enregistrer_utilisateur(string $nom, string $prenom, string $email, string $nom_utilisateur, string $mot_de_passe, string $profil = "CLIENT"): bool
{
	$enregistrer_utilisateur = false;

	$db = connect_db();

	if (!is_null($db)) {

		// Ecriture de la requête
		$requette = 'INSERT INTO utilisateur (nom, prenom, email, nom_utilisateur, profil, mot_de_passe) VALUES (:nom, :prenom, :email, :nom_utilisateur, :profil, :mot_de_passe)';

		// Préparation
		$inserer_utilisateur = $db->prepare($requette);

		// Exécution ! La recette est maintenant en base de données
		$resultat = $inserer_utilisateur->execute([
			'nom' => $nom,
			'prenom' => $prenom,
			'email' => $email,
			'nom_utilisateur' => $nom_utilisateur,
			'profil' => $profil,
			'mot_de_passe' => sha1($mot_de_passe)
		]);

		$enregistrer_utilisateur = $resultat;
	}

	return $enregistrer_utilisateur;
}


/**
 * Cette fonction permet d'effectuer la mise à jour de l'avatar de l'utilisateur
 *
 * @param  int $id L'id de l'utilisateur
 * @param  string $avatar La photo de profil
 * @return bool
 */
function mise_a_jour_avatar(int $id, string $avatar): bool
{

	$mise_a_jour_avatar = false;

	$date = date("Y-m-d H:i:s");

	$db = connect_db();

	if (is_object($db)) {

		$request = "UPDATE utilisateur SET avatar = :avatar, maj_le = :maj_le  WHERE id= :id";

		$request_prepare = $db->prepare($request);

		$request_execution = $request_prepare->execute(
			[
				'id' => $id,
				'avatar' => $avatar,
				'maj_le' => $date,
			]
		);

		if ($request_execution) {

			$mise_a_jour_avatar = true;
		}
	}

	return $mise_a_jour_avatar;
}


/**
 * Cett fonction permet de d'ajouter un auteur a la base de données.
 *
 * @param string $nom_auteur Le nom de l'auteur.
 *
 * @return bool $ajout_auteur Le resultat de l'ajout de l'auteur.
 */
function ajout_auteur(string $nom_aut, string $prenom_aut): bool
{

    $ajout_auteur = false;


    if (isset($nom_aut) && !empty($nom_aut) && isset($prenom_aut) && !empty($prenom_aut))   {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO auteur (nom_aut, prenom_aut) VALUES (:nom_aut, :prenom_aut)';

        // Préparation
        $inserer_auteur = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_auteur->execute([
            'nom_aut' => $nom_aut,
			'prenom_aut' => $prenom_aut
        ]);


        if ($resultat) {
            $ajout_auteur = true;
        }

    }

    return $ajout_auteur;

}

/**
 * Cette fonction permet de récupérer la liste des auteurs de la base de donnée.
 *
 * @return array $liste_auteurs La liste des auteurs.
 */
function get_liste_auteurs(): array
{

    $liste_auteurs = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM auteur';

    // Préparation
    $verifier_liste_auteurs = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_auteurs->execute();

    if ($resultat) {

        $liste_auteurs = $verifier_liste_auteurs->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_auteurs;

}


/**
 * Cett fonction permet de modifier un auteur exitant dans la base de données via son numéro d'auteur.
 *
 * @param int $num_auteur Le numéro de l'auteur.
 * @param string $nom_auteur Le nom de l'auteur.
 *
 * @return bool $modifier_auteur Le resultat de l'ajout de l'auteur.
 */
function modifier_auteur(int $num_aut, string $nom_aut, string $prenom_aut): bool
{

    $modifier_auteur = false;
	$date = date("Y-m-d H:i:s");

	if (isset($nom_aut) && !empty($nom_aut) && isset($prenom_aut) && !empty($prenom_aut)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'UPDATE auteur SET nom_aut = :nom_aut, prenom_aut = :prenom_aut, maj_le = :maj_le WHERE num_aut = :num_aut;';

        // Préparation
        $modifier_auteur = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $modifier_auteur->execute([
            'num_aut' => $num_aut,
			'nom_aut' => $nom_aut,
			'prenom_aut' => $prenom_aut,
            'maj_le' => $date
        ]);

        if ($resultat) {

            $modifier_auteur = true;

        }

    }

    return $modifier_auteur;

}


function check_if_auteur_exist(string $nom_aut, string $prenom_aut): bool
{
    $auteur_existe = false;

    $db = connect_db();

    // Écriture de la requête
    $requette = 'SELECT COUNT(*) AS nbr_auteur FROM auteur WHERE nom_aut = :nom_aut AND prenom_aut = :prenom_aut AND est_supprimer = :est_supprimer';

    // Préparation
    $verifier_auteur = $db->prepare($requette);

    // Exécution
    $verifier_auteur->execute([
        'nom_aut' => $nom_aut,
        'prenom_aut' => $prenom_aut,
        'est_supprimer' => 0
    ]);

    $nbr_auteur = $verifier_auteur->fetch(PDO::FETCH_ASSOC)["nbr_auteur"];
    $auteur_existe = ($nbr_auteur > 0);

    return $auteur_existe;
}


/**
 * Cett fonction permet de supprimer  un auteur exitant dans la base de données via son numéro d'auteur.
 *
 * @param string $nom_aut Le nom de l'auteur.
 * @param string $prenom_aut Le prenom de l'auteur.
 *
 * @return bool $modifier_auteur Le resultat de l'ajout de l'auteur.
 */
function delete_auteur(string $nom_aut, string $prenom_aut): bool
{
	$auteur_est_supprimer = false;
    

    // Vérifier si l'auteur existe
    if (isset($nom_aut) && !empty($nom_aut) && isset($prenom_aut) && !empty($prenom_aut)) {
		$db = connect_db();
        // Écriture de la requête
        $requete = 'DELETE FROM auteur WHERE nom_aut = :nom_aut AND prenom_aut = :prenom_aut';

        // Préparation
        $supprimer_auteur = $db->prepare($requete);

        // Exécution
        $resultat = $supprimer_auteur->execute([
            'nom_aut' => $nom_aut,
            'prenom_aut' => $prenom_aut
        ]);

        if ($resultat) {
            $auteur_est_supprimer = true;
    }
}
return $auteur_est_supprimer;
}

   


