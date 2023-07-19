<?php
$data = [];
$message_errors_global = "";
$message_success_global = "";
$errors = [];


//Je vérifie si les informations envoyés par le visiteur sont corrrects.


if (verifier_info($_POST['nom'])) {
	$data['nom'] = trim(htmlentities($_POST['nom']));
} else {
	$errors['nom'] = '<p> Le champ nom est requis. Veuillez le renseigner! </p>';
}

if (verifier_info($_POST['prenom'])) {
	$data['prenom'] =trim(htmlentities($_POST['prenom']));
} else {
	$errors['prenom'] = '<p > Le champ prénom est requis. Veuillez le renseigner!</p>';
}


if (isset($_POST["nom_utilisateur"]) && !empty($_POST["nom_utilisateur"])) {
	$data["nom_utilisateur"] = trim($_POST['nom_utilisateur']);
} else {
	$errors["nom_utilisateur"] = "Le champ nom utilisateur est requis. Veuillez le renseigner.";
}

if (isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$data["email"] = trim($_POST['email']);
} else {
	$errors['email'] = '<p>Le champ email est requis ou est déjà utlisé. Veuillez le renseigner!</p>';
}

if (!isset($_POST["mot_de_passe"]) || empty($_POST["mot_de_passe"])) {
	$errors["mot_de_passe"] = "Le champ du mot de passe est vide. Veuillez le renseigner.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) < 8) {
	$errors["mot_de_passe"] = "Le champ doit contenir minimum 8 caractères. Les espaces ne sont pas pris en compte.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && empty($_POST["confirmer_mot_de_passe"])) {
	$errors["confirmer_mot_de_passe"] = "Entrez votre mot de passe à nouveau.";
}

if ((isset($_POST["confirmer_mot_de_passe"]) && !empty($_POST["confirmer_mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && $_POST["confirmer_mot_de_passe"] != $_POST["mot_de_passe"])) {
	$errors["confirmer_mot_de_passe"] = "Mot de passe erroné. Entrez le mot de passe du précédent champs";
}

if ((isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && $_POST["confirmer_mot_de_passe"] == $_POST["mot_de_passe"])) {
	$data["mot_de_passe"] = trim($_POST['mot_de_passe']);
}

if (isset($_POST["terms"]) && !empty($_POST["terms"])) {
	$data["terms"] = $_POST["terms"];
} else {
	$errors["terms"] = "Cocher la case pour accepter nos terms et conditions.";
}


$check_email_exist_in_db = check_email_exist_in_db($_POST["email"]);

if ($check_email_exist_in_db) {
	$errors["email"] = "Cette adresse mail est déja utilisé. Veuillez le changer.";
}

$check_user_name_exist_in_db = check_user_name_exist_in_db($_POST["nom_utilisateur"]);

if ($check_user_name_exist_in_db) {
	$errors["nom_utilisateur"] = "Ce nom d'utilisateur est déja utilisé. Veuillez le changer.";
}

$data["profil"] = "Bibliothecaire";


if (empty($errors)) {
	
	$resultat = enregistrer_utilisateur($data["nom"], $data["prenom"], $data["email"], $data["nom_utilisateur"], $data["mot_de_passe"], $data["profil"]);

	if ($resultat) {

		$_SESSION['message_success_global'] = "Inscription réussie. Veuillez contacter un administateur afin qu'il puisse activer votre compte.";
	} else {
		$_SESSION['message_errors_global'] = "Une erreur s'est produite lors de l'inscription, veuillez réessayer.";
	}
} //Si les informations de l'utilisateur sont incorrects, je le redirige vers la page d'inscription avec des messages d'erreurs
else {
	$_SESSION['inscription-erreurs'] = $errors;
}
header('location:' . PROJECT_DIR . 'bibliothecaire/inscription');
