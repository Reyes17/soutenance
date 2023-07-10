<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Listes des langues';
include './app/commun/header.php';
$liste_langue = get_liste_langue();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!----message de succès global lors de la modification de la langue---->
			<?php
			if (isset($_SESSION['modification_succès']) && !empty($_SESSION['modification_succès'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['modification_succès'] ?>
				</div>
			<?php
			}
			?>
			<!---message de succès global lors de la suppression de la langue---->
			<?php
			if (isset($_SESSION['suppression_succes']) && !empty($_SESSION['suppression_succes'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['suppression_succes'] ?>
				</div>
			<?php
				unset($_SESSION['suppression_succes']);
			}
			?>
			<!---message d'erreur global lors de la suppression de la langue---->
			<?php
			if (isset($_SESSION['suppression_erreur']) && !empty($_SESSION['suppression_erreur'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #dc3545; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['suppression_erreur'] ?>
				</div>
			<?php
				unset($_SESSION['suppression_erreur']);
			}
			?>
			<!-- =======================================================
			======================================================== -->
			<div class="col-md-6">
				<h1>Liste des langues</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/ajouter_langue" class="btn btn-primary">Ajouter une langue</a>
			</div>

		</div>

		<div class="row mt-5">
			<?php
			if (!empty($liste_langue)) {
			?>

				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Langue</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($liste_langue as $key => $langue) {
						?>
							<tr>

								<td><?php echo $langue['lib_lang'] ?></td>

								<td>


									<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/modifier_langue/<?= $langue['cod_lang'] ?>" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer-<?= $langue['cod_lang'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton supprimer-->
							<div class="modal fade" id="cefp-ouvrage-supprimer-<?= $langue['cod_lang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/supprimer_langue_traitement/<?= $langue['cod_lang'] ?>" class="btn btn-danger">Oui</a>
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
				echo 'Aucune langue disponible pour le moment';
			}
			?>
		</div>
	</main>
</section>



<?php
unset($_SESSION['modification_succès']);
include './app/commun/footer.php';
?>