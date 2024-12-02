<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
	exit();
}
$title = 'Liste des auteurs';
include './app/commun/header.php';
$liste_auteur = get_listes_auteurs();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!-- Message de succès global lors de la modification de l'auteur -->
			<?php if (isset($_SESSION['modification_succès']) && !empty($_SESSION['modification_succès'])) { ?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['modification_succès'] ?>
				</div>
			<?php } ?>

			<!-- Message de succès global lors de la suppression de l'auteur -->
			<?php if (isset($_SESSION['suppression_succes']) && !empty($_SESSION['suppression_succes'])) { ?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['suppression_succes'] ?>
				</div>
			<?php unset($_SESSION['suppression_succes']);
			} ?>

			<!-- Message d'erreur global lors de la suppression de l'auteur -->
			<?php if (isset($_SESSION['suppression_erreur']) && !empty($_SESSION['suppression_erreur'])) { ?>
				<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['suppression_erreur'] ?>
				</div>
			<?php unset($_SESSION['suppression_erreur']);
			} ?>

			<!-- Titre et bouton d'ajout -->
			<div class="col-md-6">
				<h1>Liste des auteurs</h1>
			</div>
			<div class="col-md-6 text-end bibliothèque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/ajouter_auteurs" class="btn btn-primary">Ajouter un auteur</a>
			</div>
		</div>

		<!-- Tableau des auteurs -->
		<div class="row mt-5">
			<?php
			if (!empty($liste_auteur)) {
			?>
				<table class="table table-hover">
					<thead>
						<tr>

							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($liste_auteur as $key => $auteur) {
						?>
							<tr>

								<td><?php echo $auteur['nom_aut'] ?></td>
								<td><?php echo $auteur['prenom_aut'] ?></td>
								<td>


									<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/modifier_auteur/<?= $auteur['num_aut'] ?>" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer-<?= $auteur['num_aut'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton supprimer-->
							<div class="modal fade" id="cefp-ouvrage-supprimer-<?= $auteur['num_aut'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer l'auteur</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Êtes vous sûr de vouloir supprimer cet auteur ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/supprimer_traitement/<?= $auteur['num_aut'] ?>" class="btn btn-danger">Oui</a>
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
				echo 'Aucun auteur disponible pour le moment';
			}
			?>
		</div>
	</main>
</section>

<?php
include './app/commun/footer.php';
unset($_SESSION['modification_succès']);
?>