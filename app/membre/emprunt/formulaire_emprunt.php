<?php
// formulaire_emprunt.php

$title = 'Formulaire des emprunts';
include 'app/commun/header_membre.php';

$panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();

?>

<main id="main" style="margin-left: 0px; padding: 30px;">
    <div class="pagetitle">

        <!----message d'erreur global après soumission du formulaire----->
        <?php
        if (isset($_SESSION['notification']) && !empty($_SESSION['notification'])) {
        ?>
            <div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
                <?= $_SESSION['notification'] ?>
            </div>
        <?php
        }
        ?>
        <h1>Formulaire d'emprunt</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines">Domaines</a></li>
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/utilisateur/catalogue">Catalogue</a></li>
                <li class="breadcrumb-item active">Emprunts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-md-12 text-end cefp-list-add-btn mb-2">
                <a href="<?= PROJECT_DIR; ?>membre/emprunt/vider_traitement" class="btn btn-outline-danger w-25" id="viderPanierBtn"> Vider le panier </a>
            </div>
        </div>
        <form method="post" action="<?= PROJECT_DIR; ?>membre/emprunt/soumettre_emprunt">
            <div class="row">
                <div class="col">
                    <div class="card-body">
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ouvrage</th>
                                    <th scope="col">Langue</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Afficher les ouvrages du panier
                                if (!empty($panier)) {
                                    foreach ($panier as $index => $ouvrage) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1; ?></th>
                                            <td><?= htmlspecialchars($ouvrage['titre']); ?></td>
                                            <td><?= htmlspecialchars($ouvrage['langue']); ?></td>
                                            <td>
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer" data-index="<?= $index; ?>">Retirer l'ouvrage</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Aucun ouvrage dans le panier
                                    echo '<tr><td colspan="4">AUCUN OUVRAGE N\'A ENCORE ETE AJOUTE AU PANIER.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-outline-success">Soumettre votre emprunt</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal pour le bouton supprimer-->
        <div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Retirer ouvrage</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Etes vous sur de vouloir retirer cet ouvrage ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>

                        <!-- Utiliser un formulaire caché pour envoyer la requête de retrait -->
                        <a href="<?= PROJECT_DIR; ?>membre/emprunt/retirer_traitement" class="btn btn-danger" id="retirerOuvrageBtn">Oui</a>

                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<script>
    $(document).on("click", "#viderPanierBtn", function() {
        // Effectuer une requête AJAX pour vider le panier
        $.ajax({
            type: "POST",
            url: "<?= PROJECT_DIR; ?>membre/emprunt/vider_traitement",
            success: function() {
                // Recharger la page après avoir vidé le panier
                location.reload();
            }
        });
    });


    $(document).on("click", "#retirerOuvrageBtn", function() {
        var index = $(".btn-danger").data('index'); // Utilisez la classe pour récupérer le data-index

        // Effectuer une requête AJAX pour retirer l'ouvrage
        $.ajax({
            type: "POST",
            url: "<?= PROJECT_DIR; ?>membre/emprunt/retirer_traitement",
            data: {
                index: index
            },
            success: function() {
                // Retirer la ligne du tableau
                var removedRow = $(this).closest('tr');
                removedRow.remove();

                // Mettre à jour les numéros de ligne restants dans l'ordre inverse
                var rowCount = $('tbody tr').length;
                $('tbody tr').each(function(i) {
                    $(this).find('th').text(rowCount - i);
                });

                // Fermer le modal
                $("#cefp-ouvrage-supprimer").modal('hide');
            }
        });
    });
</script>

<?php
include 'app/commun/footer_membre.php';
?>