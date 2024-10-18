<?php
//session_start();
include 'app/commun/fonction/fonction.php';
$params = explode('/', $_GET['p']);
$profile = "bibliothecaire";
$default_ressource = "connexion";
$default_action = "index";
$default_action_folder = "app/" . $profile . "/" . $default_ressource . "/" . $default_action . ".php";

//Connaître le nombre de contenus dans chaque table
$nombre_total_domaines = getNombreTotalDomaines();

$liste_auteurs = get_liste_auteurs();
$nombre_total_auteurs = $liste_auteurs[0]['nombre_total_auteurs'];

$liste_langue = get_liste_langue();
$nombre_langue = count($liste_langue);

$liste_membres = get_liste_membres();
$nombre_membre = count($liste_membres);

$liste_ouvrages = get_liste_ouvrages();
$nombre_ouvrage = count($liste_ouvrages);
////////////////////////////////////////////////////////////

if (isset($_GET['p']) && !empty($_GET['p'])) {
	$ressource = (isset($params[1]) && !empty($params[1])) ? $params[1] : $default_ressource;
	$action = (isset($params[2]) && !empty($params[2])) ? $params[2] : $default_action;
	$action_folder = "app/" . $profile . "/" . $ressource . "/" . $action . ".php";
	if (file_exists($action_folder)) {
		require_once $action_folder;
	} else {
		require_once $default_action_folder;
	}
} else {
	require_once $default_action_folder;
}
