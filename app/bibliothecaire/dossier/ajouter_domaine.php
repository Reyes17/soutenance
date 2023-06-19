<?php
if (!$_SESSION["utilisateur_connecter_bibliothecaire"]) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
} 
	include("haut.php");
?>

	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">
				<div class="col-md-6">
					<h1>Ajouter un domaine</h1>
				</div>

				<div class="col-md-6 text-end cefp-list-add-btn">
					<a href="liste_des_domaines" class="btn btn-primary">Liste des domaines</a>
				</div>
			</div>

			<div class="row mt-5">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="">

						<div class="mb-3 row">
							<label for="code-domaine" class="col-sm-2 col-form-label">Code:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="code-domaine" name="code-domaine" placeholder="Veuillez entrer le code du domaine">
							</div>
						</div>

						<div class="mb-3 row">
							<label for="libellé-domaine" class="col-sm-2 col-form-label">Libellé:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="libellé-domaine" name="libellé-domaine" placeholder="Veuillez entrer le libellé du domaine">
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
?>