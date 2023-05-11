<?php
session_start();
include '../soutenance/app/commun/fonction/fonction.php';
$_SESSION['desactivaction-errors'] = "";

$_SESSION['donnees-utilisateur'] = [];

$data = [];

$errors = [];

if (isset($_POST['supprimer'])) {

    if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter']['id'])) {
        if (supprimer_utilisateur($_SESSION['utilisateur_connecter']['id'])) {
            session_destroy();
            header('location:/soutenance/membre/utilisateur/acceuil');
        }
    } else {
        $_SESSION['desactivation-errors'] = "La suppression à echouer. Vérifier votre mot de passe et réessayer.";
        header('location:/soutenance/membre/utilisateur/mon-profil');
    }
} else {
    die('no good at all');
}

?>