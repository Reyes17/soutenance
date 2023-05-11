<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

//Exemple de fonction pour exécuter la requête INSERT INTO

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

// Récupérer le token
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

//Recupérer id de l'utilisateur

function select_user_id(string $email)
{
    $user_id = [];

    $db = connect_db();

    $request = "SELECT id FROM utilisateur WHERE email=:email";

    $request_prepare = $db->prepare($request);

    $request_execution = $request_prepare->execute([
        'email' => $email
    ]);

    if ($request_execution) {

        $data = $request_prepare->fetchAll(PDO::FETCH_ASSOC);

        if (isset($data) && !empty($data) && is_array($data)) {
            $user_id = $data;
        }
    }
    return $user_id;
}

// Exemple de fonction pour exécuter la requête SELECT

function search_user_id($user_id)
{

    $user_id = [];

    $db = connect_db();

    $request = "SELECT user_id FROM token WHERE id=:id";

    $request_prepare = $db->prepare($request);

    $request_execution = $request_prepare->execute([
        'user_id' => $user_id
    ]);

    if ($request_execution) {

        $data = $request_prepare->fetchAll(PDO::FETCH_ASSOC);

        if (isset($data) && !empty($data) && is_array($data)) {

            $user_id = $data;
        }
    }
    return $user_id;
}

// Exemple de fonction pour exécuter la requête UPDATE TOKEN

function maj(int $id_utilisateur): bool
{

    $maj = false;

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

        $maj = true;
    }

    return $maj;
}


// Exemple de fonction pour mettre à jour la table utilisateur

function maj1(int $id_utilisateur): bool
{

    $maj1 = false;

    $date = date("Y-m-d H:i:s");

    $db = connect_db();

    $request = "UPDATE utilisateur SET est_actif = :est_actif, maj_le = :maj_le WHERE id= :id_utilisateur";

    $request_prepare = $db->prepare($request);

    $request_execution = $request_prepare->execute(
        [
            'id_utilisateur' => $id_utilisateur,
            'est_actif' => 1,
            'maj_le' => $date
        ]
    );

    if ($request_execution) {

        $maj1 = true;
    }

    return $maj1;
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
 * Si oui elle retourne un tableau contenant les informations de l'utilisateur.
 * Sinon elle retourne un tableau vide.
 *
 * @param string $email L'email.
 * @param string $password Le mot de passe.
 *
 * @return array $user Les informations de l'utilisateur.
 */
function check_if_user_exist(string $nom_utilisateur, string $mot_de_passe, string $profil, int $est_actif = 1): bool
{

    $user = false;

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

        $utilisateur = $verifier_nom_utilisateur->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur_connecter'] = $utilisateur;
        $user = (isset($utilisateur) && !empty($utilisateur) && is_array($utilisateur)) ?  true : false;
    }

    return $user;
}


function check_if_user_conneted()
{

    $check = false;


    if (isset($_SESSION["utilisateur_connecter"]) && !empty($_SESSION["utilisateur_connecter"])) {

        $check = true;
    }
    return $check;
}

//Cette fonction permet de rechercher si le mot de passe existe et appartient à l'utilisateur enregistrer dans la base de donnée 
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

//Cette fonction permet de modifier le mot de passe de l'utilisateur dans la base de données
function update_password_in_db(int $id,  string $mot_de_passe)
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


//Fonction qui permet de mettre à jour les informations du profil dans la base de donnee 
function maj_nv_info_user(int $id, string $nom, string $prenom, string $telephone, string $nom_utilisateur, string $adresse): bool
{

    $modifier_profil = false;

    $date = date("Y-m-d H:i:s");

    $db = connect_db();

    $request = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, telephone = :telephone, nom_utilisateur = :nom_utilisateur, adresse = :adresse, maj_le = :maj_le WHERE id= :id";

    $request_prepare = $db->prepare($request);

    $request_execution = $request_prepare->execute(array(
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'telephone' => $telephone,
        'nom_utilisateur' => $nom_utilisateur,
        'adresse' => $adresse,
        'maj_le' => $date
    ));

    if ($request_execution) {

        $modifier_profil = true;
    }

    return $modifier_profil;
}


//Fonction pour récupérer la mise à jour du profil
function recup_maj_nv_info_user($id): bool
{

    $recup = false;

    $db = connect_db();

    $request_recupere = $db->prepare('SELECT  id, nom, prenom, sexe, date_naissance, email, telephone, nom_utilisateur, avatar, adresse, profil FROM utilisateur WHERE id= :id');

    $resultat = $request_recupere->execute(array(
        'id' => $id,
    ));

    if ($resultat) {
        $data = [];

        $data = $request_recupere->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['utilisateur_connecter'] = $data;

        $recup = true;
    }
    return $recup;
}

//cette fonction permet de désactiver le profil d'un utilisatreur
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


//Cette fonction permet de supprimer un utilisateur

function supprimer_utilisateur(int $id): bool
{

    $profile_supprimer = false;

    $date = date("Y-m-d H:i:s");

    $db = connect_db();

    $request = "UPDATE utilisateur SET  est_actif = :est_actif, est_supprimer :est_supprimer, maj_le = :maj_le WHERE id= :id";

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
