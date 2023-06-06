<?php
$_SESSION['desactivaction-errors'] = "";

$data = [];

$errors = [];

if (isset($_POST['supprimer'])) {

	if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter']['id'])) {
		if (supprimer_utilisateur($_SESSION['utilisateur_connecter']['id'])) {
			session_destroy();
			header('location:' . PROJECT_DIR . 'membre/utilisateur/acceuil');
		}
	} else {
		$_SESSION['desactivation-errors'] = "La suppression à echouer. Vérifier votre mot de passe et réessayer.";
		header('location:' . PROJECT_DIR . 'membre/utilisateur/mon-profil');
	}
} else {
	die('no good at all');
}
