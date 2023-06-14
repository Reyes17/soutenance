<?php
$_SESSION['save_errors'] = [];

$data = [];

$errors = [];

if (!isset($_POST["mot_de_passe"]) || empty($_POST["mot_de_passe"])) {
	$errors["mot_de_passe"] = "Le champ du mot de passe est vide. Veuillez le renseigner.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) < 8) {
	$errors["mot_de_passe"] = "Le champ doit contenir minimum 8 caractères. Les espaces ne sont pas pris en compte.";
}

if (isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && empty($_POST["confirmer_mot_de_passe"])) {
	$errors["confirmer_mot_de_passe"] = "Entrez votre mot de passe à nouveau.";
}

if ((isset($_POST["confirmer_mot_de_passe"]) && !empty($_POST["confirmer_mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && $_POST["confirmer_mot_de_passe"] != $_POST["mot_de_passe"])) {
	$errors["confirmer_mot_de_passe"] = "Mot de passe erroné. Entrez le mot de passe du précédent champs";
}

if ((isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) && strlen(($_POST["mot_de_passe"])) >= 8 && $_POST["confirmer_mot_de_passe"] == $_POST["mot_de_passe"])) {
    $data["mot_de_passe"] = trim(htmlentities($_POST['mot_de_passe']));
}

if (empty($errors)) {

    if (update_password_in_db($_SESSION['id_user'], $data["mot_de_passe"])) {
        session_destroy();
        header('location:' . PROJECT_DIR . 'membre/connexion');
    } else {
        $_SESSION['save_errors'] = "La modification du mot de passe n'a pas pu s'effectuer. Veuillez réessayer en vous assurant de bien insérer les données cette fois-ci. ";
        header('location: ' . PROJECT_DIR . 'membre/reinitialiser_mot_passe');
    }
} else {
    $_SESSION['errors'] = $errors;
    header('location: ' . PROJECT_DIR . 'membre/reinitialiser_mot_passe');
}