<?php
$title = 'Catalogue';
include 'app/commun/header_membre.php';

// Récupérer la valeur du champ de recherche s'il a été soumis
$titre = !empty($_POST['titre']) ? $_POST['titre'] : '';

// Effectuer la recherche en fonction du titre
$liste_ouvrages = get_liste_ouvrages($titre);
?>

<main id="main" style="margin-left: 0px; padding: 30px;">

    <div class="pagetitle">
        <h1>Catalogue</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines">Domaines</a></li>
                <li class="breadcrumb-item active">Ouvrages</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">

        <form action="<?= PROJECT_DIR; ?>membre/catalogue/index" method="post">
            <div class="row">
                <div class="col-md-6">
                    <h5>Total: <?= $nombre_total_domaines; ?> </h5>
                </div>
                <div class="col-md-6 mb-3" style="display: flex;">
                    <select class="form-select select2bs4" name="titre">
                        <option value="">Rechercher un ouvrage par son titre</option>
                        <?php
                        // Appeler la fonction pour récupérer la liste des ouvrages
                        $liste_ouvrages = get_liste_ouvrages($titre);

                        // Parcourir la liste des ouvrages et créer des options
                        foreach ($liste_ouvrages as $ouvrage) {
                        ?>
                            <option value="<?= htmlspecialchars($ouvrage['cod_ouv']); ?>">
                                <?= htmlspecialchars($ouvrage['titre']); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <button type="submit" name="search" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
            </div>
        </form>

        <div class="row">
            <?php
            // Bouclez à travers la liste des ouvrages
            if (!empty($liste_ouvrages)) {
                foreach ($liste_ouvrages as $key => $ouvrage) {
            ?>
                    <div class="col-md-3">
                        <!-- Chaque ouvrage dans une colonne de 3 -->
                        <div class="card mb-4">
                            <img src="<?php echo $ouvrage['img'] ?>" class="card-img-top img-fluid" alt="Aucune image" style="width: auto; height: 400px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <div>
                                    <h1 class="card-title"><?= htmlspecialchars($ouvrage['titre']); ?></h1>
                                    <a href="#" title="Voir plus" class="link-warning" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier-<?php echo $ouvrage['cod_ouv']; ?>"><i class="bi bi-eye-fill"></i> Détail sur l'ouvrage</a>
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#ouvrage-emprunter-<?= $ouvrage['cod_ouv']; ?>">Emprunter</button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal pour le bouton details -->
                    <div class="modal modal-blur fade" id="cefp-ouvrage-modifier-<?php echo $ouvrage['cod_ouv']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage <?php echo $titre; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <!-- Ajoutez le nom de l'auteur de l'ouvrage -->
                                    <p class="fw-bold">Auteur :
                                        <?php
                                        $auteurPrincipal = get_auteur_by_id($ouvrage['num_aut']);
                                        if ($auteurPrincipal) {
                                            echo htmlspecialchars($auteurPrincipal['prenom_aut']) . ' ' . htmlspecialchars($auteurPrincipal['nom_aut']);
                                        } else {
                                            echo 'Auteur non trouvé';
                                        }
                                        ?>
                                    </p>
                                    <p class="fw-bold">Domaines :
                                        <?php
                                        $domaines = get_domaines_by_ouvrage($ouvrage['cod_ouv']);
                                        $domainesList = array_map(function ($domaine) {
                                            return htmlspecialchars($domaine['lib_dom']);
                                        }, $domaines);
                                        echo implode(' | ', $domainesList);
                                        ?>
                                    </p>
                                    <p class="fw-bold">Auteurs secondaires :
                                        <?php
                                        $auteursSecondaires = get_auteurs_secondaires_by_ouvrage($ouvrage['cod_ouv']);
                                        if (!empty($auteursSecondaires)) {
                                            $auteursList = array_map(function ($auteur) {
                                                return htmlspecialchars($auteur['prenom_aut']) . ' ' . htmlspecialchars($auteur['nom_aut']);
                                            }, $auteursSecondaires);
                                            echo implode(', ', $auteursList);
                                        } else {
                                            echo 'Aucun auteur secondaire';
                                        }
                                        ?>
                                    </p>
                                    <p class="fw-bold">Langue | Année | Nombre:</p>
                                    <?php
                                    $detailsOuvrage = get_details_ouvrage($ouvrage['cod_ouv']);
                                    if (!empty($detailsOuvrage)) {
                                        foreach ($detailsOuvrage as $detail) {
                                            echo '<p>' . htmlspecialchars($detail['langue']) . ' |' .  htmlspecialchars($detail['annee_publication'])  . '| ' . htmlspecialchars($detail['nb_exemplaire_langue']) . '</p>';
                                        }
                                    } else {
                                        echo '<p>Aucun détail disponible</p>';
                                    }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal pour le bouton "Emprunter" -->
                    <div class="modal fade" id="ouvrage-emprunter-<?= $ouvrage['cod_ouv'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">En quelle langue voulez-vous emprunter l'ouvrage?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="votre_page_de_traitement.php">
                                        <!-- Champ caché pour stocker le titre de l'ouvrage -->
                                        <input type="hidden" name="titre_ouvrage" value="<?= $ouvrage['titre'] ?>">

                                        <!-- Menu déroulant (select) pour choisir la langue -->
                                        <label for="langue" class="fw-bold">Choisir la langue :</label>

                                        <select class="form-select select2bs4 mt-3" name="langue" id="langue">
                                            <?php
                                            $langues = getLanguesByOuvrageID($ouvrage['cod_ouv']);
                                            foreach ($langues as $langue) {
                                            ?>
                                                <option value="<?= $langue['langue'] ?>"><?= $langue['langue'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" id="ouvrage-id" name="ouvrage_id" value="<?= $ouvrage['cod_ouv'] ?>">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" id="ajouter-au-panier">Emprunter</button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                // Gérez le cas où il n'y a pas d'ouvrages associés à ce domaine.
                echo  'AUCUN OUVRAGE N\'EST ENCORE DISPONIBLE.';
            }
            ?>
        </div>
    </section>
</main>
<?php
include 'app/commun/footer_membre.php';
?>