<?php

// Traitement de la suppression de l'auteur
if (isset($params['3']) && !empty($params['3']) && is_numeric($params['3'])) {
    $id = $params['3'];

    // Appel de la fonction pour supprimer l'auteur
    $result = supprimer_auteur_secondaire($id);

    if ($result) {
        $_SESSION['suppression_succes'] = "L'auteur secondaire a été supprimé avec succès";
    } else {
        $_SESSION['suppression_erreur'] = "Erreur lors de la suppression de l'auteur secondaire";
    }

    // Redirection vers la liste des auteurs
    header('location:' . PROJECT_DIR . 'bibliothecaire/auteur_secondaire/liste_des_auteurs_secondaires');
    exit();
}

?>
