<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
include("header.php");
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!---message d'erreur global lors de l'ajouter d'un auteur---->
			<?php
			if (isset($_SESSION['ajout-errors']) && !empty($_SESSION['ajout-errors'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; border-radius: 15px; text-align:center;">
					<?= $_SESSION['ajout-errors'] ?>
				</div>
			<?php
			}
			?>
			<!----message de succès global lors de l'ajout de l'auteur---->
			<?php
			if (isset($_SESSION['ajout-success']) && !empty($_SESSION['ajout-success'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['ajout-success'] ?>
				</div>
			<?php
			}
			?>

			<!---message d'erreur global lorsque l'auteur existe déjà dans la base de donnée---->
			<?php
			if (isset($_SESSION['auteur-existe']) && !empty($_SESSION['auteur-existe'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; border-radius: 15px; text-align:center;">
					<?= $_SESSION['auteur-existe'] ?>
				</div>
			<?php
			}
			?>

			<div class="col-md-6">
				<h1>Ajouter un auteur</h1>
			</div>

			<div class="col-md-6 text-end cefp-list-add-btn">
				<a href="auteur/liste_des_auteurs" class="btn btn-primary">Liste des auteurs</a>
			</div>

		</div>

		<div class="row mt-5 ">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/dossier/auteur/ajout_taitement" method="post">

					<div class="mb-3 row">
						<label for="nom-auteur" class="col-sm-2 col-form-label">Nom:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['ajouter-auteur-erreurs']['nom_aut']) ? 'is-invalid' : '' ?>" id="nom-auteur" name="nom_aut" placeholder="Veuillez entrer le nom de l'auteur" value="<?php if (isset($data["nom_aut"]) && !empty($data["nom_aut"])) {
																																																												echo $data["nom_aut"];
																																																											} else {
																																																												echo '';
																																																											} ?>">
							<?php
							if (isset($_SESSION['ajouter-auteur-erreurs']['nom_aut'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-auteur-erreurs']['nom_aut'] ?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="prenom-auteur" class="col-sm-2 col-form-label">Prénoms:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['ajouter-auteur-erreurs']['nom_aut']) ? 'is-invalid' : '' ?>" id="prenom-auteur" name="prenom_aut" placeholder="Veuillez entrer le(s) prénom(s)" value="<?php if (isset($data["nom_aut"]) && !empty($data["nom_aut"])) {
																																																													echo $data["nom_aut"];
																																																												} else {
																																																													echo '';
																																																												} ?>">
							<?php
							if (isset($_SESSION['ajouter-auteur-erreurs']['prenom_aut'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['ajouter-auteur-erreurs']['prenom_aut'] ?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 text-end mt-3">
							<button type="submit" class="btn btn-success"> Ajouter</button>
						</div>
					</div>
			</div>
			</form>
		</div>

		</div>
	</main>
</section>

<?php
unset($_SESSION['ajouter-auteur-erreurs'], $_SESSION['ajout-errors'], $_SESSION['ajout-success'], $_SESSION['auteur-existe'] );
include("footer.php");
?>