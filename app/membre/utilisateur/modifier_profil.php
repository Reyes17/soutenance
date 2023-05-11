<?php
session_start();

include 'app/commun/fonction/fonction.php';

$_SESSION['passe'] = "";

$_SESSION['donnees-utilisateur'] = [];

$data = $_SESSION['utilisateur_connecter'];

$new_data = [];

$errors = [];


if (isset($_POST['sauvegarder'])) {

    if (check_password_exist(($_POST['mot_de_passe']), $data[0]['id'])) {

        if (isset($_POST['nom']) && !empty($_POST['nom']) && $_POST['nom'] != $data[0]['nom']) {
            $new_data['nom'] = trim(htmlentities($_POST['nom']));
        } else {
            $new_data['nom'] = $data[0]['nom'];
        }

        if (isset($_POST['prenom']) && !empty($_POST['prenom']) && $_POST['prenom'] != $data[0]['prenom']) {
            $new_data['prenom'] = trim(htmlentities($_POST['prenom']));
        } else {
            $new_data['prenom'] = $data[0]['prenom'];
        }

        if (isset($_POST['telephone']) && !empty($_POST['telephone']) && $_POST['telephone'] != $data[0]['telephone']) {
            $new_data['telephone'] = trim(htmlentities($_POST['telephone']));
        } else {
            $new_data['telephone'] = $data[0]['telephone'];
        }

        if (isset($_POST['nom_utilisateur']) && !empty($_POST['nom_utilisateur']) && $_POST['nom_utilisateur'] != $data[0]['nom_utilisateur']) {
            $new_data['nom_utilisateur'] =$_POST['nom_utillisateur'];
        } else {
            $new_data['nom_utilisateur'] = $data[0]['nom_utilisateur'];
        }

        if (isset($_POST['adresse']) && !empty($_POST['adresse']) && $_POST['adresse'] != $data[0]['adresse']) {
            $new_data['adresse'] = trim(htmlentities($_POST['adresse']));
        } else {
            $new_data['adresse'] = $data[0]['adresse'];
        }

        if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])) {
            $data["mot_de_passe"] = trim(htmlentities($_POST['mot_de_passe']));
        } else {
            $errors["mot_de_passe"] = "Le champs mot de passe est requis. Veuillez le renseigner.";
        }

        

        if (maj_nv_info_user(
            $data[0]['id'],
            $new_data['nom'],
            $new_data['prenom'],
            $new_data['telephone'],
            $new_data['nom_utilisateur'],
            $new_data['adresse']
        )) {

            if (recup_maj_nv_info_user(
                $data[0]['id']
            )) {
                $_SESSION['success'] = "Modification(s) effectuée(s) avec succès";
                header('location:' . PROJECT_DIR .'membre/utilisateur/mon-profil');
            } else {
                $_SESSION['passe'] = "La modification à echouer. Vérifier votre mot de passe et réessayer.";

                header('location:' . PROJECT_DIR .'membre/utilisateur/mon-profil');
            }
        }
    } else {
        $_SESSION['errors'] = "La modification à echouer. Vérifier votre mot de passe et réessayer.";

        header('location:' . PROJECT_DIR .'membre/utilisateur/mon-profil');
    }
}
