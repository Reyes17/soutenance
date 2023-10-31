<?php
$title = 'Ouvrages par domaines';
if (!isset($_SESSION["utilisateur_connecter_membre"])) {
    header('location:' . PROJECT_DIR . 'membre/connexion/index');
}

include 'app/commun/header_membre.php';

if (isset($params['3']) && is_numeric($params['3'])) {
    $domaine_id = $params['3'];

    // Utilisation de la fonction pour récupérer les informations des ouvrages liés à ce domaine
    $ouvrages = getOuvragesByDomaineID($domaine_id);
}
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
        <div class="row mt-3">
            <?php
            // Bouclez à travers les ouvrages et affichez-les dans des cartes
            if (!empty($ouvrages)) {
                foreach ($ouvrages as $ouvrage) {
            ?>
                    <div class="col-md-3"> <!-- Chaque ouvrage dans une colonne de 3 -->
                        <div class="card mb-4">
                            <img src="<?php echo $ouvrage['image'] ?>" class="card-img-top img-fluid" alt="Aucune image" style="width: auto; height: 400px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <div>
                                    <h1 class="card-title"><?= $ouvrage['titre'] ?></h1>
                                    <a href="#" title="Voir plus" class="link-warning" data-bs-toggle="modal" data-bs-target="#ouvrage-details-<?= $ouvrage['cod_ouv'] ?>"><i class="bi bi-eye-fill"></i></a>
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#ouvrage-emprunter-<?= $ouvrage['cod_ouv'] ?>">Emprunter</button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal pour le bouton details -->
                    <div class="modal modal-blur fade" id="ouvrage-details-<?= $ouvrage['cod_ouv'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage <?= $ouvrage['titre'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                                </div>
                                <div class="modal-body text-center">
                                    <!-- Ajoutez les détails spécifiques de l'ouvrage ici en utilisant $ouvrage['cod_ouv'] pour obtenir les informations spécifiques -->
                                    <p class="fw-bold">Auteur : <?= $ouvrage['auteur'] ?></p>
                                    <p class="fw-bold">Auteur secondaire : <?= $ouvrage['auteurs_secondaires'] ?></p>
                                    <p class="fw-bold">Nombre exemplaire total : <?= $ouvrage['nombre_exemplaires_total'] ?></p>
                                    <p class="fw-bold">Langue | Année | Nombre: </br><?= $ouvrage['details'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal pour le bouton "Supprimer" -->
                    <div class="modal fade" id="ouvrage-emprunter-<?= $ouvrage['cod_ouv'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">En quelle langue voulez-vous l'ouvrage?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <p class="fw-bold">Langue | Année | Nombre: </br><?= $ouvrage['details'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <a href="#" class="btn btn-danger">Oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                // Gérez le cas où il n'y a pas d'ouvrages associés à ce domaine.
                echo 'AUCUN DOMAINE N\'EST DISPONIBLE .';
            }
            ?>
        </div>
    </section>
</main>
<?php
include 'app/commun/footer_membre.php';
?>