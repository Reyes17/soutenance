<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    // Récupérer l'identifiant de l'utilisateur à partir de la session (vous devez mettre en place la gestion de l'authentification)
   
    // Connexion à la base de données
    $db = connect_db();

    // Début de la transaction
    $db->beginTransaction();

    try {
        // Ajouter un nouvel emprunt
        $numEmp = ajouterEmprunt($db, $userId);

        // Vérifier si l'ajout de l'emprunt a réussi
        if ($numEmp !== false) {
            // Ajouter chaque ouvrage de la session à l'emprunt
            foreach ($_SESSION['panier'] as $ouvrage) 
            foreach($_SESSION['panier'] as $langue) {
                associerOuvrageEmprunt($db, $numEmp, $ouvrage['ouvrage_id'], $langue['langue']);
            }

            // Commit de la transaction
            $db->commit();

            // Effacer le panier de l'utilisateur après l'emprunt
            unset($_SESSION['panier']);

            // Envoi de la notification à l'utilisateur
            $_SESSION['notification'] = "Votre demande d'emprunt a été soumise avec succès. Veuillez patienter pour qu'elle soit validée. Consultez votre historique d'emprunt pour connaître le statut de votre emprunt. Merci.";

        } else {
            // En cas d'échec, annuler la transaction
            $db->rollBack();

            // Message d'erreur
            $_SESSION['notification'] = "Erreur lors de la soumission de la demande d'emprunt. Veuillez réessayer.";
        }
    } catch (Exception $e) {
        // En cas d'exception, annuler la transaction et afficher l'erreur
        $db->rollBack();
        $_SESSION['notification'] = "Erreur : " . $e->getMessage();
    }
} else {
   
}
// Redirection vers la page du formulaire avec la notification
header('location: ' . PROJECT_DIR . 'emprunt/formulaire_emprunt');
exit();
?>
