<?php


$errors = [];
$data = [];

// Récupération des données du formulaire
$titre = $_POST['titre-ouvrage'];
$nb_exemplaire = intval($_POST['nombre-exemplaire-ouvrage']);
$auteur_principal_id = intval($_POST['auteur-principal-ouvrage']);
$auteurs_secondaires = $_POST['auteurs-secondaires-ouvrage'];
$domaines = $_POST['domaine-ouvrage'];
$langues = $_POST['langue'];
$dates_parution = $_POST['annee_publication'];

// Vérification et traitement des champs
if (empty($titre)) {
    $errors['titre-ouvrage'] = "Le champ titre est requis. Veuillez le renseigner!";
} else {
    $data['titre-ouvrage'] = trim(htmlentities($titre));
}

// Vérification du nombre d'exemplaires
if ($nb_exemplaire < 1 || $nb_exemplaire > 200) {
    $errors['nombre-exemplaire-ouvrage'] = "Le nombre d'exemplaires doit être compris entre 1 et 200.";
} else {
    $data['nombre-exemplaire-ouvrage'] = $nb_exemplaire;
}

// Vérification de l'auteur principal
if (empty($auteur_principal_id)) {
    $errors['auteur-principal-ouvrage'] = "Veuillez sélectionner un auteur principal.";
} else {
    $data['auteur-principal-ouvrage'] = $auteur_principal_id;
}

// Vérification de l'image
// Vérification du fichier image
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
    $errors['image-ouvrage'] = "Une erreur s'est produite lors de l'envoi de l'image.";
}


// Vérification des auteurs secondaires
$data['auteurs-secondaires-ouvrage'] = $auteurs_secondaires;

// Vérification des domaines
if (empty($domaines)) {
    $errors['domaine-ouvrage'] = "Aucun domaine n'a été sélectionné.";
} else {
    $data['domaine-ouvrage'] = $domaines;
}

// Vérification des langues et dates de parution
foreach ($langues as $index => $langue) {
    if ($langue == 0 || empty($dates_parution[$index])) {
        $errors['langue-ouvrage'] = "Veuillez sélectionner une langue et une date de publication pour chaque entrée.";
        break;
    }
}

if (empty($errors)) {
    $id_ouvrage = ajouterOuvrage($data['titre-ouvrage'], $data['nombre-exemplaire-ouvrage'], $data['auteur-principal-ouvrage'], $image_path);

    if ($id_ouvrage) {
        associerAuteursSecondairesOuvrage($id_ouvrage, $data['auteurs-secondaires-ouvrage']);
        ajouterDomainesOuvrage($id_ouvrage, $data['domaine-ouvrage']);
        associerLanguesDatesParutionOuvrage($id_ouvrage, $langues, $dates_parution);
        $_SESSION['ajout-ouvrage-success'] = "L'ouvrage a été ajouté avec succès.";
    } else {
        $_SESSION['ajout-ouvrage-error'] = "Une erreur s'est produite lors de l'ajout de l'ouvrage.";
    }
} else {
    $_SESSION['ajout-ouvrage-errors'] = $errors;
}

// Redirection vers la page d'ajout d'ouvrage avec les messages d'erreur ou de succès
header('location:' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
exit;
?>
