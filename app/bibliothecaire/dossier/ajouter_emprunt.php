<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
	?>


	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">
				<div class="col-md-6">
					<h1>Ajouter un emprunt</h1>
				</div>

				<div class="col-md-6 text-end cefp-list-add-btn">
					<a href="liste_des_emprunts" class="btn btn-primary">Liste des emprunts</a>
				</div>
			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="">

						<div class="mb-3 row">
							<label for="numero-emprunt" class="col-sm-2 col-form-label">Emprunt:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="numero-emprunt" name="numero-emprunt"
									   placeholder="Veuillez entrer le numéro de l'emprunt">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="numero-membre" class="col-sm-2 col-form-label">Membre:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="numero-membre" name="numero-membre"
									   placeholder="Veuillez entrer l'identifiant ou le nom du membre">
							</div>
						</div>

						<div class="mb-3 row">
							<label for="code-ouvrage" class="col-sm-2 col-form-label">Code:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="code-ouvrage" name="code-ouvrage"
									   placeholder="Veuillez entrer l'ouvrage emprunter">
							</div>
						</div>


						<div class="mb-3 row">
							<label for="date-emprunt" class="col-sm-2 col-form-label">Date: </label>

							<div class="col-sm-7">
								<input type="date" class="form-control" id="date-emprunt" name="trip-start"
									   value="" min="1920-01-01" max="2050-01-01">
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
	include("bas.php");
} else {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion/index');
}
?>
 