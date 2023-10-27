<?php
$title = 'Ouvrages par domaine';
include 'app/commun/header_membre.php';

if (!isset($_SESSION["utilisateur_connecter_membre"])) {
    header('location:' . PROJECT_DIR . 'membre/connexion/index');
}

if (isset($params['3']) && is_numeric($params['3'])) {
    $domaine_id = $params['3'];

    // Utilisation de la fonction pour récupérer les informations des ouvrages liés à ce domaine
    $ouvrages = getOuvragesByDomaineID($domaine_id);
?>
<main id="main" style="margin-left: 0px; padding: 30px;">
    <div class="pagetitle">
        <h1>Ouvrages par domaine</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/accueil">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines">Domaines</a></li>
                <li class="breadcrumb-item active"><?= getDomaineNameByID($domaine_id) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <?php
            // Bouclez à travers les ouvrages et affichez-les dans des cartes
            if (!empty($ouvrages)) {
            foreach ($ouvrages as $ouvrage) {
                echo '<div class="col-md-3">';
                echo '<div class="card mb-4">';
                echo '<img src="' . $ouvrage['image'] . '" class="card-img-top img-fluid resizable-image" alt="Aucune image" style=" width: auto; height: 400px; object-fit: cover;">';
                echo '<div class="card-body d-flex flex-column">';
                echo '<div>';
                echo '<h1 class="card-title">' . $ouvrage['titre'] . '</h1>';
                echo '<h5 class="card-subtitle mb-2 text-muted">Auteur: ' . $ouvrage['auteur'] . '</h5>';
                echo '<h5 class="card-subtitle mb-2 text-muted">Langue: ' . $ouvrage['langues'] . '</h5>';
                echo '<h6 class="card-subtitle mb-2 text-muted">Publié en: ' . $ouvrage['années'] . '</h6>';
                echo '</div>';
                echo '<button type="button" class="btn btn-outline-primary">Emprunter</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
    <?php
    } else {
        // Gérez le cas où il n'y a pas d'ouvrages associés à ce domaine.
        echo 'AUCUN OUVRAGE N\'ENCORE DISPONIBLE POUR CE DOMAINE.';
    }
} else {
    // Gérez le cas où l'ID de domaine n'est pas spécifié.
    echo 'Domaine non spécifié.';
}
?>
</main>
<?
include 'app/commun/footer_membre.php';
?>
