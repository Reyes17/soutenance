<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Liste des auteurs';
include './app/commun/header.php';
$liste_auteur = get_liste_auteurs();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<?php if (isset($_SESSION['modification_succès']) && !empty($_SESSION['modification_succès'])) { ?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['modification_succès'] ?>
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['suppression_succes']) && !empty($_SESSION['suppression_succes'])) { ?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['suppression_succes'] ?>
				</div>
			<?php unset($_SESSION['suppression_succes']);
			} ?>
			<?php if (isset($_SESSION['suppression_erreur']) && !empty($_SESSION['suppression_erreur'])) { ?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['suppression_erreur'] ?>
				</div>
			<?php unset($_SESSION['suppression_erreur']);
			} ?>
			<div class="col-md-6">
				<h1>Liste des auteurs</h1>
			</div>
			<div class="col-md-6 text-end bibliothèque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/ajouter_auteurs" class="btn btn-primary">Ajouter un auteur</a>
			</div>
		</div>
		<div class="row mt-5">
			<?php if (!empty($liste_auteur)) { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($liste_auteur as $key => $auteur) { ?>
							<tr>
								<td><?= $auteur['nom_aut'] ?></td>
								<td><?= $auteur['prenom_aut'] ?></td>
								<td>
									<a href="#" class="btn btn-primary mb-3 btn-details" data-bs-toggle="modal" data-bs-target="#modal-details-<?= $auteur['num_aut'] ?>" data-numaut="<?= $auteur['num_aut'] ?>">Détails</a>
									<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/modifier_auteur/<?= $auteur['num_aut'] ?>" class="btn btn-warning mb-3">Modifier</a>
									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modal-supprimer-<?= $auteur['num_aut'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton "Détails" -->
							<div class="modal fade" id="modal-details-<?= $auteur['num_aut'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Détails sur l'auteur</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<p>Nom: <span id="nom-aut-<?= $auteur['num_aut'] ?>"></span></p>
											<p>Prénoms: <span id="prenom-aut-<?= $auteur['num_aut'] ?>"></span></p>
											<!-- Ajoutez d'autres informations de l'auteur ici -->
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal pour le bouton "Supprimer" -->
							<div class="modal fade" id="modal-supprimer-<?= $auteur['num_aut'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer l'auteur</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Êtes-vous sûr de vouloir supprimer cet auteur ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/supprimer_traitement/<?= $auteur['num_aut'] ?>" class="btn btn-danger">Oui</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			<?php } else {
				echo 'Aucun auteur disponible pour le moment';
			} ?>
		</div>
	</main>
</section>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
	<div class="copyright">
		&copy; Copyright <strong><span>Bibliothèque AKAITSUKI 2023</span></strong>. All Rights Reserved
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= PROJECT_DIR; ?>public/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/chart.js/chart.umd.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/echarts/echarts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/quill/quill.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= PROJECT_DIR; ?>public/js/main.js"></script>
<script>
	$(document).ready(function() {
		$('.btn-details').on('click', function() {
			var numAut = $(this).data('numaut');
			var modal = $('#modal-details-' + numAut);

			// Récupérer les informations de l'auteur à partir de votre source de données
			var nomAut = "<?= $auteur['nom_aut'] ?>";
			var prenomAut = "<?= $auteur['prenom_aut'] ?>";

			modal.find('#nom-aut-' + numAut).text(nomAut);
			modal.find('#prenom-aut-' + numAut).text(prenomAut);
		});
	});
</script>

</body>

</html>
<?php
unset($_SESSION['modification_succès']);
?>