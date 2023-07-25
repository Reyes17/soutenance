<?php

$categorie = [];
$errors = "";

if (empty($_POST["nom_cat"])) {
	$errors = "Le champ est vide. Veuillez le remplir.";
}

if (empty($errors)) {
	$cod_cat = $_SESSION['cod_cat'];
	$categorie = trim(htmlentities($_POST['nom_cat']));

	// Mettez à jour les informations de la catégorie dans la base de données en utilisant votre fonction appropriée
	modifier_categorie($cod_cat, $categorie);

	// Redirigez vers la page de liste des catégories avec un message de succès global
    $_SESSION['modification_succès'] = 'Modification de la catégorie effectuée avec succès';
	header('location: ' . PROJECT_DIR . 'bibliothecaire/categorie/liste_des_categories');
	exit();
}

// Stockez les erreurs dans la session et redirigez vers la page de modification catégorie
$_SESSION['modification_errors'] = $errors;
header('location: ' . PROJECT_DIR . 'bibliothecaire/categorie/modifier_categorie');
exit();