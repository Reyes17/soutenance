<?php

include 'app/commun/fonction/fonction.php';
session_start();
$data=[];
$errors=[];
$danger=[];
$_SESSION['data']= [];
if (isset($_POST["nom_utilisateur"]) && !empty($_POST["nom_utilisateur"])) {
    $data["nom_utilisateur"] = $_POST['nom_utilisateur'];
} else {
    $errors["nom_utilisateur"] = "Le champs nom utilisateur est requis. Veuillez le renseigner.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])) {
    $data["mot_de_passe"] = trim(htmlentities($_POST['mot_de_passe']));
} else {
    $errors["mot_de_passe"] = "Le champs mot de passe est requis. Veuillez le renseigner.";
}
$_SESSION ['data']= $data;
$_SESSION['danger'] = "";

if (empty($errors)) {

    $user = check_if_user_exist($data["nom_utilisateur"], $data["mot_de_passe"], "membre", 1, 0);
    if($user){       
        header('location:' . PROJECT_DIR .'membre/utilisateur/acceuil');
    }
    else {$_SESSION['danger'] = "Mot de passe ou nom d'utilisateur incorrect. Veuillez vérifier";  
        header('location:' . PROJECT_DIR .'membre/connexion') ;
    }
                    
    } else {
        $_SESSION['errors']= $errors;
        header('location:' . PROJECT_DIR .'membre/connexion/index');

    }
