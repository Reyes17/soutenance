<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
?>

	<section class="section dashboard">
		<main id="main" class="main">

			<div class="row">

				<div class="col-md-6">
					<h1>Modifier le membre</h1>
				</div>

				<div class="col-md-6 text-end bibliotheque-list-add-btn">
					<a href="liste_des_membres.php" class="btn btn-primary">Liste des membres</a>
				</div>

			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="">

						<div class="mb-3 row">
							<label for="nom-membre" class="col-sm-2 col-form-label">Nom:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="cnom-membre" name="nom-membre" placeholder="Veuillez entrer le nom">
							</div>
						</div>

						<div class="mb-3 row">
							<label for="prenom-membre" class="col-sm-2 col-form-label">Prénoms:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="prenom-membre" name="prenom-membre" placeholder="Veuillez entrer le(s) prénom(s)">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="sexe" class="col-sm-2 col-form-label">Sexe: </label>
							<div class="col-sm-7">
								<select class="sexe" id="sexe" name="sexe">
									<option value="1">Masculin</option>
									<option value="2">Féminin</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-10 text-end mt-3">
								<button class="btn btn-success"> Ajouter</button>
							</div>
						</div>
					</form>
				</div>
		</main>
	</section>

<?php
	include("bas.php");
} else {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion/index');
}
?>