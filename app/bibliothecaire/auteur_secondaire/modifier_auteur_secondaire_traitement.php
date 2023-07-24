<?php
$nom_aut_secondaire = isset($_POST['nom_aut_secondaire']) ? $_POST['nom_aut_secondaire'] : '';
$prenom_aut_secondaire = isset($_POST['prenom_aut_secondaire']) ? $_POST['prenom_aut_secondaire'] : '';


$errors = array();

if (empty($_POST["nom_aut_secondaire"])) {
	$errors['nom_aut_secondaire'] = "Le champ nom est obligatoire.";
}

if (empty($_POST["prenom_aut_secondaire"])) {
	$errors['prenom_aut_secondaire'] = "Le champ prénom est obligatoire.";
}

if (empty($errors)) {
	$id = $_SESSION['id'];
	$nom_aut_secondaire = trim(htmlentities($_POST['prenom_aut_secondaire']));
	$prenom_aut_secondaire = trim(htmlentities($_POST['prenom_aut_secondaire']));

	// Mettez à jour les informations de l'auteur dans la base de données en utilisant votre fonction appropriée
	modifier_auteur($id, $nom_aut_secondaire, $prenom_aut_secondaire);

	// Redirigez vers la page de liste des auteurs avec un message de succès global
    $_SESSION['modification_succès'] = 'Modification de l\'auteur secondaire effectuée avec succès';
	header('location: ' . PROJECT_DIR . 'bibliothecaire/auteur_secondaire/liste_des_auteurs_secondaire');
	exit();
}

// Stockez les erreurs dans la session et redirigez vers la page de modification de l'auteur
$_SESSION['nom_aut_secondaire'] = $_POST['nom_aut_secondaire'];
$_SESSION['prenom_aut_secondaire'] = $_POST['prenom_aut_secondaire'];
$_SESSION['modification_errors'] = $errors;
header('location: ' . PROJECT_DIR . 'bibliothecaire/auteur_secondaire/modifier_auteur_secondaire');
exit();
