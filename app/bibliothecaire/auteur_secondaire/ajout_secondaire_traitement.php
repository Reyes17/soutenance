<?php
$data = [];
$errors = [];
$messageErreur = '';

if (verifier_info($_POST['nom_aut_secondaire'])) {
    $data['nom_aut_secondaire'] = trim(htmlentities($_POST['nom_aut_secondaire']));
} else {
    $errors['nom_aut_secondaire'] = '<p> Le champ nom est requis. Veuillez le renseigner! </p>';
}

if (verifier_info($_POST['prenom_aut_secondaire'])) {
    $data['prenom_aut_secondaire'] = trim(htmlentities($_POST['prenom_aut_secondaire']));
} else {
    $errors['prenom_aut_secondaire'] = '<p> Le champ prénom est requis. Veuillez le renseigner!</p>';
}

if (isset($_POST['nom_aut_secondaire']) && !empty($_POST['nom_aut_secondaire']) && isset($_POST['prenom_aut_secondaire']) && !empty($_POST['prenom_aut_secondaire'])) {
    $messageErreur = check_if_auteur_exist($_POST['nom_aut_secondaire'], $_POST['prenom_aut_secondaire']);
    if ($messageErreur) {
        $errors['auteur_existe'] = $messageErreur;
    }
}

if (empty($errors)) {
    $resultat = ajout_auteur_secondaire($data["nom_aut_secondaire"], $data["prenom_aut_secondaire"]);

    if ($resultat) {
        $_SESSION['ajout-success'] = 'Auteur secondaire ajouté avec succès et disponible maintenant dans la liste des auteurs secondaires';
    } else {
        $_SESSION['ajout-success'] = "L'ajout de l'auteur secondaire a échoué. Veuillez réessayer le processus";
    }
} else {
    $_SESSION['ajouter-auteur-erreurs'] = $errors;
    $_SESSION['auteur-existe'] =  $messageErreur;
}

header('location:' . PROJECT_DIR . 'bibliothecaire/auteur_secondaire/ajouter_auteur_secondaire');
