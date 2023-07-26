<?php
function get_categories_by_domaine(int $domaine)
{
    $db = connect_db();
    // Requête SQL pour récupérer les catégories associées à ce domaine
    $requete_categories = 'SELECT cod_cat, nom_cat FROM categorie WHERE cod_dom = :domaine';
    $recuperer_categories = $db->prepare($requete_categories);
    $recuperer_categories->bindValue(':domaine', $domaine, PDO::PARAM_INT); // Lier le paramètre :domaine_id à sa valeur
    $recuperer_categories->execute();

    // Récupérer les résultats sous forme d'un tableau associatif
    $categories = $recuperer_categories->fetchAll(PDO::FETCH_ASSOC);

    // Convertir le tableau en format JSON et le renvoyer
    return json_encode($categories);
}


?>
