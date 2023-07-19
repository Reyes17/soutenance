<?php
$_SESSION['photo-erreurs'] = "";
$data = $_SESSION['utilisateur_connecter_bibliothecaire'];
$_SESSION['photo_success'] = "";
$dossierUtilisateur = "public/image/utilisateur_image/";

if (isset($_POST['avatar'])) {
    if (check_password_exist($_POST['mot_de_passe'], $data['id'])) {
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            if ($_FILES["image"]["size"] <= 3000000) {
                $file_name = $_FILES["image"]["name"];
                $file_info = pathinfo($file_name);
                $file_ext = $file_info["extension"];
                $allowed_ext = ["png", "jpg", "jpeg", "gif"];
                if (in_array(strtolower($file_ext), $allowed_ext)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $dossierUtilisateur . basename($_FILES['image']['name']));
                    $profiledonnees["image"] = PROJECT_DIR . $dossierUtilisateur . basename($_FILES['image']['name']);
                    if (mise_a_jour_avatar($data['id'], $profiledonnees["image"])) {
                        $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] = recup_update_avatar($data['id']);
                        $_SESSION['photo_success'] = 'Mise à jour de la photo réussie';
                        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                        exit();
                    } else {
                        $_SESSION['photo-erreurs'] = "La mise à jour de l'image a échoué.";
                        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                        exit();
                    }
                } else {
                    $_SESSION['photo-erreurs'] = "L'extension de votre image n'est pas prise en compte. Extensions autorisées : PNG, JPG, JPEG, GIF";
                    header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                    exit();
                }
            } else {
                $_SESSION['photo-erreurs'] = "Fichier trop lourd. Poids maximum autorisé : 3 Mo";
                header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
                exit();
            }
        } else {
            $_SESSION['photo-erreurs'] = "Une erreur est survenue lors du choix de votre image. Assurez-vous que la taille de votre image est inférieure ou égale à 2 Mo";
            header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
            exit();
        }
    } else {
        $_SESSION['photo-erreurs'] = "La mise à jour a échoué. Vérifiez votre mot de passe et réessayez.";
        header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
        exit();
    }
} else {
    $_SESSION['photo-erreurs'] = "Une erreur est survenue lors du choix de votre image. Assurez-vous que la taille de votre image est inférieure ou égale à 2 Mo";
    header('location:' . PROJECT_DIR . 'bibliothecaire/mon_profil/mon-profil');
    exit();
}
?>
