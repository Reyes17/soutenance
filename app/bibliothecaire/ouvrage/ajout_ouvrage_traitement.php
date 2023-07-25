<?php
// Initialisation des variables pour conserver les valeurs des champs après la soumission du formulaire
$titre = $nb_ex = $auteur_principal = $auteur_secondaire = $domaine = $langue = $categorie = $annee_publication = '';
$image_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre = trim($_POST['titre-ouvrage']);
    $nb_ex = intval($_POST['nombre-exemplaire-ouvrage']);
    $auteur_principal = intval($_POST['auteur-principal-ouvrage']);
    $auteur_secondaire = isset($_POST['auteurs-secondaires-ouvrage']) ? intval($_POST['auteurs-secondaires-ouvrage']) : null;
    $domaine = intval($_POST['domaine-ouvrage']);
    $langue = intval($_POST['langue-ouvrage']);
    $categorie = intval($_POST['categorie-ouvrage']);
    $annee_publication = isset($_POST['annee-publication']) ? $_POST['annee-publication'] : null;

    // Vérification des champs obligatoires
    $errors = array();

    if (empty($titre)) {
        $errors['titre-ouvrage'] = "Le champ titre est requis.";
    }

    if ($nb_ex <= 0) {
        $errors['nombre-exemplaire-ouvrage'] = "Le nombre d'exemplaires doit être supérieur à zéro.";
    }

    if ($auteur_principal <= 0) {
        $errors['auteur-principal-ouvrage'] = "Veuillez sélectionner un auteur principal.";
    }

    if ($domaine <= 0) {
        $errors['domaine-ouvrage'] = "Veuillez sélectionner un domaine.";
    }

    if ($langue <= 0) {
        $errors['langue-ouvrage'] = "Veuillez sélectionner une langue.";
    }

    if ($categorie <= 0) {
        $errors['categorie-ouvrage'] = "Veuillez sélectionner une catégorie.";
    }

    if (empty($annee_publication)) {
        $errors['annee-publication'] = "Le champ année de publication est requis.";
    } elseif (!preg_match('/^\d{4}$/', $annee_publication)) {
        $errors['annee-publication'] = "L'année de publication n'est pas valide.";
    }

    // Vérification du champ d'image (s'il est requis)
    if (empty($_FILES['image-ouvrage']['name'])) {
        $errors['image-ouvrage'] = "Le champ image est requis.";
    } else {
        // Contrôler la taille du fichier image (exemple : 5 Mo)
        $max_file_size = 5 * 1024 * 1024; // 5 Mo en octets
        if ($_FILES['image-ouvrage']['size'] > $max_file_size) {
            $errors['image-ouvrage'] = "La taille de l'image est trop grande. La taille maximale autorisée est de 5 Mo.";
        }

        // Contrôler l'extension du fichier image
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_info = pathinfo($_FILES['image-ouvrage']['name']);
        $file_extension = strtolower($file_info['extension']);
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors['image-ouvrage'] = "Le type de fichier n'est pas pris en charge. Veuillez télécharger une image au format JPG, JPEG, PNG ou GIF.";
        }
    }

    // S'il y a des erreurs, on redirige vers la page d'ajout d'ouvrage avec les messages d'erreur
    if (!empty($errors)) {
        $_SESSION['ajout-ouvrage-errors'] = $errors;
        header('location:' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
        exit;
    }

    // Vérification de l'appartenance de la catégorie au domaine
    $categorie_appartient_au_domaine = check_categorie_domaine($categorie, $domaine);

    if (!$categorie_appartient_au_domaine) {
        $_SESSION['ajout-ouvrage-error'] = "La catégorie sélectionnée ne correspond pas au domaine choisi.";
        header('location:' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
        exit;
    }

    // Déplacement du fichier image vers le répertoire final s'il est envoyé
    if (!empty($_FILES['image-ouvrage']['name'])) {
        $destination_directory = 'public/ouvrage/image/';
        $image_name = uniqid() . '.' . $file_extension;
        $image_path = $destination_directory . $image_name;

        if (move_uploaded_file($_FILES['image-ouvrage']['tmp_name'], $image_path)) {
            // Le fichier a été déplacé avec succès, vous pouvez maintenant stocker le chemin dans la base de données
            // Assurez-vous de stocker la variable $image_path dans la base de données pour récupérer l'image ultérieurement
            $image = $image_path;
        } else {
            $errors['image-ouvrage'] = "Une erreur s'est produite lors du téléchargement de l'image. Veuillez réessayer.";
        }
    }

    // Si tout est valide, on ajoute l'ouvrage à la base de données
    $ajout_ouvrage = ajout_ouvrage($titre, $nb_ex, $auteur_principal, $auteur_secondaire, $domaine, $langue, $categorie, $annee_publication, $image);

    // Gestion des messages de succès ou d'erreur global
    if ($ajout_ouvrage) {
        $_SESSION['ajout-ouvrage-success'] = "L'ouvrage a été ajouté avec succès.";
    } else {
        $_SESSION['ajout-ouvrage-error'] = "L'ajout de l'ouvrage a échoué. Veuillez réessayer.";
    }

    header('location:' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
    exit;
}
?>
