<?php
$title = 'Ouvrages par domaines';
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
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
                    echo 'AUCUN DOMAINE N\'EST DISPONIBLE .';
                }
                ?>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ajouterAuPanier = document.getElementById('ajouter-au-panier');
            const selectLangue = document.getElementById('langue');
            const ouvrageIdInput = document.getElementById('ouvrage-id');

            ajouterAuPanier.addEventListener('click', function() {
                const selectedLangue = selectLangue.value;
                const ouvrageId = ouvrageIdInput.value;

                // Envoyer les données au panier (vous devrez implémenter cette fonctionnalité)
                addToCart(ouvrageId, selectedLangue);

                // Fermer le modal
                const modal = new bootstrap.Modal(document.getElementById('ouvrage-emprunter-' + ouvrageId));
                modal.hide();
            });
        });

        function addToCart(ouvrageId, langue) {
            // Vous devrez implémenter la logique pour ajouter l'ouvrage au panier
            // Cela peut être fait en utilisant une requête AJAX vers un script PHP
            // ou en utilisant une autre méthode pour stocker les ouvrages dans le panier.
            // Une fois l'ouvrage ajouté avec la langue sélectionnée, vous pouvez mettre à jour l'affichage du panier.
            // Assurez-vous d'adapter cette fonction à votre propre structure de données et de panier.
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btnRetirerPanier = document.querySelectorAll('.btn-retirer-panier');

            btnRetirerPanier.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const ouvrageId = btn.getAttribute('data-ouvrage');
                    const langue = btn.getAttribute('data-langue');

                    // Envoyez une requête au serveur pour retirer l'ouvrage du panier
                    // Cette partie doit être implémentée côté serveur.

                    // Ensuite, mettez à jour l'affichage du panier (par exemple, en rechargeant la page).
                    location.reload();
                });
            });
        });
    </script>

    <?php
    include 'app/commun/footer_membre.php';
    ?>