<?php
include 'app/commun/fonction/fonction.php';
session_start();
$data=[];
$errors=[];
$_SESSION['data']= [];
if (isset($_POST["nom_utilisateur"]) && !empty($_POST["nom_utilisateur"])) {
    $data["nom_utilisateur"] = $_POST["nom_utilisateur"];
} else {
    $errors["nom_utilisateur"] = "Le champs nom utilisateur est requis. Veuillez le renseigner.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])) {
    $data["mot_de_passe"] = $_POST["mot_de_passe"];
} else {
    $errors["mot_de_passe"] = "Le champs mot de passe est requis. Veuillez le renseigner.";
}
$_SESSION ['data']= $data;

if (empty($errors)) {

    $user = check_if_user_exist($data["nom_utilisateur"], $data["mot_de_passe"], "membre", 1, 0);
    if($user){
        header('location:' . PROJECT_DIR .'bibliothecaire/utilisateur/acceuil');
    }
    else {die ('echec');    
    }
                    
    } else {
        $_SESSION['errors']= $errors;
        header('location:' . PROJECT_DIR .'bibliothecaire/connexion/index');

    }
