<?php
$errors = [];
$data = [];

// Récupération des données du formulaire
$titre = $_POST['titre-ouvrage'];
$nb_exemplaire = intval($_POST['nombre-exemplaire-ouvrage']);
$selectedAuteurId = $_POST['auteur-principal-ouvrage']; // Récupération de l'ID de l'auteur sélectionné
$periodicite = isset($_POST['periodicite-ouvrage']) ? $_POST['periodicite-ouvrage'] : null;
$selectedLangues = $_POST['langue']; // Récupération des langues sélectionnées
$anneesPublication = $_POST['annee_publication']; // Récupération des années de publication
$nbExemplairesLangue = $_POST['nb-exemplaire-langue']; // Récupération du nombre d'exemplaires par langue

// Vérification et traitement des champs
if (empty($titre)) {
    $errors['titre-ouvrage'] = "Ce champ est requis.";
} else {
    $data['titre-ouvrage'] = ucfirst(trim(htmlspecialchars($titre)));;
}

// Vérification du nombre d'exemplaires
if (empty($nb_exemplaire)) {
    $errors['nombre-exemplaire-ouvrage'] = "Veuillez entrer un nombre valide.";
}else{
    $data['nombre-exemplaire-ouvrage'] = intval($nb_exemplaire);
}

// Vérification de l'auteur principal
if (empty($selectedAuteurId)) {
    $errors['auteur-principal-ouvrage'] = "Veuillez sélectionner un auteur.";
} else {
    // Utiliser la fonction pour récupérer l'auteur complet par son ID
    $auteur = get_auteur_by_id($selectedAuteurId);
    if ($auteur) {
        $data['auteur-principal-ouvrage'] = $selectedAuteurId;
    } else {
        $errors['auteur-principal-ouvrage'] = "L'auteur sélectionné n'est pas valide.";
    }
}

// Vérification de l'auteur secondaire
if (!empty($_POST['auteurs-secondaires-ouvrage']) && is_array($_POST['auteurs-secondaires-ouvrage'])) {
    // Assurez-vous que les auteurs secondaires sont valides et associez-les à l'ouvrage
    foreach ($_POST['auteurs-secondaires-ouvrage'] as $key => $auteur_secondaire) {
        if (check_if_exist('auteur', 'num_aut', $auteur_secondaire)) {
            $data['auteurs-secondaires-ouvrage'][] = $auteur_secondaire;
        } else {
            if (empty($_SESSION['ajout-ouvrage-error'])) {
                $_SESSION['ajout-ouvrage-error'] = 'Une action inattendue au niveau du champs Auteurs Secondaires bloque le processus.';
            }
        }
    }
} 


// Vérification de l'image
if (!empty($_FILES['image-ouvrage'])) {
    if (isset($_FILES["image-ouvrage"]) && $_FILES["image-ouvrage"]["error"] == 0) {

        if ($_FILES["image-ouvrage"]["size"] <= 3000000) {

            $file_name = $_FILES["image-ouvrage"]["name"];

            $file_info = pathinfo($file_name);

            $file_ext = $file_info["extension"];

            $allowed_ext = ["png", "jpg", "jpeg", "gif", "webp"];

            if (in_array(strtolower($file_ext), $allowed_ext)) {

                if (!is_dir("public/ouvrage/image")) {
                    if (!mkdir("public/ouvrage/image", 0755, true)) {
                        $_errors['image-ouvrage'] = "Impossible de créer le répertoire de destination pour l'image.";
                    }
                }

                $new_file_name = uniqid() . '.' . $file_ext;
                $file_path = "public/ouvrage/image/" . $new_file_name;

                if (move_uploaded_file($_FILES['image-ouvrage']['tmp_name'], $file_path)) {
                    $image_path = PROJECT_DIR . $file_path;
                } else {
                    $errors['image-ouvrage'] = "Une erreur est survenue lors du téléchargement de l'image.";
                }
            } else {
                $errors['image-ouvrage'] = "L'extension de votre image n'est pas prise en compte. Extensions autorisées : [PNG/JPG/JPEG/GIF/WEBP]";
            }
        } else {
            $errors['image-ouvrage'] = "Image trop lourde. Poids maximum autorisé : 3 Mo";
        }
    } else {
        $errors['image-ouvrage'] = "Une erreur est survenue lors du téléchargement de l'image.";
    }
} else {
    $errors['image-ouvrage'] = 'Champ requis.';
}


