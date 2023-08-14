<?php
$errors = [];
$data = [];

// Récupération des données du formulaire
$titre = $_POST['titre-ouvrage'];
$nb_exemplaire = intval($_POST['nombre-exemplaire-ouvrage']);
$selectedAuteurId = $_POST['selected-auteur-id']; // Récupération de l'ID de l'auteur sélectionné
$periodicite = isset($_POST['periodicite-ouvrage']) ? $_POST['periodicite-ouvrage'] : null;
$selectedDomaines = isset($_POST['domaines-ouvrage']) ? $_POST['domaines-ouvrage'] : [];
$selectedAuteursSecondaires = isset($_POST['auteurs-secondaires-ouvrage']) ? $_POST['auteurs-secondaires-ouvrage'] : [];
$selectedLangues = $_POST['langue']; // Récupération des langues sélectionnées
$anneesPublication = $_POST['annee_publication']; // Récupération des années de publication

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

// Vérification des domaines
if (empty($selectedDomaines)) {
    $errors['domaine-ouvrage'] = "Aucun domaine n'a été sélectionné.";
} else {
    $data['domaine-ouvrage'] = $selectedDomaines;
}

// Vérification et traitement des champs de langue et année de publication
$langueEtAnneeErrors = [];

foreach ($selectedLangues as $index => $langue) {
    if (empty($langue)) {
        $langueEtAnneeErrors[$index] = "Veuillez sélectionner une langue et une date de publication pour chaque entrée.";
    }

    if (empty($anneesPublication[$index])) {
        $langueEtAnneeErrors[$index] = "Veuillez sélectionner une langue et une année de publication pour chaque entrée.";
    }
}

// Si des erreurs ont été trouvées, les ajouter au tableau d'erreurs principal
if (!empty($langueEtAnneeErrors)) {
    $errors['langue-ouvrage'] = $langueEtAnneeErrors;
}

// Vérifier si un ouvrage avec le même titre et le même auteur existe déjà
if (!empty($selectedAuteurId) && ouvrageExisteAvecTitreEtAuteur($titre, $selectedAuteurId)) {

    $_SESSION['ajout-ouvrage-error'] = "Un ouvrage avec le même titre et le même auteur existe déjà dans la base de données.";
}


if (empty($errors)) {
    $resultat_insertion = insererOuvrage($titre, $nb_exemplaire, $selectedAuteurId, $image_path, $periodicite);

    if ($resultat_insertion) {
        // Récupérer toutes les informations de l'ouvrage ajouté
        $ouvrage = get_all_data_ouvrage_by_id($titre, $nb_exemplaire, $selectedAuteurId, $image_path, $periodicite);
        if ($ouvrage) {
            // Maintenant vous pouvez accéder à chaque valeur spécifique de l'ouvrage
            $cod_ouv = $ouvrage['cod_ouv'];
            // Associer les domaines à l'ouvrage dans la table "domaine_ouvrage"
            foreach ($selectedDomaines as $cod_dom) {
                // Insérer dans la table "domaine_ouvrage"
                associerDomaineOuvrage($cod_dom, $cod_ouv);
            }

            // Associer les auteurs secondaires à l'ouvrage dans la table "auteur_secondaire"
            foreach ($selectedAuteursSecondaires as $num_aut) {
                associerAuteurSecondaireOuvrage($num_aut, $cod_ouv);
            }
            
            // Insérer les langues et années de publication dans la table "date_parution"
             foreach ($selectedLangues as $index => $langue) {
                $anneePublication = $anneesPublication[$index];
                insererDateParution($cod_ouv, $selectedLangues, $anneesPublication);

            }

            // Succès
            $_SESSION['ajout-ouvrage-success'] = 'L\'ouvrage a été ajouté avec succès.';
        } else {
            // Erreur lors de la récupération de l'ID de l'ouvrage
            $_SESSION['ajout-ouvrage-error'] = 'Erreur lors de la récupération de l\'ID de l\'ouvrage ajouté.';
        }
    } else {
        // Erreur lors de l'insertion de l'ouvrage
        $_SESSION['ajout-ouvrage-error'] = 'Une erreur est survenue lors de l\'ajout de l\'ouvrage.';
    }
} else {
    // Restaurer les valeurs saisies précédemment si disponibles
    if (isset($_SESSION['saisie-precedente'])) {
        $titre = $_SESSION['saisie-precedente']['titre'];
        $nb_exemplaire = $_SESSION['saisie-precedente']['nb_exemplaire'];
        $selectedAuteurId = $_SESSION['saisie-precedente']['selectedAuteurId'];
        $selectedDomaines = isset($_SESSION['saisie-precedente']['domaine-ouvrage']) ? $_SESSION['saisie-precedente']['domaine-ouvrage'] : [];
    }

    $_SESSION['saisie-precedente'] = [
        'titre' => $titre,
        'nb_exemplaire' => $nb_exemplaire,
        'selectedAuteurId' => $selectedAuteurId,
        'auteur-nom-prenom' => isset($data['auteur-nom-prenom']) ? $data['auteur-nom-prenom'] : '',
        'domaine-ouvrage' => $selectedDomaines,
    ];
    $_SESSION['ajout-ouvrage-errors'] = $errors;
}

header('Location: ' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
exit();
