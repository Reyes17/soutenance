<?php

// Récupérer le texte de la recherche depuis la requête POST
$query = isset($_POST['query']) ? $_POST['query'] : '';

// Effectuer la recherche des suggestions basées sur le titre
$suggestions = getSuggestionsByTitre($query); // Assurez-vous d'implémenter cette fonction

// Retourner les suggestions en format JSON
header('Content-Type: application/json');
echo json_encode($suggestions);
?>
