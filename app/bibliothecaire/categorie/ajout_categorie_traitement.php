<?php
$data="";
$errors="";


if (verifier_info($_POST['nom_cat'])) {
    $data = trim(htmlentities($_POST['nom_cat']));
} else {
    $errors = '<p> Le champ est requis. Veuillez le renseigner! </p>';
}

if(isset($_POST['nom_cat']) && !empty($_POST['nom_cat']) && check_if_categorie_exist($_POST['nom_cat'])){
    $errors='La langue que vous essayez d\'ajouter existe déjà';
}

if(isset($_POST['nom_cat']) && !empty($_POST['nom_cat']) && !check_if_categorie_exist($_POST['nom_cat']) ){
    $data= trim(htmlentities($_POST['nom_cat']));
}


if(empty($errors)){
    $resultat = ajout_categorie($data);
    if ($resultat) {
        $_SESSION['ajout-success'] = 'Catégorie ajoutée avec succès et disponible maintenant dans la liste des catégories';
    } else {
        $_SESSION['ajout-errors'] = "L'ajout de la catégorie a échoué. Veuillez reprendre le processus";
    }
} else {
    $_SESSION['ajouter-categorie-errors'] = $errors;
}

header('location:' . PROJECT_DIR . 'bibliothecaire/categorie/ajouter_categorie');