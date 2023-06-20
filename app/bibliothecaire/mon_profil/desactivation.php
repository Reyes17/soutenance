<?php
$_SESSION['desactivation-errors'] = "";

$data = [];

$errors = [];

if (isset($_POST['desactivation'])) {

	if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter_bibliothecaire']['id'])) {
		if (desactiver_utilisateur($_SESSION['utilisateur_connecter_bibliothecaire']['id'])) {
			session_destroy();
			header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
		}
	} else {
		$_SESSION['desactivation-errors'] = "La desactivation à echouer. Vérifier votre mot de passe et réessayer.";
		header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
	}
} else {
	$_SESSION['desactivation-errors'] = "La desactivation à echouer. Veuillez entrer un mot de passe.";
		header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
}

