<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_conneted()) {
	include("haut.php");
	?>

	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">
				<div class="col-md-6">
					<h1>Ajouter un ouvrage</h1>
				</div>

				<div class="col-md-6 text-end bibliotheque-list-add-btn">
					<a href="liste_des_ouvrages" class="btn btn-primary">Liste des ouvrages</a>
				</div>
			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="">

						<div class="mb-3 row">
							<label for="code-ouvrage" class="col-sm-2 col-form-label">Code:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="code-ouvrage" name="code-ouvrage"
									   placeholder="Veuillez entrer le code de l'ouvrage">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="titre-ouvrage" class="col-sm-2 col-form-label">Titre:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="titre-ouvrage" name="titre-ouvrage"
									   placeholder="Veuillez entrer le titre de l'ouvrage">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="nombre-exemplaire-ouvrage" class="col-sm-2 col-form-label">Nombre
								d'exemplaire:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nombre-exemplaire-ouvrage"
									   name="nombre-exemplaire-ouvrage"
									   placeholder="Veuillez entrer le nombre d'exemplaire de l'ouvrage">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="auteur-principal-ouvrage" class="col-sm-2 col-form-label">Auteur
								principal: </label>

							<div class="col-sm-7">
								<select class="form-select js-example-basic-single" id="auteur-principal-ouvrage"
										name="auteur-principal-ouvrage">
									<option value="0"></option>
									<option value="1">Beethoveen</option>
									<option value="2">Hugo</option>
									<option value="3">Alan Walker</option>

								</select>
							</div>
						</div>

						<div class="mb-3 row">
							<label for="auteurs-secondaires-ouvrage" class="col-sm-2 col-form-label">Auteurs
								secondaires:
							</label>

							<div class="col-sm-7">
								<select class="form-select" id="auteurs-secondaires-ouvrage"
										name="auteurs-secondaires-ouvrage">
									<option value="0"></option>
									<option value="1">Beethoveen</option>
									<option value="2">Hugo</option>
									<option value="3">Alan Walker</option>

								</select>
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
 