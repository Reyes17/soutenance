<?php
$title = 'Listes des domaines';
if (!isset($_SESSION["utilisateur_connecter_membre"])) {
    header('location:' . PROJECT_DIR . 'membre/connexion/index');
}
include 'app/commun/header_membre.php';
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

        <?php
        $liste_domaines = get_liste_domaine();

        $counter = 0; // Pour compter les cartes
        echo '<div class="row">';

        foreach ($liste_domaines as $domaine) {
            if ($counter % 4 === 0 && $counter !== 0) {
                echo '</div><div class="row">'; // Commencer une nouvelle ligne après chaque quatrième carte
            }
            echo '<div class="col-md-3">';
            echo '<div class="card info-card sales-card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $domaine['lib_dom'] . '</h5>';
            echo '<div class="d-flex align-items-center">';
            echo '<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">';
            echo '<i class="ri-earth-line"></i>';
            echo '</div>';
            echo '<div class="ps-3">';
            echo '<h6>' . $domaine['nb_ouvrages'] . '</h6>';
            echo '<a href="' . PROJECT_DIR . 'membre/domaine_ouvrage/index/' . $domaine['cod_dom'] . '">Voir plus</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $counter++;
        }

        echo '</div>'; // Fermer la dernière ligne
        ?>

    </section>
</main>

<?php
include 'app/commun/footer_membre.php';
?>
