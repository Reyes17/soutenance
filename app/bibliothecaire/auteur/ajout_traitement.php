<?php
$data = [];
$errors = [];
$existe= [];

if (verifier_info($_POST['nom_aut'])) {
	$data['nom_aut'] = trim(htmlentities($_POST['nom_aut']));
} else {
	$errors['nom_aut'] = '<p> Le champ nom est requis. Veuillez le renseigner! </p>';
}

if (verifier_info($_POST['prenom_aut'])) {
	$data['prenom_aut'] =trim(htmlentities($_POST['prenom_aut']));
} else {
	$errors['prenom_aut'] = '<p > Le champ prénom est requis. Veuillez le renseigner!</p>';
}

$check_if_auteur_exist = check_if_auteur_exist( $_POST['nom_aut'], $_POST['prenom_aut']);
if ($check_if_auteur_exist){
    $existe['nom_aut']['prenom_aut'] ='Désolé mais cet auteur existe déjà dans la base de donnée';
}


if(empty($errors)){
    $resultat = ajout_auteur($data["nom_aut"], $data["prenom_aut"]);

	if ($resultat){
        $_SESSION['ajout-success'] = 'Auteur ajouter avec succès et disponible maintenant dans la liste des auteurs';
    }else{
        $_SESSION['ajout-success'] = "L'ajout de l'auteur à échouer. Réessayer le processus";
    }

}else{
    $_SESSION['ajouter-auteur-erreurs'] = $errors;
    $_SESSION['auteur-existe'] = $existe;
}
header('location:' . PROJECT_DIR . 'bibliothecaire/dossier/ajouter_auteurs');
    
