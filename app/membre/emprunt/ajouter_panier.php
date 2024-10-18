<?php
// ajouter_au_panier

// Récupérer les données du formulaire
$titre = $_POST['titre'];
$langue = $_POST['langue'];
$ouvrageId = $_POST['ouvrage_id'];

// Initialiser le panier s'il n'existe pas encore
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Ajouter l'ouvrage au panier
$_SESSION['panier'][] = array('titre' => $titre, 'langue' => $langue, 'ouvrage_id' => $ouvrageId);

// Répondre avec succès
echo json_encode(array('success' => true));
?>
