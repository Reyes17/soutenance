<?php

include '../soutenance/app/commun/fonction/fonction.php';

if (check_id_utilisateur_exist_in_db($params[3], "VALIDATION_COMPTE", $params[4], 1, 0)){
    if(maj($params[3]) && maj1($params[3])){
        $_SESSION['success'] = "Inscription éffectué avec succès. Vous pouvez vous connecter";
        header('location: /soutenance/membre/connexion/index');
    }
}else{
        echo ("echec");
    }



