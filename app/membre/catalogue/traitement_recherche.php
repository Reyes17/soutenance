<?
// Vérifier si le formulaire a été soumis
if (!empty($_POST['search'])) {
    // Récupérer la valeur du champ "titre" soumis
    $titre = !empty($_POST['titre']) ? $_POST['titre'] : '';
    
    // Effectuer la recherche en fonction du titre
    $liste_ouvrages = get_liste_ouvrages($titre);
    
    // Redirigez l'utilisateur vers la page "liste_des_ouvrages" avec les résultats de la recherche
    header("Location: " . PROJECT_DIR . "membre/catalogue/index");
    exit();
}

