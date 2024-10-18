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
                    <!-- Modal pour le bouton "Emprunter" -->
                    <div class="modal fade" id="ouvrage-emprunter-<?= $ouvrage['cod_ouv'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- ... (autre code) ... -->
                                <div class="modal-body">
                                    <form method="POST" action="#" id="empruntForm">
                                        <!-- Champ caché pour stocker le titre de l'ouvrage -->
                                        <input type="hidden" name="titre_ouvrage" value="<?= $ouvrage['titre'] ?>">

                                        <!-- Menu déroulant (select) pour choisir la langue -->
                                        <label for="langue" class="fw-bold">Choisir la langue dans laquelle vous voulez l'ouvrage :</label>
                                        <select class="form-select mt-3" name="langue" id="langue">
                                            <?php
                                            $langues = getLanguesByOuvrageID($ouvrage['cod_ouv']);
                                            foreach ($langues as $langue) {
                                            ?>
                                                <option value="<?= $langue['code_langue'] ?>"><?= $langue['langue'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" id="ouvrage-id" name="ouvrage_id" value="<?= $ouvrage['cod_ouv'] ?>">

                                        <!-- Ajout d'un bouton pour valider la langue et ajouter au panier -->
                                        <button type="button" class="btn btn-danger mt-3" id="ajouter-au-panier">Valider et Ajouter au Panier</button>
                                    </form>
                                </div>
                                <!-- ... (autre code) ... -->
                            </div>
                        </div>
                    </div>



            <?php
                }
            } else {
                // Gérez le cas où il n'y a pas d'ouvrages associés à ce domaine.
                echo  'AUCUN OUVRAGE N\'EST ENCORE DISPONIBLE POUR CE DOMAINE.';
            }
            ?>
        </div>
    </section>
</main>

<script>
    // Gérer le clic sur le bouton "Valider et Ajouter au Panier"
    $(document).on("click", "#ajouter-au-panier", function() {
        // Récupérer les données spécifiques à cet ouvrage
        var titre = $(this).closest(".modal-content").find("input[name='titre_ouvrage']").val();
        var langue = $(this).closest(".modal-content").find("#langue").val();
        var ouvrageId = $(this).closest(".modal-content").find("#ouvrage-id").val();

        // Effectuer une requête AJAX pour ajouter au panier
        $.ajax({
            type: "POST",
            url: "<?= PROJECT_DIR; ?>membre/emprunt/ajouter_panier",
            data: {
                titre: titre,
                langue: langue,
                ouvrage_id: ouvrageId
            },
            dataType: 'json',
            success: function(data) {
                // Afficher une notification Toastify
                Toastify({
                    text: "L'ouvrage a été ajouté au panier.",
                    duration: 1000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    callback: function() {
                        // Actualiser la page après un délai de 2000 millisecondes
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                }).showToast();
            }
        });
    });
</script>


<?php
include 'app/commun/footer_membre.php';
?>