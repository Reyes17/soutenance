<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
} 
$title ='Liste des domaines';
include './app/commun/header.php';
?>

	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">
				<!---message d'erreur global lors de l'ajout du domaine---->
			<?php
			if (isset($_SESSION['ajout-errors']) && !empty($_SESSION['ajout-errors'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; border-radius: 15px; text-align:center;">
					<?= $_SESSION['ajout-errors'] ?>
				</div>
			<?php
			}
			?>
			<!----message de succès global lors de l'ajout du domaine---->
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
					<h1>Ajouter un domaine</h1>
				</div>

				<div class="col-md-6 text-end cefp-list-add-btn">
					<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/liste_des_domaines" class="btn btn-primary">Liste des domaines</a>
				</div>
			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="<?= PROJECT_DIR; ?>bibliothecaire/domaine/ajouter_domaine_traitement" method="post">
						
						<div class="mb-3 row">
							<label for="libellé-domaine" class="col-sm-2 col-form-label">Domaine:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control <?= isset($_SESSION['ajouter-domaine-errors']) ? 'is-invalid' : '' ?>" id="libellé-domaine" name="domaine" placeholder="Veuillez entrer le domaine">
								<?php
							if (isset($_SESSION['ajouter-domaine-errors'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-domaine-errors'] ?>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 text-center mt-3">
								<button class="btn btn-success w-50"> Ajouter</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</main>
	</section>
<?php
include './app/commun/footer.php';
unset($_SESSION['ajouter-domaine-errors'], $_SESSION['ajout-errors'], $_SESSION['ajout-success']);
?>