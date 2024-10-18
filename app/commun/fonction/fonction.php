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
 * .3++++++
 * 
 *recuperer_donnees_utilisateur

 *Elle permet de récupérer les données de l'utilisateur dans la base de données
 * @param string $email Email de l'utilisateur.
 * @param string $mot_de_passe Mot de passe de l'utilisateur.
 * @param string  $profil Profil de l'utilisateur.
 * @param int $est_actif  Champ est_actif de l'utilisateur.
 * @param int $est_supprimer Champ est_supprimer de l'utilisateur.
 * @return array $data les données de l'utilisateur.
 */
function recuperer_donnees_utilisateur(string $nom_utilisateur, string $mot_de_passe, string $profil, int $est_actif = 1,int $est_supprimer = 0)
{

    $data = [];

    $db = connect_db();

    $requette = "SELECT id, nom, prenom, sexe, email, nom_utilisateur, avatar, profil, telephone, adresse, date_naissance FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur and mot_de_passe = :mot_de_passe and profil = :profil and est_actif = :est_actif and est_supprimer = :est_supprimer ";

    $verifier_nom_utilisateur = $db->prepare($requette);

    $resultat = $verifier_nom_utilisateur->execute([
        'nom_utilisateur' => $nom_utilisateur,
        'mot_de_passe' => sha1($mot_de_passe),
        'profil' => $profil,
        'est_actif' => $est_actif,
        'est_supprimer' => $est_supprimer,
    ]);

    if ($resultat) {
        $data = $verifier_nom_utilisateur->fetch();
    }
    return $data;
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
function mettre_a_jour_informations_utilisateur(int $id, string $nom = null, string $prenom = null, string $sexe = null, string $date_naissance = null, string $telephone = null, string $nom_utilisateur = null, string $adresse = null): bool
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

        if (!empty($adresse)) {
            $request .= " adresse = :adresse,";
            $data["adresse"] = $adresse;
        }

        if (!empty($nom_utilisateur)) {
            $request .= " nom_utilisateur = :nom_utilisateur,";
            $data["nom_utilisateur"] = $nom_utilisateur;
        }

        $request .= " maj_le = :maj_le";
        $request .= " WHERE id = :id";

        $request_prepare = $db->prepare($request);

        $request_execution = $request_prepare->execute($data);

        if ($request_execution) {
            $mettre_a_jour_informations_utilisateur = true;
        }
    }

    return $mettre_a_jour_informations_utilisateur;
}


/**
 * Cette fonction permet de récupérer la mise à jour du profil de l'utilisateur.
 *
 * @param int $id L'identifiant de l'utilisateur.
 * @return array|false Les informations mises à jour de l'utilisateur, ou false en cas d'erreur.
 */
