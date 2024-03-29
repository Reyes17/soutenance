<?php
$data="";
$errors="";


if (verifier_info($_POST['langue'])) {
    $data = trim(htmlspecialchars($_POST['langue']));
} else {
    $errors = '<p> Le champ est requis. Veuillez le renseigner! </p>';
}

if(isset($_POST['langue']) && !empty($_POST['langue']) && check_if_langue_exist($_POST['langue'])){
    $errors='La langue que vous essayez d\'ajouter existe déjà';
}

if(isset($_POST['langue']) && !empty($_POST['langue']) && !check_if_langue_exist($_POST['langue']) ){
    $data= trim(htmlspecialchars($_POST['langue']));
}


if(empty($errors)){
    $resultat = ajout_langue($data);
    if ($resultat) {
        $_SESSION['ajout-success'] = 'Langue ajoutée avec succès et disponible maintenant dans la liste des langues';
    } else {
        $_SESSION['ajout-errors'] = "L'ajout de la langue a échoué. Veuillez reprendre le processus";
    }
} else {
    $_SESSION['ajouter-langue-errors'] = $errors;
}

header('location:' . PROJECT_DIR . 'bibliothecaire/langue/ajouter_langue');