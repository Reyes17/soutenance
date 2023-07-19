<?php
$data=$_SESSION['utilisateur_connecter_membre'];

$_SESSION['photo-erreurs'] = "";

$_SESSION['photo_success']="";



if(isset($_POST['photo_suppression'])){
    $password_exist=check_password_exist($_POST['mot_de_passe'], $data['id']);
    if($password_exist){
        delete_avatar($data['id']);
        $_SESSION['utilisateur_connecter_membre']['avatar']= recup_update_avatar($data['id']);
        $_SESSION['photo_success']="Suppression de la photo réussie!";
        header('location:' . PROJECT_DIR . 'mon_profil/mon-profil');
        exit();
    }
    else{
        $_SESSION['photo-erreurs']="La suppression a échoué! Mot de passe incorrect!";
        header('location:'. PROJECT_DIR . 'mon_profil/mon-profil');
        exit();
    }
}
else{
    header('location:'. PROJECT_DIR . 'mon_profil/mon-profil');
    exit();
}









