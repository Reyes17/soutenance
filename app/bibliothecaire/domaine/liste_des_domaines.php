<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
    exit();
}
$title = 'Liste des domaines';
include './app/commun/header.php';
$liste_domaine = get_liste_domaine();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!----message de succès global lors de la modification du domaine---->
			<?php
			if (isset($_SESSION['modification_succès']) && !empty($_SESSION['modification_succès'])) {
			?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['modification_succès'] ?>
				</div>
			<?php
			}
			?>
			<!---message de succès global lors de la suppression du domaine---->
			<?php
			if (isset($_SESSION['suppression_succes']) && !empty($_SESSION['suppression_succes'])) {
			?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['suppression_succes'] ?>
				</div>
			<?php
				unset($_SESSION['suppression_succes']);
			}
			?>
			<!---message d'erreur global lors de la suppression du domaine---->
			<?php
			if (isset($_SESSION['suppression_erreur']) && !empty($_SESSION['suppression_erreur'])) {
			?>
				<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['suppression_erreur'] ?>
				</div>
			<?php
				unset($_SESSION['suppression_erreur']);
			}
			?>
			<!-- =======================================================
			======================================================== -->
			<div class="col-md-6">
				<h1>Liste des domaines</h1>
			</div>

			<div class="col-md-6 text-end cefp-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/ajouter_domaine" class="btn btn-primary">Ajouter un domaine</a>
			</div>
		</div>

		<div class="row mt-5">
			<?php
			if (!empty($liste_domaine)) {
			?>
				<table class="table table-hover">
					<thead>
						<tr>

							<th scope="coi">Domaine</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($liste_domaine as $key => $domaine) {
						?>
							<tr>

								<td><?php echo $domaine['lib_dom'] ?></td>

								<td>


									<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/modifier_domaine/<?= $domaine['cod_dom'] ?>" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer-<?= $domaine['cod_dom'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton supprimer-->
							<div class="modal fade" id="cefp-ouvrage-supprimer-<?= $domaine['cod_dom'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer le domaine</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Etes vous sur de vouloir supprimer ce domaine ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/supprimer_domaine_traitement/<?= $domaine['cod_dom'] ?>" class="btn btn-danger">Oui</a>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</tbody>
				</table>
			<?php
			} else {
				echo 'Aucun domaine disponible pour le moment';
			}
			?>
		</div>
	</main>
</section>

<?php
unset($_SESSION['modification_succès']);
include './app/commun/footer.php';
?>