<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
?>

	<section class="section dashboard">
		<main id="main" class="main">
			<div class="row">

				<div class="col-md-6">
					<h1>Liste des langues</h1>
				</div>

				<div class="col-md-6 text-end bibliotheque-list-add-btn">
					<a href="ajouter_langue" class="btn btn-primary">Ajouter une langue</a>
				</div>

			</div>

			<div class="row mt-5">

				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Code</th>
							<th scope="col">Libellé</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">001</th>
							<td>Français</td>

							<td>


								<a href="modifier_langue" class="btn btn-warning mb-3">Modifier</a>

								<a href="" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
						<tr>
							<th scope="row">002</th>
							<td>Anglais</td>

							<td>


								<a href="modifier_langue" class="btn btn-warning mb-3">Modifier</a>

								<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
						<tr>
							<th scope="row">003</th>
							<td>Espagnol</td>

							<td>


								<a href="modifier_langue" class="btn btn-warning mb-3">Modifier</a>

								<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
							</td>
						</tr>
					</tbody>
				</table>

			</div>
		</main>
	</section>

	<!-- Modal pour le bouton supprimer-->
	<div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Supprimer la langue</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Etes vous sur de vouloir supprimer cette langue ?
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