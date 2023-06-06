<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
?>

	<section class="section dashboard">

		<main id="main" class="main">
			<div class="row">
				<div class="col-md-6">
					<h1>Liste des auteurs secondaires</h1>
				</div>
				<div class="col-md-6 text-end bibliothèque-list-add-btn">
					<a href="ajouter_auteur_secondaire" class="btn btn-primary">Ajouter un auteur secondaire</a>
				</div>
			</div>
			</div>
			<div class="row mt-5">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<tr>

							<td>Hugo</td>
							<td>Dom</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier">Détails</a>


								<a href="modifier_auteur_secondaire" class="btn btn-warning mb-3">Modifier</a>

								<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
						<tr>

							<td>Beethoveen</td>
							<td>Hugo</td>
							<td>

								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier">Détails</a>


								<a href="modifier_auteur_secondaire" class="btn btn-warning mb-3">Modifier</a>

								<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
						<tr>

							<td>Alan</td>
							<td>Walker</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier">Détails</a>


								<a href="modifier_auteur_secondaire" class="btn btn-warning mb-3">Modifier</a>

								<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</main>

	</section>

	<!-- Modal pour le boutton details-->
	<div class="modal fade" id="cefp-ouvrage-modifier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Contenu du détails sur l'auteur
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal pour le bouton supprimer-->
	<div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Supprimer l'auteur</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Etês-vous sûr de vouloir supprimer cet auteur ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
					<button type="button" class="btn btn-danger">Oui</button>
				</div>
			</div>
		</div>
	</div>

<?php
	include("bas.php");
} else {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion/index');
}
?>