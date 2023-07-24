<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Listes des catégories';
include './app/commun/header.php';
$liste_categorie = get_liste_categorie();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!----message de succès global lors de la modification de la categorie---->
			<?php
			if (isset($_SESSION['modification_succès']) && !empty($_SESSION['modification_succès'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['modification_succès'] ?>
				</div>
			<?php
			}
			?>
			<!---message de succès global lors de la suppression de la categorie---->
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
			<!---message d'erreur global lors de la suppression de la categorie---->
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
				<h1>Liste des catégories</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/ajouter_categorie" class="btn btn-primary">Ajouter une catégorie</a>
			</div>

		</div>

		<div class="row mt-5">
			<?php
			if (!empty($liste_categorie)) {
			?>

				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Catégorie</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($liste_categorie as $key => $categorie) {
						?>
							<tr>

								<td><?php echo $categorie['nom_cat'] ?></td>

								<td>


									<a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/modifier_categorie/<?= $categorie['cod_cat'] ?>" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer-<?= $categorie['cod_cat'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton supprimer-->
							<div class="modal fade" id="cefp-ouvrage-supprimer-<?= $categorie['cod_cat'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer la catégorie</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Etes vous sur de vouloir supprimer cette categorie ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/supprimer_categorie_traitement/<?= $categorie['cod_cat'] ?>" class="btn btn-danger">Oui</a>
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
				echo 'Aucune catégorie disponible pour le moment';
			}
			?>
		</div>
	</main>
</section>



<?php
unset($_SESSION['modification_succès']);
include './app/commun/footer.php';
?>