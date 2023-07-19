<?php
$data = [];
$errors = [];
$danger = [];
$_SESSION['data'] = [];
if (isset($_POST["nom_utilisateur"]) && !empty($_POST["nom_utilisateur"])) {
	$data["nom_utilisateur"] = trim(htmlentities($_POST['nom_utilisateur']));
} else {
	$errors["nom_utilisateur"] = "Le champ nom utilisateur est requis. Veuillez le renseigner.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])) {
	$data["mot_de_passe"] = trim(htmlentities($_POST['mot_de_passe']));
} else {
	$errors["mot_de_passe"] = "Le champ mot de passe est requis. Veuillez le renseigner.";
}
$_SESSION ['data'] = $data;

if (empty($errors)) {
//Je vérifie si l'utilisateur existe dans la base de données
$membre = recuperer_donnees_utilisateur($data['nom_utilisateur'], $data['mot_de_passe'],'Membre',1,0);
//si oui, je le connecte et j'enregistre ses données dans une session.
if (is_array(  $membre)) {
	$_SESSION['utilisateur_connecter_membre'] = $membre;
	$_SESSION['data'] = "";

	//Si l'utilisateur appuie sur le checkbox "se souvenir de moi"
	if (isset($_POST['se_souvenir']) and !empty($_POST['se_souvenir'])) {

		//Je crée un cookie pour enregistrer ses données.
		setcookie(
			"utilisateur_connecter_membre",
			json_encode($data['email']),
			[
				'expires' => time() + 365 * 24 * 3600,
				'path' => '/',
				'secure' => true,
				'httponly' => true,

			]
		);
	}
	//S'il ne coche pas sur le checkbox "se souvenir de moi"
	//Je modifie le cookie en le vidant
	else {
		setcookie(
			"utilisateur_connecter_membre",
			"",
			[
				'expires' => time() + 365 * 24 * 3600,
				'path' => '/',
				'secure' => true,
				'httponly' => true,


			]
		);
	}

	header('location:' . PROJECT_DIR . 'membre/acceuil/index');
	exit();
} else {
	$_SESSION['danger'] = "Nom d'utilisateur ou mot de passe incorrect. Veuillez vérifier";

	header('location:' . PROJECT_DIR . 'membre/connexion');
	exit();
}
} else {
$_SESSION['errors'] = $errors;
}
header('location:' . PROJECT_DIR . 'membre/connexion');



