<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Ajouter un ouvrage';

include 'app/commun/header.php';
?>

<section class="section dashboard">
    <main id="main" class="main">
        <div class="row">
            <!---message d'erreur global lors de l'ajout de l'ouvrage---->
            <?php if (isset($_SESSION['ajout-ouvrage-error'])) : ?>
                <div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
                    <?= $_SESSION['ajout-ouvrage-error'] ?>
                </div>
                <?php unset($_SESSION['ajout-ouvrage-error']); ?>
            <?php endif; ?>

            <!---message de succès global lors de l'ajout de l'ouvrage---->
            <?php if (isset($_SESSION['ajout-ouvrage-success'])) : ?>
                <div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
                    <?= $_SESSION['ajout-ouvrage-success'] ?>
                </div>
                <?php unset($_SESSION['ajout-ouvrage-success']); ?>
            <?php endif; ?>
            <div class="col-md-6">
                <h1>Ajouter un ouvrage</h1>
            </div>

            <div class="col-md-6 text-end bibliotheque-list-add-btn">
                <a href="liste_des_ouvrages" class="btn btn-primary">Liste des ouvrages</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 col-lg-8 offset-lg-2 bd-example">
                <form action="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/ajout_ouvrage_traitement" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="titre-ouvrage" class="col-sm-2 col-form-label">Titre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= isset($_SESSION['ajout-ouvrage-errors']['titre-ouvrage']) ? 'is-invalid' : '' ?>" id="titre-ouvrage" name="titre-ouvrage" value="<?= isset($_SESSION['saisie-precedente']['titre']) ? $_SESSION['saisie-precedente']['titre'] : '' ?>" placeholder="Veuillez entrer le titre de l'ouvrage">
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['titre-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['titre-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nombre-exemplaire-ouvrage" class="col-sm-2 col-form-label">Nombre d'exemplaire:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage']) ? 'is-invalid' : '' ?>" id="nombre-exemplaire-ouvrage" name="nombre-exemplaire-ouvrage" value="<?= $nb_exemplaire ?>">
                                <option value="" ></option>
                                <?php
                                for ($nombre = 1; $nombre <= 200; $nombre++) {
                                    $selected = isset($_SESSION['saisie-precedente']['nb_exemplaire']) && $_SESSION['saisie-precedente']['nb_exemplaire'] == $nombre ? 'selected' : '';
                                    $nombreFormatte = str_pad($nombre, 2, '0', STR_PAD_LEFT);
                                    echo '<option value="' . $nombre . '" ' . $selected . '>' . $nombreFormatte . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="auteur-principal-ouvrage" class="col-sm-2 col-form-label">Auteur :</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage']) ? 'is-invalid' : '' ?>" id="auteur-principal-ouvrage" name="auteur-principal-ouvrage">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des auteurs
                                $liste_auteurs = get_liste_auteurs();

                                // Récupérer la valeur précédente de l'auteur depuis la session si disponible
                                $selectedAuteurId = isset($_SESSION['saisie-precedente']['selectedAuteurId']) ? $_SESSION['saisie-precedente']['selectedAuteurId'] : '';

                                // Afficher les auteurs dans le menu déroulant
                                foreach ($liste_auteurs as $auteur) {
                                    $selected = $selectedAuteurId === $auteur['num_aut'] ? 'selected' : '';
                                    echo '<option value="' . $auteur['num_aut'] . '" ' . $selected . '>' . $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] . '</option>';
                                }
                                ?>
                            </select>

                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Champ caché pour stocker l'ID de l'auteur sélectionné -->
                    <input type="hidden" id="selected-auteur-id" name="selected-auteur-id" value="">


                    <div class="mb-3 row">
                        <label for="image-ouvrage" class="col-sm-2 col-form-label">Image de la page de garde:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control <?= isset($_SESSION['ajout-ouvrage-errors']['image-ouvrage']) ? 'is-invalid' : '' ?>" id="image-ouvrage" name="image-ouvrage">
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['image-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['image-ouvrage'] ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-12 text-center mt-3">
                            <button type="submit" class="btn btn-success w-50"> Ajouter</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </main>
</section>
<script>
    // Gérer le changement de sélection dans le champ de sélection de l'auteur
    document.getElementById('auteur-principal-ouvrage').addEventListener('change', function(event) {
        const selectedAuthorId = event.target.value;
        document.getElementById('selected-auteur-id').value = selectedAuthorId;
    });
</script>

<?php
include './app/commun/footer.php';
unset($_SESSION['ajout-ouvrage-error'], $_SESSION['ajout-ouvrage-success'], $_SESSION['ajout-ouvrage-errors'], $_SESSION['saisie-precedente']);

?>