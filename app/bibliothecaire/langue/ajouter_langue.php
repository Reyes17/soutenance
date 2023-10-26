<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
    exit();
}
$title = 'Ajouter une langue';
include './app/commun/header.php';
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!---message d'erreur global lors de l'ajout de la langue---->
			<?php
			if (isset($_SESSION['ajout-errors']) && !empty($_SESSION['ajout-errors'])) {
			?>
				<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['ajout-errors'] ?>
				</div>
			<?php
			}
			?>
			<!----message de succès global lors de l'ajout de langue---->
			<?php
			if (isset($_SESSION['ajout-success']) && !empty($_SESSION['ajout-success'])) {
			?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['ajout-success'] ?>
				</div>
			<?php
			}
			?>
			<div class="col-md-6">
				<h1>Ajouter une langue</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/liste_des_langues" class="btn btn-primary">Liste des langues</a>
			</div>

		</div>

		<div class="row mt-5 ">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/langue/ajout_langue_traitement" method="post">

					<div class="mb-3 row">
						<label for="libellé-langue" class="col-sm-2 col-form-label">Langue :</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['ajouter-langue-errors']) ? 'is-invalid' : '' ?>" id="libellé-langue" name="langue" placeholder="Veuillez entrer la langue">
							<?php
							if (isset($_SESSION['ajouter-langue-errors'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-langue-errors'] ?>
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
unset($_SESSION['ajouter-langue-errors'], $_SESSION['ajout-errors'], $_SESSION['ajout-success']);

?>