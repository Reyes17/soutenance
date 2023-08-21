<?php
if (isset($_GET['q'])) {
    $texteRecherche = $_GET['q'];

    // Appeler une fonction pour récupérer les auteurs correspondant à la recherche
    $suggestions = get_auteurs_suggestions($texteRecherche);

    // Renvoyer les suggestions au format JSON
    header('Content-Type: application/json');
    echo json_encode($suggestions);
    exit();
} else {
    // Le paramètre 'q' n'est pas défini, renvoyer une réponse vide
    echo json_encode([]);
}
?>
associerDomaineOuvrage($cod_dom, $cod_ouv);
associerAuteurSecondaireOuvrage($num_aut, $cod_ouv);
insererDateParution($cod_ouv, $selectedLangues, $anneesPublication);
$ouvrage = get_all_data_ouvrage_by_id($titre, $nb_exemplaire, $selectedAuteurId, $image_path, $periodicite);