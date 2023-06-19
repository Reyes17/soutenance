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
	$user = check_if_user_exist($data["nom_utilisateur"], $data["mot_de_passe"], "Bibliothecaire");
	if (!empty($user)) {
		$_SESSION["utilisateur_connecter_bibliothecaire"] = $user;
		header('location:' . PROJECT_DIR . 'bibliothecaire/dossier/dashboard');
	} else {
		$_SESSION['danger'] = "Nom d'utilisateur ou mot de passe incorrect. Veuillez vérifier";
	}
} else {
	$_SESSION['errors'] = $errors;
}
header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
