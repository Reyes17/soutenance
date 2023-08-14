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
                                <option value=""></option>
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
                        <label for="periodicite-ouvrage" class="col-sm-2 col-form-label">Périodicité :</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage']) ? 'is-invalid' : '' ?>" id="periodicite-ouvrage" name="periodicite-ouvrage">
                                <option value="0"></option>
                                <option value="quotidien" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'quotidien' ? 'selected' : '' ?>>Quotidien</option>
                                <option value="hebdomadaire" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'hebdomadaire' ? 'selected' : '' ?>>Hebdomadaire</option>
                                <option value="mensuel" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'mensuel' ? 'selected' : '' ?>>Mensuel</option>
                                <option value="bimensuel" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'bimensuel' ? 'selected' : '' ?>>Bimensuel</option>
                                <option value="trimestriel" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'trimestriel' ? 'selected' : '' ?>>Trimestriel</option>
                                <option value="semestriel" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'semestriel' ? 'selected' : '' ?>>Semestriel</option>
                                <option value="annuel" <?= isset($_SESSION['saisie-precedente']['periodicite-ouvrage']) && $_SESSION['saisie-precedente']['periodicite-ouvrage'] === 'annuel' ? 'selected' : '' ?>>Annuel</option>
                            </select>

                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

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

                    <div class="mb-3 row">
                        <label for="domaines-ouvrage" class="col-sm-2 col-form-label">Domaines :</label>
                        <div class="col-sm-10">
                            <select multiple class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['domaine-ouvrage']) ? 'is-invalid' : '' ?>" id="domaines-ouvrage" name="domaines-ouvrage[]">
                                <?php
                                $liste_domaines = get_liste_domaine();
                                
                                $selectedDomaines = isset($_SESSION['saisie-precedente']['domaine-ouvrage']) ? $_SESSION['saisie-precedente']['domaine-ouvrage'] : [];

                                foreach ($liste_domaines as $domaine) {
                                    echo '<option value="' . $domaine['cod_dom'] . '">' . $domaine['lib_dom'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['domaine-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['domaine-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="auteurs-secondaires-ouvrage" class="col-sm-2 col-form-label">Auteurs secondaires:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage']) ? 'is-invalid' : '' ?>" id="auteurs-secondaires-ouvrage" name="auteurs-secondaires-ouvrage[]" multiple>
                                <?php
                                // Appeler la fonction pour récupérer la liste des auteurs secondaires
                                $liste_auteur = get_liste_auteurs();

                                // Afficher les auteurs secondaires dans le menu déroulant
                                foreach ($liste_auteur as $auteur) {
                                    $selected = $auteur === $auteur['num_aut'] ? 'selected' : '';
                                    echo '<option value="' . $auteur['num_aut'] . '" ' . $selected . '>' . $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="langue-et-annnee" class="col-sm-2 col-form-label">Langue et année de publication:</label>
                        <div class="col-md-5">
                            <select class="form-select langue-select <?= isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage']) ? 'is-invalid' : '' ?>" id="langue et annnee" name="langue[]" required data-index="0">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des domaines
                                $liste_langue = get_liste_langue();

                                // Afficher les domaines dans le menu déroulant
                                foreach ($liste_langue as $langue) {
                                    $selected = $langue === $langue['cod_lang'] ? 'selected' : '';
                                    echo '<option value="' . $langue['cod_lang'] . '" ' . $selected . '>' . $langue['lib_lang'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'])) : ?>
                                <?php foreach ($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'] as $error) : ?>
                                    <div class="invalid-feedback">
                                        <?= $error ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-4">
                            <select class="form-select annee-publication-select <?= isset($_SESSION['ajout-ouvrage-errors']['annee_publication']) ? 'is-invalid' : '' ?>" id="langue et annnee" name="annee_publication[]" required data-index="0">
                                <option value="0"></option>
                                <?php
                                $anneeActuelle = date("Y");
                                $anneeDebut = 1700; // Année de départ
                                $anneeFin = $anneeActuelle; // Année de fin (utilise $anneeActuelle ou une autre valeur si nécessaire)

                                for ($annee = $anneeDebut; $annee <= $anneeFin; $annee++) {
                                    $selected = in_array(strval($annee), $annee_publication) ? 'selected' : '';
                                    echo '<option value="' . $annee . '" ' . $selected . '>' . $annee . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'])) : ?>
                                <?php foreach ($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'] as $error) : ?>
                                    <div class="invalid-feedback">
                                        <?= $error ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </div>
                        <div id="form-container"></div>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Compteur pour identifier les champs ajoutés
        let counter = 1;

        // Fonction pour créer un nouveau champ "Langue et année de publication"
        function createNewField() {
            const row = document.createElement('div');
            row.classList.add('row', 'mt-3');

            const label = document.createElement('label');
            label.classList.add('col-sm-2', 'col-form-label');
            label.textContent = 'Langue et année de publication:';

            const col1 = document.createElement('div');
            col1.classList.add('col-md-5');

            const selectLangue = document.createElement('select');
            selectLangue.classList.add('form-select', 'langue-select');
            selectLangue.name = 'langue[]';
            selectLangue.required = true;
            selectLangue.dataset.index = counter;
            selectLangue.innerHTML = `
<option value="0"></option>
<?php
// Appeler la fonction pour récupérer la liste des domaines
$liste_langue = get_liste_langue();

// Afficher les domaines dans le menu déroulant
foreach ($liste_langue as $langue) {
    $selected = $langue === $langue['cod_lang'] ? 'selected' : '';
    echo '<option value="' . $langue['cod_lang'] . '" ' . $selected . '>' . $langue['lib_lang'] . '</option>';
}
?>
`;

            const col2 = document.createElement('div');
            col2.classList.add('col-md-4');

            const selectAnnee = document.createElement('select');
            selectAnnee.classList.add('form-select', 'annee-publication-select');
            selectAnnee.name = 'annee_publication[]';
            selectAnnee.required = true;
            selectAnnee.dataset.index = counter;
            selectAnnee.innerHTML = `
<option value="0"></option>
<?php
$anneeActuelle = date("Y");
$anneeDebut = 1700; // Année de départ
$anneeFin = $anneeActuelle; // Année de fin (utilise $anneeActuelle ou une autre valeur si nécessaire)

for ($annee = $anneeDebut; $annee <= $anneeFin; $annee++) {
    $selected = in_array(strval($annee), $annee_publication) ? 'selected' : '';
    echo '<option value="' . $annee . '" ' . $selected . '>' . $annee . '</option>';
}
?>
`;

            const col3 = document.createElement('div');
            col3.classList.add('col-md-1');

            const btnRemove = document.createElement('button');
            btnRemove.type = 'button';
            btnRemove.classList.add('btn', 'btn-danger', 'btn-remove');
            btnRemove.textContent = '-';
            btnRemove.dataset.index = counter;

            col1.appendChild(selectLangue);
            col2.appendChild(selectAnnee);
            col3.appendChild(btnRemove);

            row.appendChild(label);
            row.appendChild(col1);
            row.appendChild(col2);
            row.appendChild(col3);

            document.getElementById('form-container').appendChild(row);

            // Incrémenter le compteur pour les futurs champs ajoutés
            counter++;
        }

        // Fonction pour supprimer un champ "Langue et année de publication"
        function removeField(index) {
            const fieldToRemove = document.querySelector(`[data-index="${index}"]`).closest('.row');
            fieldToRemove.remove();
        }

        // Gérer le clic sur le bouton "+"
        document.querySelector('.btn-add').addEventListener('click', function() {
            createNewField();
        });

        // Gérer le clic sur le bouton "-"
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-remove')) {
                const indexToRemove = event.target.dataset.index;
                removeField(indexToRemove);
            }
        });
    });
</script>

<?php
include './app/commun/footer.php';
unset($_SESSION['ajout-ouvrage-error'], $_SESSION['ajout-ouvrage-success'], $_SESSION['ajout-ouvrage-errors'], $_SESSION['saisie-precedente']);

?>