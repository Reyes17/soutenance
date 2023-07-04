<?php

// Traitement de la suppression de l'auteur
if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    
   
    $nom_aut = $_GET['nom_aut'];
        
       
    $prenom_aut = $_GET['prenom_aut'];
             
    $suppression_effectuee = delete_auteur($nom_aut, $prenom_aut);
        
    if ($suppression_effectuee) {
            
           
    $_SESSION['delete'] = "L'auteur a été supprimé avec succès.";
        } else {
            $_SESSION['undelete'] = "Échec de la suppression de l'auteur ou l'auteur n'existe pas.";
        }

 } 
header('location:'. PROJECT_DIR .'bibliothecaire/dossier/liste_des_auteurs');
