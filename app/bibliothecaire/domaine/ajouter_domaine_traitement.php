<?php
$data="";
$errors="";


if (verifier_info($_POST['domaine'])) {
    $data = trim(htmlspecialchars($_POST['domaine']));
} else {
    $errors = '<p> Le champ est requis. Veuillez le renseigner! </p>';
}

if(isset($_POST['domaine']) && !empty($_POST['domaine']) && check_if_domaine_exist($_POST['domaine'])){
    $errors='Le domaine que vous essayez d\'ajouter existe déjà';
}

if(isset($_POST['domaine']) && !empty($_POST['domaine']) && !check_if_domaine_exist($_POST['domaine']) ){
    $data= trim(htmlspecialchars($_POST['domaine']));
}


if(empty($errors)){
    $resultat = ajout_domaine($data);
    if ($resultat) {
        $_SESSION['ajout-success'] = 'Domaine ajouté avec succès et disponible maintenant dans la liste des domaines';
    } else {
        $_SESSION['ajout-errors'] = "L'ajout du domaine a échoué. Veuillez reprendre le processus";
    }
} else {
    $_SESSION['ajouter-domaine-errors'] = $errors;
}

header('location:' . PROJECT_DIR . 'bibliothecaire/domaine/ajouter_domaine');