<?php
$title = 'Liste des domaines';
include 'app/commun/header_membre.php';

// Utilisez la fonction pour obtenir la liste des domaines
$liste_domaines = get_liste_domaine();
?>

<main id="main" style="margin-left: 0px; padding: 30px;">

    <section class="section dashboard">
        <div class="pagetitle">
            <h1>Liste des domaines</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Domaines</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <?php
            // Bouclez à travers la liste des domaines
            if (!empty($liste_domaines)) {
            foreach ($liste_domaines as $domaine) {
            ?>
                <div class="col-md-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $domaine['lib_dom'] ?></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-earth-line"></i>
                                </div>
                                <div class="ps-3">
                                    <h5><?= $domaine['nb_ouvrages'] ?> ouvrages</h5>
                                    <button type="button" class="btn btn-outline-primary">
                                        <a href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/index/<?= $domaine['cod_dom'] ?>">
                                            Parcourir
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }} else {
                // Gérez le cas où il n'y a pas d'ouvrages associés à ce domaine.
                echo 'AUCUN OUVRAGE N\'EST DISPONIBLE POUR CE DOMAINE.';
            }
            ?>
        </div>
    </section>
</main>
<?php
include 'app/commun/footer_membre.php';
?>
