<?php

$_SESSION['photo-erreurs'] = "";

$_SESSION['donnees-utilisateur'] = [];

$data = $_SESSION['utilisateur_connecter_membre'];

$errors = [];

$new_data = [];

$idUtilisateur = $_SESSION['utilisateur_connecter_membre']['nom_utilisateur'];

$dossierUtilisateur = "public/image/upload/";


if (isset($_POST['avatar'])) {

    if (check_password_exist(($_POST['mot_de_passe']), $_SESSION['utilisateur_connecter_membre']['id'])) {

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

            if ($_FILES["image"]["size"] <= 3000000) {

                $file_name = $_FILES["image"]["name"];

                $file_info = pathinfo($file_name);

                $file_ext = $file_info["extension"];

                $allowed_ext = ["png", "jpg", "jpeg", "gif"];

                if (in_array(strtolower($file_ext), $allowed_ext)) {

                    move_uploaded_file($_FILES['image']['tmp_name'], $dossierUtilisateur . basename($_FILES['image']['name']));

                    $profiledonnees["image"] = PROJECT_DIR . $dossierUtilisateur . basename($_FILES['image']['name']);

                    if (mise_a_jour_avatar($_SESSION['utilisateur_connecter_membre']['id'], $profiledonnees["image"])) {

                       $new_data = recup_mettre_a_jour_informations_utilisateur($_SESSION['utilisateur_connecter_membre']['id']);
                        if (!empty($new_data)) {
                            $_SESSION['utilisateur_connecter_membre'] = $new_data;        
                           header('location: ' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
                        }
                    } else {

                        $_SESSION['photo-erreurs'] = "La mise à jour de l'image à echouer.";
                        header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
                    }
                } else {
                    $_SESSION['photo-erreurs'] = "L'extension de votre image n'est pas pris en compte. <br> Extensions autorisées [ PNG/JPG/JPEG/GIF ]";
                    header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
                }
            } else {
                $_SESSION['photo-erreurs'] = "Fichier trop lourd. Poids maximum autorisé : 3mo";
                header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
            }
        } else {

            $profiledonnees["image"] = $data["avatar"];
        }
    } else {
        $_SESSION['photo-erreurs'] = "La mise à jour à echouer. Vérifier votre mot de passe et réessayez.";
        header('location:' . PROJECT_DIR . 'membre/mon_profil/mon-profil');
    }
}