// Vérification des domaines
if (is_array($_POST['domaines-ouvrage'])) {

    if (!empty($_POST['domaines-ouvrage']) && $_POST['domaines-ouvrage'][0] != 0) {

        foreach ($_POST['domaines-ouvrage'] as $key => $domaine) {
            if (check_if_exist('domaine', 'cod_dom', $domaine)) {
                $data['domaines-ouvrage'][] = $domaine;
            } else {
                if (empty($_SESSION['ajout-ouvrage-error'])) {
                    $_SESSION['ajout-ouvrage-error'] = "Une erreur inattendue au niveau du champ Domaines bloque le processus.Contactez l'adminstrateur";
                }
            }
        }
    } else {
       $errors['domaines-ouvrage'] = 'Champs requis.';
    }
} else {
    $errors['domaines-ouvrage'] = 'Champs requis.';
    }

// ... Vérification et traitement des champs de langue, année de publication et exemplaire par langue
$champsLangueAnneeExemplaireErrors = [];

// Initialisation d'une variable pour stocker le total des exemplaires par langue
$totalExemplairesLangue = 0;

foreach ($selectedLangues as $index => $langue) {
    if (empty($langue)) {
        $champsLangueAnneeExemplaireErrors[$index][] = "Veuillez sélectionner une langue.";
    }

    if (empty($anneesPublication[$index])) {
        $champsLangueAnneeExemplaireErrors[$index][] = "Veuillez sélectionner une année de publication.";
    }

    if (empty($nbExemplairesLangue[$index])) {
        $champsLangueAnneeExemplaireErrors[$index][] = "Veuillez entrer le nombre d'exemplaires pour cette langue.";
    } else {
        $totalExemplairesLangue += intval($nbExemplairesLangue[$index]);
    }
}

// Si des erreurs ont été trouvées, les ajouter au tableau d'erreurs principal
if (!empty($champsLangueAnneeExemplaireErrors)) {
    $_SESSION['ouvrage-errors'] = $champsLangueAnneeExemplaireErrors;
}

// Vérifier si la somme des exemplaires par langue correspond au nombre total d'exemplaires
if ($totalExemplairesLangue !== $nb_exemplaire) {
    $_SESSION['ajout-ouvrage-error'] = "La somme des exemplaires par langue ne correspond pas au nombre total d'exemplaires.";
}

// ... La suite de votre script de traitement


// Vérifier si un ouvrage avec le même titre et le même auteur existe déjà
if (!empty($selectedAuteurId) && ouvrageExisteAvecTitreEtAuteur($titre, $selectedAuteurId)) {
    $_SESSION['ajout-ouvrage-error'] = "Un ouvrage avec le même titre et le même auteur existe déjà dans la base de données.";
   

}

// Insérer les langues, années de publication et exemplaires par langue dans la table "date_parution"
if (empty($errors) && empty($_SESSION['ajout-ouvrage-error'])) {
    $resultat_insertion = insererOuvrage($titre, $nb_exemplaire, $selectedAuteurId, $image_path, $periodicite);

    if ($resultat_insertion) {
        // Récupérer toutes les informations de l'ouvrage ajouté
        $ouvrage = get_all_data_ouvrage_by_id($titre, $nb_exemplaire, $selectedAuteurId, $image_path, $periodicite);
        if ($ouvrage) {
            // Maintenant vous pouvez accéder à chaque valeur spécifique de l'ouvrage
            $cod_ouv = $ouvrage['cod_ouv'];

            // Associer les domaines à l'ouvrage dans la table "domaine_ouvrage"
            foreach ($data['domaines-ouvrage'] as $cod_dom) {
                // Insérer dans la table "domaine_ouvrage"
                associerDomaineOuvrage($cod_dom, $cod_ouv);
            }

             // Associer les auteurs secondaires à l'ouvrage dans la table "auteur_secondaire"
             if (!empty($data['auteurs-secondaires-ouvrage'])) {
                foreach ($data['auteurs-secondaires-ouvrage'] as $num_aut) {
                    associerAuteurSecondaireOuvrage($num_aut, $cod_ouv);
                }
            }
            
            // Insérer les langues et années de publication dans la table "date_parution"
            if (insererDateParution($cod_ouv, $selectedLangues, $anneesPublication, $nbExemplairesLangue)) {
                // Succès
                $_SESSION['ajout-ouvrage-success'] = 'L\'ouvrage a été ajouté avec succès.';
            } else {
                // Erreur lors de l'insertion dans la table date_parution
                $_SESSION['ajout-ouvrage-error'] = 'Une erreur est survenue lors de l\'insertion dans la table date_parution.';
            }
        } else {
            // Erreur lors de la récupération de l'ID de l'ouvrage
            $_SESSION['ajout-ouvrage-error'] = 'Erreur lors de la récupération de l\'ID de l\'ouvrage ajouté.';
        }
    } else {
        // Erreur lors de l'insertion de l'ouvrage
        $_SESSION['ajout-ouvrage-error'] = 'Une erreur est survenue lors de l\'ajout de l\'ouvrage.';
    }
} else {
    $_SESSION['data'] = $data;
    $_SESSION['ajout-ouvrage-errors'] = $errors; 
}

header('Location: ' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter_ouvrage');
exit();