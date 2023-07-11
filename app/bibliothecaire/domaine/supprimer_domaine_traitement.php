<?php

// Traitement de la suppression de la langue
if (isset($params['3']) && !empty($params['3']) && is_numeric($params['3'])) {
    $cod_dom = $params['3'];

    // Appel de la fonction pour supprimer la langue
    $result = supprimer_domaine($cod_dom);

    if ($result) {
        $_SESSION['suppression_succes'] = "Le domaine a été supprimée! ";
    } else {
        $_SESSION['suppression_erreur'] = "Une erreur est survenue lors de la suppression. Veuillez réessayer.";
    }

    // Redirection vers la liste des langues
    header('location:' . PROJECT_DIR . 'bibliothecaire/domaine/liste_des_domaines');
    exit();
}

?>