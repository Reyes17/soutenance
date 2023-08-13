<?php
$errors = [];
$data = [];

// Récupération des données du formulaire
$titre = $_POST['titre-ouvrage'];
$nb_exemplaire = intval($_POST['nombre-exemplaire-ouvrage']);
$selectedAuteurId = $_POST['selected-auteur-id']; // Récupération de l'ID de l'auteur sélectionné

// Restaurer les valeurs saisies précédemment si disponibles
if (isset($_SESSION['saisie-precedente'])) {
    $titre = $_SESSION['saisie-precedente']['titre'];
    $nb_exemplaire = $_SESSION['saisie-precedente']['nb_exemplaire'];
    $selectedAuteurId = $_SESSION['saisie-precedente']['selectedAuteurId'];
}

// Vérification et traitement des champs
if (empty($titre)) {
    $errors['titre-ouvrage'] = "Le champ titre est requis. Veuillez le renseigner!";
} else {
    $data['titre-ouvrage'] = trim(htmlentities($titre));
}

// Vérification du nombre d'exemplaires
if ($nb_exemplaire < 1 || $nb_exemplaire > 200) {
    $errors['nombre-exemplaire-ouvrage'] = "Sélectionner un nombre d'exemplaire valide.";
} else {
    $data['nombre-exemplaire-ouvrage'] = $nb_exemplaire;
}

// Vérification de l'auteur principal
if (empty($selectedAuteurId)) {
    $errors['auteur-principal-ouvrage'] = "Veuillez sélectionner un auteur principal.";
} else {
    // Utiliser la fonction pour récupérer l'auteur complet par son ID
    $auteur = get_auteur_by_id($selectedAuteurId);
    if ($auteur) {
        $data['auteur-principal-ouvrage'] = $selectedAuteurId;
    } else {
        $errors['auteur-principal-ouvrage'] = "L'auteur sélectionné n'est pas valide.";
    }
}

// Vérification de l'image
if (isset($_FILES['image-ouvrage']) && $_FILES['image-ouvrage']['error'] === UPLOAD_ERR_OK) {
    $image_info = $_FILES['image-ouvrage'];
    $image_name = $image_info['name'];
    $image_tmp_name = $image_info['tmp_name'];
    $image_size = $image_info['size'];
    
    // Vérification de l'extension de l'image
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    if (!in_array($image_extension, $allowed_extensions)) {
        $errors['image-ouvrage'] = "L'extension de l'image n'est pas autorisée. Les extensions autorisées sont : " . implode(', ', $allowed_extensions);
    }

    // Vérification de la taille de l'image (2Mo)
    $max_image_size = 2 * 1024 * 1024; // 2 Mo
    if ($image_size > $max_image_size) {
        $errors['image-ouvrage'] = "La taille de l'image dépasse la limite autorisée (2 Mo).";
    }

    if (empty($errors['image-ouvrage'])) {
        // Déplace l'image vers le répertoire public/ouvrage/image
        $upload_dir = 'public/ouvrage/image/';
        $image_path = $upload_dir . $image_name;

        if (!move_uploaded_file($image_tmp_name, $image_path)) {
            $errors['image-ouvrage'] = "Une erreur s'est produite lors du téléchargement de l'image.";
        } else {
            $data['image-ouvrage'] = $image_path;
        }
    }
} else {
    $errors['image-ouvrage'] = "Veuillez ajouter une image.";
}

// Si aucune erreur n'a été trouvée, procédez à l'insertion dans la base de données
if (empty($errors)) {
    $resultat_insertion = insererOuvrage($titre, $nb_exemplaire, $selectedAuteurId, $image_path);

    if ($resultat_insertion) {
        // Succès
        $_SESSION['ajout-ouvrage-success'] = 'L\'ouvrage a été ajouté avec succès.';
    } else {
        // Erreur
        $_SESSION['ajout-ouvrage-error'] = 'Une erreur est survenue lors de l\'ajout de l\'ouvrage.';
    }
} else {
    $_SESSION['saisie-precedente'] = [
        'titre' => $titre,
        'nb_exemplaire' => $nb_exemplaire,
        'selectedAuteurId' => $selectedAuteurId,
        
    ];
    $_SESSION['ajout-ouvrage-errors'] = $errors;
}

header('Location: ' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
exit();
?>