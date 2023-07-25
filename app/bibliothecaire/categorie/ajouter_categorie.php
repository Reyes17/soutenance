<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Ajouter une categorie';
include './app/commun/header.php';
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!---message d'erreur global lors de l'ajout de la langue---->
			<?php
			if (isset($_SESSION['ajout-errors']) && !empty($_SESSION['ajout-errors'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; border-radius: 15px; text-align:center;">
					<?= $_SESSION['ajout-errors'] ?>
				</div>
			<?php
			}
			?>
			<!----message de succès global lors de l'ajout de langue---->
			<?php
			if (isset($_SESSION['ajout-success']) && !empty($_SESSION['ajout-success'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['ajout-success'] ?>
				</div>
			<?php
			}
			?>
			<div class="col-md-6">
				<h1>Ajouter une categorie</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/liste_des_categories" class="btn btn-primary">Liste des catégories</a>
			</div>

		</div>

		<div class="row mt-5 ">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/categorie/ajout_categorie_traitement" method="post">
				<div class="mb-3 row">
							<label for="libellé-domaine" class="col-sm-2 col-form-label">Domaine:</label>
							<div class="col-sm-7">
							<select class="form-select <?= isset($_SESSION['ajouter-categorie-errors']['domaine']) ? 'is-invalid' : '' ?>" id="libellé-domaine" name="domaine">
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
								<?php
							if (isset($_SESSION['ajouter-categorie-errors']['domaine'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-categorie-errors']['domaine'] ?>
								</div>
							<?php
							}
							?>
							</div>
						</div>



					<div class="mb-3 row">
						<label for="libellé-categorie" class="col-sm-2 col-form-label">Categorie :</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['ajouter-categorie-errors']['nom_cat']) ? 'is-invalid' : '' ?>" id="libellé-categorie" name="nom_cat" placeholder="Veuillez entrer la catégorie">
							<?php
							if (isset($_SESSION['ajouter-categorie-errors']['nom_cat'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-categorie-errors']['nom_cat'] ?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-sm-9 text-end mt-3">
					<button class="btn btn-success"> Ajouter</button>
				</div>
			</div>
			</form>

		</div>

		</div>

	</main>
</section>

<?php
include './app/commun/footer.php';
unset($_SESSION['ajouter-categorie-errors'], $_SESSION['ajout-errors'], $_SESSION['ajout-success']);

?>