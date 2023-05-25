<?php
$user_connected = check_if_user_conneted();

if (!$user_connected) {
	header('location:' . PROJECT_DIR . 'membre/connexion');
}
include("haut.php");
?>

	<section class="section">


		<div class="container-fluid" style="margin-top: 5%;">
			<div class="card-header py-3">
				<h1 class="m-0 font-weight-bold">Historique de mes emprunts</h1>
			</div>
			<div class="card-body">
				<div class="table-responsive">

					<table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th>Numéro emprunts</th>
							<th>Ouvrages</th>
							<th>Statut</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>A101</td>
							<td>les fleurs du mal</td>
							<td>
								<div class="btn btn-warning">Emprunter</div>
								<div class="btn btn-success">Rendu</div>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						<tr>
							<td>A102</td>
							<td>Anastasie</td>
							<td>
								<button type="" class="btn btn-success">Rendu</button>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						<tr>
							<td>A103</td>
							<td>Les misérables</td>
							<td>
								<button type="" class="btn btn-warning">Emprunter</button>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						<tr>
							<td>B101</td>
							<td>A101</td>
							<td>
								<div class="btn btn-success">Rendu</div>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						<tr>
							<td>B102</td>
							<td>Tom Soyer</td>
							<td>
								<button type="submit" class="btn btn-success">Rendu</button>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						<tr>
							<td>B103</td>
							<td>Avengers</td>
							<td>
								<button type="submit" class="btn btn-warning">Emprunter</button>
							</td>
							<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal"
								   data-bs-target="#cefp-ouvrage-modifier">Voir les détails</a>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		</div>
		<!-- Modal pour le boutton details-->
		<div class="modal fade" id="cefp-ouvrage-modifier" tabindex="-1" aria-labelledby="exampleModalLabel"
			 aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Détails sur votre emprunt </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Contenu du détails sur l'emprunt
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
<?php
include('bas.php')
?>