<?php

if (isset($_SESSION['panier'])) {
    // Récupérer l'index de l'ouvrage à retirer
    $index = isset($_POST['index']) ? $_POST['index'] : null;

    // Retirer l'ouvrage du panier
    if ($index !== null && isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
    }
}

// Redirection vers la page du formulaire après le retrait
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
