<?php
$_SESSION['photo-erreurs'] = "";

$data=$_SESSION['utilisateur_connecter_bibliothecaire'];

$_SESSION['photo_success']="";


$donnees = [];

$erreurs = [];

$new_data="";

$dossierUtilisateur="public/images/utilisateur_image/";





if(isset($_POST['avatar'])){

    if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter_bibliothecaire']['id'])) {
        //die(var_dump($new_data));

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
          

            if ($_FILES["image"]["size"] <= 3000000) {

                $file_name = $_FILES["image"]["name"];

                $file_info = pathinfo($file_name);

                $file_ext = $file_info["extension"];

                $allowed_ext = ["png", "jpg", "jpeg", "gif"];

                if (in_array(strtolower($file_ext), $allowed_ext)) {

                    move_uploaded_file($_FILES['image']['tmp_name'], $dossierUtilisateur . basename($_FILES['image']['name']));

                    $profiledonnees["image"] = PROJECT_DIR. $dossierUtilisateur . basename($_FILES['image']['name']);
                    

                    if (mise_a_jour_avatar($data['id'], $profiledonnees["image"])) {
                       // die(var_dump($_SESSION['users_DE']));
                        $_SESSION['utilisateur_connecter_bibliothecaire']['avatar']=recup_update_avatar($data['id']);
                        $_SESSION['photo_success']='Mise à jour de photo réussie';
                        //die(var_dump($_SESSION['users_DE']['avatar']));
                        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                        
                        

                    } else {

                        $_SESSION['photo-erreurs'] = "La mise à jour de l'image à echouer.";
                        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                    }
                } else {
                    $_SESSION['photo-erreurs'] = "L'extension de votre image n'est pas pris en compte. <br> Extensions autorisées [ PNG/JPG/JPEG/GIF ]";
                    header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                }
            } else {
                $_SESSION['photo-erreurs'] = "Fichier trop lourd. Poids maximum autorisé : 3mo";
                header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
            }
        } else {
            
             $_SESSION['photo-erreurs'] ="Une erreur est survenue lors du choix votre image,assurez vous que la taille de votre image est inférieur ou égal à 2mo";
            header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
        }
    } else {
       
        $_SESSION['photo-erreurs'] = "La mise à jour à echouer. Vérifier votre mot de passe et réessayez.";
        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
    }
}
else{
    $_SESSION['photo-erreurs']="Une erreur est survenue lors du choix votre image,assurez vous que la taille de votre image est inférieur ou égal à 2mo";
    header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
}




