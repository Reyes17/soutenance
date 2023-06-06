<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
?>
	<!-- =======================================================
	======================================================== -->

	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">

				<div class="col-md-6">
					<h1>Ajouter un auteur secondaire</h1>
				</div>

				<div class="col-md-6 text-end cefp-list-add-btn">
					<a href="liste_des_auteurs_secondaires" class="btn btn-primary">Liste des auteurs secondaires</a>
				</div>

			</div>

			<div class="row mt-5 ">

				<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

					<form action="">

						<div class="mb-3 row">
							<label for="nom-auteur" class="col-sm-2 col-form-label">Nom:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="cnom-auteur" name="nom-auteur" placeholder="Veuillez entrer le nom de l'auteur">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="prenom-auteur" class="col-sm-2 col-form-label">Prénoms:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="prenom-auteur" name="prenom-auteur" placeholder="Veuillez entrer le(s) prénom(s)">
							</div>
							<div class="row">
								<div class="col-sm-10 text-end mt-3">
									<button class="btn btn-success"> Ajouter</button>
								</div>
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