function recup_mettre_a_jour_informations_utilisateur($id)
{
    $db = connect_db();

    $request = $db->prepare('SELECT id, nom, prenom, sexe, date_naissance, email, telephone, nom_utilisateur, avatar, adresse, profil FROM utilisateur WHERE id = :id');

    $result = $request->execute([
        'id' => $id,
    ]);

    if ($result) {
        $data = $request->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    return false;
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


//Fonction pour récupérer l'avatar du profil

/**
 * Cette fonction permet de récupérer la photo du profil .
 * @param int $id l'id de l'utilisateur.
 *
 * @return array $data
 */
function recup_update_avatar($id)
{

    $data="";
    $data_avatar="";

    $db = connect_db();

    $request = $db->prepare('SELECT  avatar FROM utilisateur WHERE id = :id');

    $resultat = $request->execute(array(
        'id' => $id,
    ));

    if ($resultat) {
        $data = $request->fetch(PDO::FETCH_ASSOC);
        
        $data_avatar=implode($data);

    }
    return $data_avatar;
}

/**
* .3++++++
* 
*delete_avatar


*Elle permet de supprimer la photo du champ avatar dans la base de donnée
* @param $id identifiant de l'utilisateur.
* @return bool
*/
function delete_avatar(int $id){
    $delete_avatar=false;
    $db =connect_db();
 
    $req=$db->prepare('UPDATE utilisateur set avatar=:avatar where id = :id ');
    $req_exec=$req->execute(array(
        'id'=>$id,
        'avatar'=>'Non defini'
    ));
 
    if($req_exec){
        $delete_avatar=true;
    }
    return $delete_avatar;
    
 }



/**
 * Cette fonction permet d'ajouter un auteur à la base de données.
 *
 * @param string $nom_aut Le nom de l'auteur.
 * @param string $prenom_aut Le prénom de l'auteur.
 *
 * @return bool $ajout_auteur Le résultat de l'ajout de l'auteur.
 */
function ajout_auteur(string $nom_aut, string $prenom_aut): bool
{
    $ajout_auteur = false;

    if (!empty($nom_aut) && !empty($prenom_aut)) {
        $db = connect_db();

        // Ecriture de la requête
        $requete = 'INSERT INTO auteur (nom_aut, prenom_aut) VALUES (:nom_aut, :prenom_aut)';

        // Préparation
        $inserer_auteur = $db->prepare($requete);

        // Exécution ! L'auteur est maintenant en base de données
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
 * Cette fonction permet de récupérer la liste des auteurs de la base de données
 * ainsi que le nombre total d'auteurs.
 *
 * @return array $result Un tableau contenant la liste des auteurs et le nombre total d'auteurs.
 */
function get_liste_auteurs(): array
{
    $result = array();

    $db = connect_db();

    // Requête pour récupérer la liste des auteurs et leur nombre total
    $requete = 'SELECT *, COUNT(*) AS nombre_total_auteurs FROM auteur';

    // Préparation de la requête
    $stmt = $db->prepare($requete);

    // Exécution de la requête
    $resultat = $stmt->execute();

    if ($resultat) {
        // Récupération des résultats sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result;
}



/**
 * Modifie un auteur dans la base de données.
 *
 * @param int $num_aut Le numéro de l'auteur à modifier.
 * @param string $nom_aut Le nouveau nom de l'auteur.
 * @param string $prenom_aut Le nouveau prénom de l'auteur.
 * @return bool True si la modification a réussi, False sinon.
 */
function modifier_auteur(int $num_aut, string $nom_aut, string $prenom_aut): bool
{
    $modifier = false;
    $date = date("Y-m-d H:i:s");
    $db = connect_db();
    $req_prepare = $db->prepare('UPDATE auteur SET nom_aut = :nom_aut, prenom_aut = :prenom_aut, maj_le = :maj_le WHERE num_aut = :num_aut');
    $req_exec = $req_prepare->execute([
        'nom_aut' => $nom_aut,
        'prenom_aut' => $prenom_aut,
        'maj_le' => $date,
        'num_aut' => $num_aut
    ]);

    if ($req_exec) {
        $modifier = true;
    }
    return $modifier;
}


/**
 * Vérifie si un auteur existe dans la base de données.
 * @param string $nom Nom de l'auteur.
 * @param string $prenom Prénom de l'auteur.
 * @return string|bool Message d'erreur si l'auteur existe, False sinon.
 */
function check_if_auteur_exist(string $nom, string $prenom)
{
    $db = connect_db();
    $req = $db->prepare('SELECT num_aut FROM auteur WHERE nom_aut = ? AND prenom_aut = ?');
    $req_exec = $req->execute([$nom, $prenom]);

    if ($req_exec) {
        $auteur = $req->fetch();
        if ($auteur !== false) {
            return 'Cet auteur existe déjà';
        }
    }

    return false;
}




/**
 * Cett fonction permet de supprimer  un auteur exitant dans la base de données via son numéro d'auteur.
 *
 * @param int $num_aut
 * @return bool .
 */
function supprimer_auteur($num_aut) {
    // Vérifier si l'auteur existe
    $auteur = get_auteur_by_id($num_aut);

    if (empty($auteur)) {
        // L'auteur n'existe pas, retourner false ou gérer l'erreur selon vos besoins
        return false;
    }

    // Supprimer l'auteur de la base de données
    $db = connect_db();
    $sql = "DELETE FROM auteur WHERE num_aut = :num_aut";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':num_aut', $num_aut, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result) {
        // Suppression réussie
        return true;
    } else {
        // Suppression échouée, gérer l'erreur selon vos besoins
        return false;
    }
}


/**
 * Cett fonction permet de récupérer un auteur exitant dans la base de données via son numéro d'auteur.
 *
 * @param int $num_aut
 * @return  .
 */   
function get_auteur_by_id(int $num_aut) {
    $db = connect_db();

    // Requête pour récupérer l'auteur par son num_aut
    $requete = 'SELECT * FROM auteur WHERE num_aut = :num_aut';

    // Préparation de la requête
    $query = $db->prepare($requete);

    // Exécution de la requête en liant le paramètre :num_aut
    $query->execute(['num_aut' => $num_aut]);

    // Récupération du résultat de la requête
    $auteur = $query->fetch(PDO::FETCH_ASSOC);

    return $auteur;
}


/**
 * Cett fonction permet de d'ajouter une langue à la base de données.
 *
 * @param string $langue Le nom de la langue .
 *
 * @return bool $ajout_langue Le resultat de l'ajout de la langue.
 */
function ajout_langue(string $langue): bool
{

    $ajout_langue = false;

    if (isset($langue) && !empty($langue)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO langue (lib_lang) VALUES (:langue);';

        // Préparation
        $inserer_langue = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_langue->execute([
            'langue' => $langue
        ]);


        if ($resultat) {
            $ajout_langue = true;
        }

    }

    return $ajout_langue;

}

/** 
*Cette fonction permet de vérifier si une langue existe dans la base de données
 * @param string $lib_lang libellé de la langue.
 * @return bool 
     
 */
function check_if_langue_exist(string $langue)
{
    $users=[];
    $liblang = false;
    $db = connect_db();
    $req = $db->prepare('SELECT cod_lang from langue WHERE lib_lang=?');
    $req_exec=$req->execute([$langue]);
    if($req_exec){
       
        $users = $req->fetch();
        if(!empty($users) && is_array($users)){
            $liblang=true;
        }
    }
    return $liblang;
    }


	
/**
 * Cette fonction permet de récupérer la liste des langues de la base de donnée.
 *
 * @return array $liste_langues La liste des langues.
 */
function get_liste_langue(): array
{

    $liste_langues = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM langue';

    // Préparation
    $verifier_liste_langues = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_langues->execute();

    if ($resultat) {

        $liste_langues = $verifier_liste_langues->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_langues;

}


/**
 * Modifie une langue dans la base de données.
 *
 * @param int $cod_lang Le code de la langue à modifier.
 * @param string $langue La nouvelle langue.
 
 * @return bool True si la modification a réussi, False sinon.
 */
function modifier_langue(int $cod_lang, string $langue): bool
{
    $modifier = false;
    $date = date("Y-m-d H:i:s");
    $db = connect_db();
    $req_prepare = $db->prepare('UPDATE langue SET lib_lang = :lib_lang, maj_le = :maj_le WHERE cod_lang = :cod_lang');
    $req_exec = $req_prepare->execute([
        'cod_lang' => $cod_lang,
		'lib_lang' => $langue,        
        'maj_le' => $date

    ]);

    if ($req_exec) {
        $modifier = true;
    }
    return $modifier;
}


/**
 * Cett fonction permet de récupérer une langue exitant dans la base de données via son code langue.
 *
 * @param int $cod_lang
 * @return  .
 */   
function get_langue_by_id(int $cod_lang) {
    $db = connect_db();

    // Requête pour récupérer l'auteur par son num_aut
    $requete = 'SELECT * FROM langue WHERE cod_lang = :cod_lang';

    // Préparation de la requête
    $query = $db->prepare($requete);

    // Exécution de la requête en liant le paramètre :num_aut
    $query->execute(['cod_lang' => $cod_lang]);

    // Récupération du résultat de la requête
    $langue = $query->fetch(PDO::FETCH_ASSOC);

    return $langue;
}


/**
 * Cett fonction permet de supprimer  une langue exitant dans la base de données via son code langue.
 *
 * @param int $cod_lang
 * @return bool .
 */
function supprimer_langue($cod_lang) {
    // Vérifier si la langue existe
    $langue = get_langue_by_id($cod_lang);

    if (empty($langue)) {
        // La langue n'existe pas, retourner false
        return false;
    }

    // Supprimer la langue de la base de données
    $db = connect_db();
    $sql = "DELETE FROM langue WHERE cod_lang = :cod_lang";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':cod_lang', $cod_lang, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result) {
        // Suppression réussie
        return true;
    } else {
        // Suppression échouée
        return false;
    }
}



/**
 * Cett fonction permet de d'ajouter un domaine à la base de données.
 *
 * @param string $domaine Le nom du domaine .
 *
 * @return bool $ajout_domaine Le resultat de l'ajout du domaine.
 */
function ajout_domaine(string $domaine): bool
{

    $ajout_domaine = false;

    if (isset($domaine) && !empty($domaine)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO domaine (lib_dom) VALUES (:domaine);';

        // Préparation
        $inserer_domaine = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_domaine->execute([
            'domaine' => $domaine
        ]);


        if ($resultat) {
            $ajout_domaine = true;
        }

    }

    return $ajout_domaine;

}



/** 
*Cette fonction permet de vérifier si un domaine existe dans la base de données
 * @param string $lib_dom libellé de la domaine.
 * @return bool 
     
 */
function check_if_domaine_exist(string $domaine)
{
    $users=[];
    $libdom = false;
    $db = connect_db();
    $req = $db->prepare('SELECT cod_dom from domaine WHERE lib_dom=?');
    $req_exec=$req->execute([$domaine]);
    if($req_exec){
       
        $users = $req->fetch();
        if(!empty($users) && is_array($users)){
            $libdom=true;
        }
    }
    return $libdom;
    }


	
/**
 * Récupère la liste des domaines et le nombre d'ouvrages associés à chaque domaine.
 *
 * @return array $liste_domaines La liste des domaines avec le nombre d'ouvrages associés.
 */
function get_liste_domaine(): array
{
    $liste_domaines = array();
    $db = connect_db();

    $requette = 'SELECT domaine.cod_dom, domaine.lib_dom, COUNT(domaine_ouvrage.cod_ouv) AS nb_ouvrages
                FROM domaine
                LEFT JOIN domaine_ouvrage ON domaine.cod_dom = domaine_ouvrage.cod_dom
                GROUP BY domaine.cod_dom, domaine.lib_dom';

    $verifier_liste_domaines = $db->prepare($requette);
    $resultat = $verifier_liste_domaines->execute();

    if ($resultat) {
        $liste_domaines = $verifier_liste_domaines->fetchAll(PDO::FETCH_ASSOC);
    }

    return $liste_domaines;
}

/**
 * Cette fonction récupère le nombre de domaines dans la base de données.
 *
 * @return int $nombre_total_domaines Le nombre total de domaines.
 */
function getNombreTotalDomaines(): int
{
    $db = connect_db();

    $requete = 'SELECT COUNT(*) AS nombre_total_domaines FROM domaine';

    $verifier_nombre_total_domaines = $db->prepare($requete);
    $resultat = $verifier_nombre_total_domaines->execute();

    if ($resultat) {
        $nombre_total_domaines = $verifier_nombre_total_domaines->fetchColumn();
        return $nombre_total_domaines;
    }

    return 0; // Retourner 0 en cas d'erreur ou de résultats vides
}


/**
 * Modifie un domaine dans la base de données.
 *
 * @param int $cod_dom Le code de la langue à modifier.
 * @param string $domaine La nouvelle langue.
 
 * @return bool True si la modification a réussi, False sinon.
 */
function modifier_domaine(int $cod_dom, string $domaine): bool
{
    $modifier = false;
    $date = date("Y-m-d H:i:s");
    $db = connect_db();
    $req_prepare = $db->prepare('UPDATE domaine SET lib_dom = :lib_dom, maj_le = :maj_le WHERE cod_dom = :cod_dom');
    $req_exec = $req_prepare->execute([
        'cod_dom' => $cod_dom,
		'lib_dom' => $domaine,        
        'maj_le' => $date

    ]);

    if ($req_exec) {
        $modifier = true;
    }
    return $modifier;
}


/**
 * Cett fonction permet de récupérer un domaine exitant dans la base de données via son code domaine.
 *
 * @param int $cod_dom
 * @return  .
 */   
function get_domaine_by_id(int $cod_dom) {
    $db = connect_db();
    // Requête pour récupérer le domaine par son cod_dom
    $requete = 'SELECT * FROM domaine WHERE cod_dom = :cod_dom';

    // Préparation de la requête
    $query = $db->prepare($requete);

    // Exécution de la requête en liant le paramètre :num_aut
    $query->execute(['cod_dom' => $cod_dom]);

    // Récupération du résultat de la requête
    $domaine = $query->fetch(PDO::FETCH_ASSOC);

    return $domaine;
}


/**
 * Cett fonction permet de supprimer  un domaine exitant dans la base de données via son code domaine.
 *
 * @param int $cod_dom
 * @return bool .
 */
function supprimer_domaine($cod_dom) {
    // Vérifier si le domaine existe
    $domaine = get_domaine_by_id($cod_dom);

    if (empty($domaine)) {
        // Le domaine n'existe pas, retourner false
        return false;
    }

    // Supprimer le domaine de la base de données
    $db = connect_db();
    $sql = "DELETE FROM domaine WHERE cod_dom = :cod_dom";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':cod_dom', $cod_dom, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result) {
        // Suppression réussie
        return true;
    } else {
        // Suppression échouée
        return false;
    }
}




/**
 * Cett fonction permet de récupérer un auteur secondaire exitant dans la base de données via son numéro d'auteur.
 *
 * @param int $num_aut
 * @return  .
 */   
function get_auteur_secondaire_by_id(int $id) {
    $db = connect_db();

    // Requête pour récupérer l'auteur par son num_aut
    $requete = 'SELECT * FROM auteur_secondaire WHERE id = :id';

    // Préparation de la requête
    $query = $db->prepare($requete);

    // Exécution de la requête en liant le paramètre :num_aut
    $query->execute(['id' => $id]);

    // Récupération du résultat de la requête
    $auteur_secondaire = $query->fetch(PDO::FETCH_ASSOC);

    return $auteur_secondaire;
}


/**
 * Cette fonction permet de récupérer la liste des membres de la base de données avec le profil "membre".
 *
 * @return array|null La liste des membres s'il y en a, sinon null.
 */
function get_liste_membres(): ?array
{
    $liste_membres = array();

    try {
        
        $db = connect_db();

        // Assurez-vous de remplacer "votre_table_utilisateur" par le nom réel de votre table "utilisateur"
        $sql = "SELECT * FROM utilisateur WHERE profil = 'membre'";

        // Préparation de la requête
        $verifier_liste_membres = $db->prepare($sql);

        // Exécution de la requête
        $verifier_liste_membres->execute();

        // Récupération des résultats
        $liste_membres = $verifier_liste_membres->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $db = null;
    } catch (PDOException $e) {
        // Gérer les erreurs éventuelles (facultatif)
        // Vous pouvez afficher un message d'erreur ou enregistrer les erreurs dans un fichier journal par exemple.
        // echo "Erreur : " . $e->getMessage();
    }

    // Retourner la liste des membres ou null si aucun membre n'est trouvé
    return !empty($liste_membres) ? $liste_membres : null;
}


/**
 * Cette fonction permet de récupérer les informations d'un membre par son ID.
 *
 * @param int $id L'identifiant du membre à récupérer.
 * @return array|null Les informations du membre s'il existe, sinon null.
 */
function obtenir_membre_par_id($id): ?array
{
    try {
        $db = connect_db();

        // Assurez-vous de remplacer "votre_table_utilisateur" par le nom réel de votre table "utilisateur"
        $sql = "SELECT * FROM utilisateur WHERE id = :id AND profil = 'membre' LIMIT 1";

        // Préparation de la requête
        $requete = $db->prepare($sql);

        // Liaison des paramètres de la requête
        $requete->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $requete->execute();

        // Récupération du membre
        $membre = $requete->fetch(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $db = null;

        // Retourner les informations du membre ou null s'il n'existe pas
        return $membre ? $membre : null;
    } catch (PDOException $e) {
       
        return null;
    }
}

/**
 * Cette fonction permet d'ajouter un ouvrage à la base de données.
 *
 * @param string $titre Le titre de l'ouvrage.
 * @param int $nb_exemplaire Le nombre d'exemplaires.
 * @param int $num_aut L'ID de l'auteur principal.
 * @param string $img Le chemin de l'image.
 * @param string|null $periodicite La périodicité de l'ouvrage (facultatif).
 *
 * @return int|bool L'ID de la dernière ligne insérée ou false en cas d'erreur.
 */
function insererOuvrage($titre, $nb_exemplaire, $num_aut, $img, $periodicite = null) {
    $db = connect_db();

    $requete_insertion = 'INSERT INTO ouvrage (titre, nb_ex, num_aut, img, periodicite) VALUES (:titre, :nb_ex, :num_aut, :img, :periodicite)';

    $requete_preparee = $db->prepare($requete_insertion);

    $resultat_insertion = $requete_preparee->execute([
        'titre' => $titre,
        'nb_ex' => $nb_exemplaire,
        'num_aut' => $num_aut,
        'img' => $img,
        'periodicite' => $periodicite
    ]);

    return $resultat_insertion;
}

/**
 * Vérifie si un ouvrage avec le même titre et le même auteur principal existe déjà.
 *
 * @param string $titre Le titre de l'ouvrage.
 * @param int $num_aut L'ID de l'auteur principal.
 * @return bool True si un ouvrage existe, sinon False.
 */
function ouvrageExisteAvecTitreEtAuteur(string $titre,int $num_aut) {
    $db = connect_db();

    $requete_verification = 'SELECT COUNT(*) FROM ouvrage WHERE titre = :titre AND num_aut = :num_aut';

    $requete_preparee = $db->prepare($requete_verification);

    $requete_preparee->execute(['titre' => $titre, 'num_aut' => $num_aut]);

    $nombre_ouvrages = $requete_preparee->fetchColumn();

    return $nombre_ouvrages > 0;
}

/**
 * Cette fonction permet de récupérer un ouvrage par son identifiant (cod_ouv) depuis la base de données.
 *
 * @param int $cod_ouv L'identifiant de l'ouvrage.
 * @return array|null Les données de l'ouvrage ou null si non trouvé.
 */
function get_ouvrage_by_id(int $cod_ouv) {
    $db = connect_db();
    
    // Requête pour récupérer l'ouvrage par son identifiant
    $requete = 'SELECT * FROM ouvrage WHERE cod_ouv = :cod_ouv';
    
    // Préparation de la requête
    $query = $db->prepare($requete);
    
    // Exécution de la requête en liant le paramètre :cod_ouv
    $query->execute(['cod_ouv' => $cod_ouv]);
    
    // Récupération du résultat de la requête
    $ouvrage = $query->fetch(PDO::FETCH_ASSOC);
    
    return $ouvrage ?: null;
}

/**
 * Cette fonction permet de récupérer toutes les informations d'un ouvrage depuis la base de données.
 *
 * @param string $titre qui est le titre de l'ouvrage
 * @param int $nb_ex qui est le nombre d'exemplaire
 * @param int num_aut qui est l'id de l'auteur
 * @param string $img qui est l'image de la page de garde
 * @param string $periodicite qui le périodicité de l'ouvrage si cela s'avère être une revue ou un journal
 * @return array Les données de l'ouvrage.
 */
function get_all_data_ouvrage_by_id(string $titre, int $nb_ex, int $num_aut, string $img, string $periodicite) {
    $data =[];
    $db = connect_db();
    
    // Requête pour récupérer toutes les données de l'ouvrage par son identifiant
    $requete = 'SELECT cod_ouv FROM ouvrage WHERE titre = :titre and nb_ex =:nb_ex and num_aut =:num_aut and img =:img and periodicite = :periodicite';
    
    $verifier_ouvrage = $db->prepare($requete);

    $resultat = $verifier_ouvrage->execute([
        'titre' => $titre,
        'nb_ex' => $nb_ex,
        'num_aut' => $num_aut,
        'img' => $img,
        'periodicite' => $periodicite,
    ]);

    if ($resultat) {
        $data = $verifier_ouvrage->fetch();
    }
    return $data;
}


/**
 * Associer un domaine à un ouvrage dans la table "domaine_ouvrage".
 *
 * @param int $cod_dom L'ID du domaine.
 * @param int $cod_ouv L'ID de l'ouvrage.
 * @return bool True en cas de succès, sinon False.
 */
function associerDomaineOuvrage(int $cod_dom, int $cod_ouv): bool {
    $db = connect_db();

    $requete_insertion = 'INSERT INTO domaine_ouvrage (cod_dom, cod_ouv) VALUES (:cod_dom, :cod_ouv)';

    $requete_preparee = $db->prepare($requete_insertion);

    $resultat_insertion = $requete_preparee->execute([
        'cod_dom' => $cod_dom,
        'cod_ouv' => $cod_ouv,
    ]);

    return $resultat_insertion;
}


/**
 * Cette fonction permet d'associer un auteur secondaire à un ouvrage dans la table auteur_secondaire.
 *
 * @param int $num_aut L'ID de l'auteur secondaire.
 * @param int $cod_ouv L'ID de l'ouvrage.
 * @return bool True en cas de succès, False en cas d'échec.
 */
function associerAuteurSecondaireOuvrage($num_aut, $cod_ouv) {
    $db = connect_db();

    // Requête pour insérer l'association dans la table auteur_secondaire
    $requete = 'INSERT INTO auteur_secondaire (num_aut, cod_ouv) VALUES (:num_aut, :cod_ouv)';

    // Préparation de la requête
    $query = $db->prepare($requete);

    // Exécution de la requête en liant les paramètres
    $resultat = $query->execute([
        'num_aut' => $num_aut,
        'cod_ouv' => $cod_ouv,
    ]);

    return $resultat;
}



/**
 * Cette fonction insère les données de langue, d'année de publication et d'exemplaires par langue
 * dans la table date_parution.
 *
 * @param int $cod_ouv L'identifiant de l'ouvrage.
 * @param array $langues Les langues sélectionnées.
 * @param array $annees Les années de publication correspondantes.
 * @param array $exemplaires Les exemplaires par langue.
 * @return bool True en cas de succès, False en cas d'échec.
 */
function insererDateParution(int $cod_ouv, array $langues, array $annees, array $exemplaires) {
    $db = connect_db();
    
    // Préparer et exécuter les requêtes pour insérer les données dans la table date_parution
    $requete = 'INSERT INTO date_parution (cod_ouv, cod_lang, dat_par, nb_ex_lang) VALUES (:cod_ouv, :cod_lang, :dat_par, :nb_ex_lang)';
    $query = $db->prepare($requete);

    foreach ($langues as $index => $cod_lang) {
        $dat_par = $annees[$index];
        $nb_ex_lang = $exemplaires[$index];
        $resultat = $query->execute([
            'cod_ouv' => $cod_ouv,
            'cod_lang' => $cod_lang,
            'dat_par' => $dat_par,
            'nb_ex_lang' => $nb_ex_lang,
        ]);

        if (!$resultat) {
            return false; // En cas d'échec, retourner false
        }
    }
    
    return true; // Si toutes les insertions réussissent, retourner true
}


/**
 * Cette fonction permet de récupérer la liste des ouvrages de la base de données.
 *
 * @param string $titre Le titre de recherche (facultatif).
 * @return array $liste_ouvrages La liste des ouvrages.
 */
function get_liste_ouvrages($titre = ''): array
{
    $liste_ouvrages = array();

    $db = connect_db();

    // Écriture de la requête de base
    $requete = 'SELECT * FROM ouvrage';

    // Si un titre de recherche est fourni, ajoutez une clause WHERE pour filtrer par titre
    if (!empty($titre)) {
        $requete .= " WHERE titre LIKE :titre";
    }

    // Préparation de la requête
    $requete_preparee = $db->prepare($requete);

    // Si un titre de recherche est fourni, liez le paramètre
    if (!empty($titre)) {
        $titre = '%' . $titre . '%';
        $requete_preparee->bindParam(':titre', $titre, PDO::PARAM_STR);
    }

    // Exécution de la requête
    $resultat = $requete_preparee->execute();

    if ($resultat) {
        $liste_ouvrages = $requete_preparee->fetchAll(PDO::FETCH_ASSOC);
    }

    return $liste_ouvrages;
}



function get_domaines_by_ouvrage($cod_ouv): array
{
    $db = connect_db();
    $query = "SELECT domaine.lib_dom
              FROM domaine_ouvrage
              INNER JOIN domaine ON domaine_ouvrage.cod_dom = domaine.cod_dom
              WHERE domaine_ouvrage.cod_ouv = :cod_ouv";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cod_ouv', $cod_ouv);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function get_auteurs_secondaires_by_ouvrage($cod_ouv): array
{
    $db = connect_db();
    $query = "SELECT auteur.prenom_aut, auteur.nom_aut
              FROM auteur_secondaire
              INNER JOIN auteur ON auteur_secondaire.num_aut = auteur.num_aut
              WHERE auteur_secondaire.cod_ouv = :cod_ouv";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cod_ouv', $cod_ouv);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * Cette fonction permet de récupérer les informations associées à l'ouvrage dans la table date parution
 * @param $cod_ouv le cod de l'ouvrage
 */
function get_details_ouvrage($cod_ouv): array
{
    $db = connect_db();
    $query = "SELECT langue.lib_lang AS langue, date_parution.dat_par AS annee_publication, date_parution.nb_ex_lang AS nb_exemplaire_langue
              FROM date_parution
              INNER JOIN langue ON date_parution.cod_lang = langue.cod_lang
              WHERE date_parution.cod_ouv = :cod_ouv";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cod_ouv', $cod_ouv);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


/**
 * Cette fonction permet de  pour vérifier si une entrée spécifique existe dans une table d'une base de données 
 * @param string $table : Il s'agit du nom de la table dans laquelle vous souhaitez vérifier si une entrée existe.
 * @param string $field : Il s'agit du nom du champ (colonne) dans la table que vous souhaitez comparer à une valeur spécifique pour vérifier son existence.
 * @param string $fieldentry : Il s'agit de la valeur que vous souhaitez comparer au champ spécifié pour déterminer si une entrée correspondante existe.
 * @return bool
 */
function check_if_exist($table, $field, $fieldentry): bool
{

    $exist = false;

    $db = connect_db();

    $request = "SELECT * FROM " . $table . " WHERE " . $field . " = :field_entry and est_actif = 1 and est_supprimer = 0";

    $request_prepare = $db->prepare($request);

    $request_execution = $request_prepare->execute([
        "field_entry" => $fieldentry
    ]);

    if ($request_execution) {

        $data = $request_prepare->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $exist = true;
        }
    }

    return $exist;
}       
           
function get_langues_for_ouvrage($cod_ouv) {
    $db = connect_db();
    $query = "SELECT langue.lib_lang AS langue FROM date_parution
              INNER JOIN langue ON date_parution.cod_lang = langue.cod_lang
              WHERE date_parution.cod_ouv = :cod_ouv";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cod_ouv', $cod_ouv);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}



/**
 * Cette fonction récupère les informations des ouvrages associés à un domaine spécifique.
 *
 * @param int $domaine_id L'ID du domaine pour lequel récupérer les ouvrages.
 * @return array Un tableau d'informations sur les ouvrages associés au domaine.
 */
function getOuvragesByDomaineID($domaine_id) {
    // Établir une connexion à la base de données
    $db = connect_db();

    // Requête SQL pour récupérer les informations des ouvrages liés au domaine, y compris le cod_ouv
    $query = "SELECT
        ouvrage.cod_ouv AS cod_ouv, 
        ouvrage.titre AS titre,
        ouvrage.img AS image,
        ouvrage.nb_ex AS  nombre_exemplaires_total,
        CONCAT(auteur.nom_aut, ' ', auteur.prenom_aut) AS auteur,
        GROUP_CONCAT(DISTINCT CONCAT(auteur_secondaire_info.nom_aut, ' ', auteur_secondaire_info.prenom_aut) SEPARATOR ', ') AS auteurs_secondaires,
        GROUP_CONCAT(DISTINCT CONCAT(langue.lib_lang, ' | ', date_parution.dat_par, ' | ', date_parution.nb_ex_lang) SEPARATOR ', ') AS details

    FROM
        domaine_ouvrage
    INNER JOIN ouvrage ON domaine_ouvrage.cod_ouv = ouvrage.cod_ouv
    LEFT JOIN auteur ON ouvrage.num_aut = auteur.num_aut
    LEFT JOIN date_parution ON ouvrage.cod_ouv = date_parution.cod_ouv
    LEFT JOIN langue ON date_parution.cod_lang = langue.cod_lang
    LEFT JOIN auteur_secondaire ON ouvrage.cod_ouv = auteur_secondaire.cod_ouv
    LEFT JOIN auteur AS auteur_secondaire_info ON auteur_secondaire.num_aut = auteur_secondaire_info.num_aut
    WHERE
        domaine_ouvrage.cod_dom = :domaine_id
    GROUP BY
        ouvrage.cod_ouv";  

    // Préparation de la requête
    $stmt = $db->prepare($query);
    $stmt->bindParam(':domaine_id', $domaine_id);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Récupération des résultats sous forme de tableau associatif
    $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner le tableau d'informations des ouvrages
    return $ouvrages;
}


/**
 * Cette fonction récupère le nom du domaine en fonction de son ID.
 *
 * @param int $domaine_id L'ID du domaine.
 * @return string Le nom du domaine.
 */
function getDomaineNameByID($domaine_id) {
    $db = connect_db();
    $query = "SELECT lib_dom FROM domaine WHERE cod_dom = :domaine_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':domaine_id', $domaine_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['lib_dom'];
}


/**
 * Cette fonction génère un numéro d'emprunt personnalisé au format "001", "002", ...
 *
 * @return string|false Le numéro d'emprunt personnalisé ou false en cas d'erreur.
 */
function generateCustomEmpNumber() {
    $db = connect_db(); // Supposons que vous avez une fonction connect_db() pour vous connecter à la base de données

    try {
        $db->beginTransaction(); // Début d'une transaction

        // Sélectionner le dernier numéro d'emprunt en mode verrouillage
        $query = "SELECT MAX(num_emp) AS max_num_emp FROM emprunt FOR UPDATE";
        $result = $db->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $maxNumEmp = $row['max_num_emp'];

        // Générer le prochain numéro en incrémentant de 1
        $newNumEmp = $maxNumEmp + 1;

        // Formater le numéro pour avoir trois chiffres (ex. 001, 002, 003)
        $formattedNumEmp = sprintf('%03d', $newNumEmp);

        // Valider la transaction
        $db->commit();

        return $formattedNumEmp; // Renvoie le numéro d'emprunt personnalisé généré
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $db->rollBack();
        // Gérer l'erreur ou la journaliser
        echo "Erreur : " . $e->getMessage();
        return false; // Ou renvoyer une valeur par défaut
    }
}


function getLanguesByOuvrageID($ouvrage_id) {
    // Établir une connexion à la base de données
    $db = connect_db();

    // Requête SQL pour récupérer les langues liées à l'ouvrage
    $query = "SELECT
        langue.lib_lang AS langue, langue.cod_lang AS code_langue
    FROM
        date_parution
    INNER JOIN langue ON date_parution.cod_lang = langue.cod_lang
    WHERE
        date_parution.cod_ouv = :ouvrage_id";

    // Préparation de la requête
    $stmt = $db->prepare($query);
    $stmt->bindParam(':ouvrage_id', $ouvrage_id);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats sous forme de tableau associatif
    $langues = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner le tableau des langues associées à l'ouvrage
    return $langues;
}


/**
 * Recherche les domaines par nom.
 *
 * Cette fonction effectue une recherche dans la base de données pour trouver
 * les domaines dont le nom contient la chaîne spécifiée.
 *
 * @param PDO $pdo La connexion PDO à la base de données.
 * @param string $nom Le nom à rechercher.
 * @return array Un tableau associatif contenant les résultats de la recherche.
 * Chaque élément du tableau représente un domaine avec ses propriétés, y compris le nombre d'ouvrages.
 * Si aucun résultat n'est trouvé, un tableau vide est retourné.
 *
 * @throws PDOException En cas d'erreur lors de l'exécution de la requête SQL.
 */
function searchDomaineByNom($pdo, $nom) {
    $sql = "SELECT domaine.*, COUNT(ouvrage.cod_ouv) AS nb_ouvrages 
            FROM domaine 
            LEFT JOIN domaine_ouvrage ON domaine.cod_dom = domaine_ouvrage.cod_dom
            LEFT JOIN ouvrage ON domaine_ouvrage.cod_ouv = ouvrage.cod_ouv
            WHERE domaine.lib_dom LIKE :nom 
            GROUP BY domaine.cod_dom";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', "%$nom%", PDO::PARAM_STR);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * getSuggestionsByTitre - Récupère des suggestions d'ouvrages basées sur un titre donné.
 *
 * @param string $query - Le titre à utiliser pour récupérer les suggestions.
 *
 * @return array - Un tableau associatif contenant les suggestions de titres d'ouvrages.
 *                Chaque élément du tableau est un tableau associatif avec une clé 'titre'.
 *                Retourne un tableau vide si aucune suggestion n'est trouvée.
 */
function getSuggestionsByTitre($query) {
    try {
        // Établir une connexion à la base de données
        $db = connect_db();

        // Effectuer la requête SQL pour récupérer les suggestions basées sur le titre
        // Assurez-vous d'ajuster la requête en fonction de votre base de données
        $sql = "SELECT titre FROM ouvrage WHERE titre LIKE :query LIMIT 5";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermer la connexion à la base de données
        $db = null;

        return $result;
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données ici
        // Vous pouvez enregistrer ces erreurs dans un fichier de journal, les afficher, etc.
        error_log("Erreur PDO: " . $e->getMessage());
        return [];
    }
}

/**
 * Cette fonction permet d'ajouter un emprunt pour un utilisateur donné.
 *
 * @param PDO $db La connexion à la base de données.
 * @param int $userId L'identifiant de l'utilisateur.
 * @return int|false Le numéro de l'emprunt ajouté ou false en cas d'erreur.
 */
function ajouterEmprunt(PDO $db, int $userId) {
    try {
        // Date actuelle
        $currentDate = date("Y-m-d H:i:s");

        // Requête d'insertion dans la table emprunt
        $insertEmpruntQuery = "INSERT INTO emprunt (dat_emp, id, est_actif, est_supprimer, maj_le) 
                               VALUES (:currentDate, :userId, 1, 0, :currentDate)";

        // Préparation de la requête
        $query = $db->prepare($insertEmpruntQuery);

        // Liaison des paramètres
        $query->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);

        // Exécution de la requête
        $query->execute();

        // Récupération du numéro de l'emprunt que vous venez d'insérer
        return $db->lastInsertId();
    } catch (PDOException $e) {
        // Gestion des erreurs - vous pouvez personnaliser cela en fonction de vos besoins
        echo "Erreur lors de l'insertion dans la table emprunt : " . $e->getMessage();
        return false;
    }
}


/**
 * Cette fonction permet d'associer un ouvrage à un emprunt.
 *
 * @param PDO $db La connexion à la base de données.
 * @param int $numEmp Le numéro de l'emprunt.
 * @param int $codOuv L'identifiant de l'ouvrage.
 * @param int $codLang Le code de la langue.
 * @return void
 */
function associerOuvrageEmprunt(PDO $db, int $numEmp, int $codOuv, int $codLang) {
    try {
        // Date actuelle
        $currentDate = date("Y-m-d H:i:s");

        // Date butoir (une semaine à partir de la date actuelle)
        $datButoir = date("Y-m-d H:i:s", strtotime($currentDate . " +1 week"));

        // Requête d'insertion dans la table emprunt_ouvrage
        $insertEmpruntOuvrageQuery = "INSERT INTO emprunt_ouvrage (num_emp, cod_ouv, cod_lang, dat_emp, dat_butoir, est_actif) 
                                     VALUES (:numEmp, :codOuv, :codLang, :currentDate, :datButoir, 0)";

        // Préparation de la requête
        $query = $db->prepare($insertEmpruntOuvrageQuery);

        // Liaison des paramètres
        $query->bindParam(':numEmp', $numEmp, PDO::PARAM_INT);
        $query->bindParam(':codOuv', $codOuv, PDO::PARAM_INT);
        $query->bindParam(':codLang', $codLang, PDO::PARAM_INT);
        $query->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $query->bindParam(':datButoir', $datButoir, PDO::PARAM_STR);

        // Exécution de la requête
        $query->execute();
    } catch (PDOException $e) {
        // Gestion des erreurs - vous pouvez personnaliser cela en fonction de vos besoins
        echo "Erreur lors de l'insertion dans la table emprunt_ouvrage : " . $e->getMessage();
    }
}



