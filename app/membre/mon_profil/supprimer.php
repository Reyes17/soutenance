<?php
$_SESSION['desactivaction-errors'] = "";

$data = [];

$errors = [];

if (isset($_POST['supprimer'])) {

	if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter_membre']['id'])) {
		if (supprimer_utilisateur($_SESSION['utilisateur_connecter_membre']['id'])) {
			session_destroy();
			header('location:' . PROJECT_DIR . 'membre/connexion');
		}
	} else {
		$_SESSION['desactivation-errors'] = "La suppression à echouer. Vérifier votre mot de passe et réessayer.";
		header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
	}
} else {
	$_SESSION['desactivation-errors'] = "La suppression à echouer. Veuillez entrer un mot de passe..";
		header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
}
