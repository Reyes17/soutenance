<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Ajouter un ouvrage';

include './app/commun/header.php';

// Initialisation des variables pour conserver les valeurs des champs après la soumission du formulaire
$titre = $nb_ex = $auteur_principal = $auteur_secondaire = $domaine = $langue = $categorie = $annee_publication = '';
$image_error = '';
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
                            <input type="text" class="form-control <?= isset($_SESSION['ajout-ouvrage-errors']['titre-ouvrage']) ? 'is-invalid' : '' ?>" id="titre-ouvrage" name="titre-ouvrage" placeholder="Veuillez entrer le titre de l'ouvrage">
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
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage']) ? 'is-invalid' : '' ?>" id="nombre-exemplaire-ouvrage" name="nombre-exemplaire-ouvrage">
                                <option value="" <?= $nb_ex === 0 ? 'selected' : ''; ?>></option>
                                <?php
                                for ($nombre = 1; $nombre <= 200; $nombre++) {
                                    $selected = $nb_ex === $nombre ? 'selected' : '';
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
                        <label for="auteur-principal-ouvrage" class="col-sm-2 col-form-label">Auteur principal:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage']) ? 'is-invalid' : '' ?>" id="auteur-principal-ouvrage" name="auteur-principal-ouvrage">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des auteurs
                                $liste_auteurs = get_liste_auteurs();

                                // Afficher les auteurs dans le menu déroulant
                                foreach ($liste_auteurs as $auteur) {
                                    $selected = $auteur_principal === $auteur['num_aut'] ? 'selected' : '';
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


                    <div class="mb-3 row">
                        <label for="auteurs-secondaires-ouvrage" class="col-sm-2 col-form-label">Auteurs secondaires:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage']) ? 'is-invalid' : '' ?>" id="auteurs-secondaires-ouvrage" name="auteurs-secondaires-ouvrage">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des auteurs secondaires
                                $liste_auteur_secondaire = get_liste_auteurs_secondaire();

                                // Afficher les auteurs secondaires dans le menu déroulant
                                foreach ($liste_auteur_secondaire as $auteur_secondaire) {
                                    $selected = $auteur_secondaire === $auteur_secondaire['id'] ? 'selected' : '';
                                    echo '<option value="' . $auteur_secondaire['id'] . '" ' . $selected . '>' . $auteur_secondaire['nom_aut_secondaire'] . ' ' . $auteur_secondaire['prenom_aut_secondaire'] . '</option>';
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

                    <div class="mb-3 row">
                        <label for="domaineListe" class="col-sm-2 col-form-label">Domaine:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['domaine-ouvrage']) ? 'is-invalid' : '' ?>" id="domaineListe" name="domaine-ouvrage"   onchange="updateCategories()">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des domaines
                                $liste_domaine = get_liste_domaine();

                                // Afficher les domaines dans le menu déroulant
                                foreach ($liste_domaine as $domaine_item) {
                                    $selected = $domaine === $domaine_item['cod_dom'] ? 'selected' : '';
                                    echo '<option value="' . $domaine_item['cod_dom'] . '" ' . $selected . '>' . $domaine_item['lib_dom'] . '</option>';
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
                        <label for="categorieListe" class="col-sm-2 col-form-label">Catégorie:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['categorie-ouvrage']) ? 'is-invalid' : '' ?>" id="categorieListe" name="categorie-ouvrage" >
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des catégories
                                $liste_categorie = get_liste_categorie();

                                // Afficher les catégories dans le menu déroulant
                                foreach ($liste_categorie as $categorie_item) {
                                    $selected = ($categorie === $categorie_item['cod_cat']) ? 'selected' : '';

                                    echo '<option value="' . $categorie_item['cod_cat'] . '" ' . $selected . '>' . $categorie_item['nom_cat'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['categorie-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['categorie-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="langue-ouvrage" class="col-sm-2 col-form-label">Langue:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage']) ? 'is-invalid' : '' ?>" id="langue-ouvrage" name="langue-ouvrage">
                                <option value="0"></option>
                                <?php
                                // Appeler la fonction pour récupérer la liste des langues
                                $liste_langue = get_liste_langue();

                                // Afficher les langues dans le menu déroulant
                                foreach ($liste_langue as $langue_item) {
                                    $selected = $langue === $langue_item['cod_lang'] ? 'selected' : '';
                                    echo '<option value="' . $langue_item['cod_lang'] . '" ' . $selected . '>' . $langue_item['lib_lang'] . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['langue-ouvrage'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    

                    <div class="mb-3 row">
                        <label for="annee-publication" class="col-sm-2 col-form-label">Année de publication:</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['annee-publication']) ? 'is-invalid' : '' ?>" id="annee-publication" name="annee-publication">
                                <option value="0"></option>
                                <?php
                                $anneeActuelle = date("Y");
                                for ($annee = 1870; $annee <= 2024; $annee++) {
                                    $selected = $annee_publication === strval($annee) ? 'selected' : '';
                                    echo '<option value="' . $annee . '" ' . $selected . '>' . $annee . '</option>';
                                }
                                ?>
                            </select>
                            <?php if (isset($_SESSION['ajout-ouvrage-errors']['annee-publication'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $_SESSION['ajout-ouvrage-errors']['annee-publication'] ?>
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
function get_categories_by_domaine(domaine) {
  // Utilisez AJAX pour appeler votre serveur PHP et récupérer les catégories en fonction de l'ID du domaine.
  // Par exemple, vous pouvez utiliser fetch() pour effectuer une requête AJAX.
  // Assurez-vous que votre serveur PHP renvoie les données au format JSON.

  // Exemple de code pour récupérer les catégories :
  fetch('<?= PROJECT_DIR . 'bibliothecaire/ouvrage/recuperer_categorie'?>?domaine=' + domaine)
    .then(response => response.json())
    .then(data => {
      console.log(data);
      // Une fois que vous avez récupéré les catégories au format JSON, vous pouvez les utiliser pour générer les options de la liste déroulante des catégories.
      const categorieListe = document.getElementById('categorieListe');
      categorieListe.innerHTML = ''; // Vide la liste déroulante des catégories actuelle.

      // Génère les nouvelles options de la liste déroulante des catégories.
      data.forEach(categorie => {
        const option = document.createElement('option');
        option.value = categorie.cod_cat;
        option.textContent = categorie.nom_cat;
        categorieListe.appendChild(option);
      });
    })
    .catch(error => console.error('Erreur lors de la récupération des catégories :', error));
}

function updateCategories() {
  // Récupère l'ID du domaine sélectionné dans la liste déroulante des domaines.
  const domaineListe = document.getElementById('domaineListe');
  const domaine = domaineListe.value;

  // Appelle la fonction pour récupérer et mettre à jour les catégories en fonction du domaine sélectionné.
  get_categories_by_domaine(domaine);
}

// Assurez-vous que les options des domaines sont chargées avant d'appeler updateCategories() pour la première fois.
document.addEventListener('DOMContentLoaded', function() {
  const domaineListe = document.getElementById('domaineListe');
  const premierDomaine = domaineListe.options[1].value; // Supposons que le premier domaine a un ID de 1.

  // Appelle updateCategories() pour afficher les catégories du premier domaine par défaut.
  updateCategories();
});

</script>



<?php
include './app/commun/footer.php';
unset($_SESSION['ajout-ouvrage-error'], $_SESSION['ajout-ouvrage-success'], $_SESSION['ajout-ouvrage-errors']);

?>