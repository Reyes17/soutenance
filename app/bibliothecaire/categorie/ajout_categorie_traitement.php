<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_cat = trim($_POST['nom_cat']);
    $domaine = intval($_POST['domaine']);

    $errors = array();

    // Vérification des champs obligatoires
    if (empty($nom_cat)) {
        $errors['nom_cat'] = "Le champ catégorie est requis.";
    }

    if ($domaine <= 0) {
        $errors['domaine'] = "Veuillez sélectionner un domaine.";
    }

    // Vérification si la catégorie existe déjà dans la base de données
    if (isset($_POST['nom_cat']) && !empty($_POST['nom_cat']) && check_if_categorie_exist($_POST['nom_cat'])) {
        $errors['nom_cat'] = "La catégorie que vous essayez d'ajouter existe déjà.";
    }

    // S'il y a des erreurs, on redirige vers la page d'ajout de catégorie avec les messages d'erreur
    if (!empty($errors)) {
        $_SESSION['ajouter-categorie-errors'] = $errors;
        header('location:' . PROJECT_DIR . 'bibliothecaire/categorie/ajouter_categorie');
        exit;
    }

    // Si tout est valide, on ajoute la catégorie à la base de données
    $ajout_categorie = ajout_categorie($nom_cat, $domaine);

    // Gestion des messages de succès ou d'erreur global
    if ($ajout_categorie) {
        $_SESSION['ajout-success'] = "La catégorie a été ajoutée avec succès.";
    } else {
        $_SESSION['ajout-errors'] = "L'ajout de la catégorie a échoué. Veuillez réessayer.";
    }

    header('location:' . PROJECT_DIR . 'bibliothecaire/categorie/ajouter_categorie');
    exit;
}
