<?php
// Inclure votre configuration et fonctions de base

// Récupérer la valeur du champ de recherche
$query = !empty($_POST['query']) ? $_POST['query'] : '';

// Effectuer la recherche en fonction du titre
$suggestions = get_liste_ouvrages($query);

// Générer la sortie HTML pour les suggestions
foreach ($suggestions as $suggestion) {
    echo '<div class="suggestion">' . htmlspecialchars($suggestion['titre']) . '</div>';
}
?>
