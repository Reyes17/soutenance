<?php
$title = 'Liste des domaines';
include 'app/commun/header_membre.php';

// Établir une connexion à la base de données
$db = connect_db();

// Initialisez la variable $liste_domaines à la liste complète des domaines
$liste_domaines = get_liste_domaine();

// Si le formulaire de recherche est soumis, effectuez la recherche
if (isset($_POST['search']) && !empty($_POST['titre'])) {
    // Recherche par nom si le formulaire de recherche est soumis
    $liste_domaines = searchDomaineByNom($db, $_POST['titre']);
}

// ... (le reste de votre code)

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
        <form action="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines" method="post">
            <!-- Affichage du nombre total de domaines -->
            <div class="row">
                <div class="col-md-6 mt-3">
                    <h5>Total: <?= $nombre_total_domaines; ?> </h5>
                </div>
                <div class="col-md-6 mb-3" style="display: flex;">

                    <input type="text" class="form-control" value="" name="titre" placeholder="Rechercher un domaine">
                    <button type="submit" name="search" class="btn btn-primary">Rechercher</button>

                </div>
            </div>

            <!-- Affichage des domaines -->
            <div class="row mt-3">
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
                                            <a class="btn btn-outline-primary" href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/index/<?= $domaine['cod_dom'] ?>">
                                                Parcourir
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // Gérez le cas où il n'y a pas de résultats
                    echo 'AUCUN DOMAINE N\'EST DISPONIBLE POUR L\'INSTANT .';
                }
                ?>
            </div>
        </form>
    </section>
</main>
<?php
include 'app/commun/footer_membre.php';
?>