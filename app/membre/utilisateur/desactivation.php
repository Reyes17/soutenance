
<?php
session_start();

include 'app/commun/fonction/fonction.php';

$_SESSION['desactivation-errors'] = "";

$_SESSION['donnees-utilisateur'] = [];

$data = [];

$errors = [];

if (isset($_POST['desactivation'])) {

    if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter'][0]['id'])) {
        if (desactiver_utilisateur($_SESSION['utilisateur_connecter']['id'])) {
            session_destroy();
            header('location:' . PROJECT_DIR .'membre/utilisateur/acceuil');
        }
    } else {
        $_SESSION['desactivation-errors'] = "La desactivation à echouer. Vérifier votre mot de passe et réessayer.";
        header('location:' . PROJECT_DIR .'membre/utilisateur/mon-profil');
    }
} else {
    die('no good at all');
}

