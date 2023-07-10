<?php
$nom_aut = isset($_POST['nom_aut']) ? $_POST['nom_aut'] : '';
$prenom_aut = isset($_POST['prenom_aut']) ? $_POST['prenom_aut'] : '';


$errors = array();

if (empty($_POST["nom_aut"])) {
	$errors['nom_aut'] = "Le champ nom est obligatoire.";
}

if (empty($_POST["prenom_aut"])) {
	$errors['prenom_aut'] = "Le champ prénom est obligatoire.";
}

if (empty($errors)) {
	$num_aut = $_SESSION['num_aut'];
	$nom_aut = trim(htmlentities($_POST['nom_aut']));
	$prenom_aut = trim(htmlentities($_POST['prenom_aut']));

	// Mettez à jour les informations de l'auteur dans la base de données en utilisant votre fonction appropriée
	modifier_auteur($num_aut, $nom_aut, $prenom_aut);

	// Redirigez vers la page de liste des auteurs avec un message de succès global
    $_SESSION['modification_succès'] = 'Modification de l\'auteur effectuée avec succès';
	header('location: ' . PROJECT_DIR . 'bibliothecaire/auteur/liste_des_auteurs');
	exit();
}

// Stockez les erreurs dans la session et redirigez vers la page de modification de l'auteur
$_SESSION['nom_aut'] = $_POST['nom_aut'];
$_SESSION['prenom_aut'] = $_POST['prenom_aut'];
$_SESSION['modification_errors'] = $errors;
header('location: ' . PROJECT_DIR . 'bibliothecaire/auteur/modifier_auteur');
exit();
