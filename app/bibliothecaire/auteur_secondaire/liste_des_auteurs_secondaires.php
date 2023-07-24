<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Liste des auteurs secondaires';
include './app/commun/header.php';
$liste_auteur_secondaire = get_liste_auteurs_secondaire();
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
				<h1>Liste des auteurs secondaires</h1>
			</div>
			<div class="col-md-6 text-end bibliothèque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/ajouter_auteur_secondaire" class="btn btn-primary">Ajouter un auteur secondaire</a>
			</div>
		</div>
		<div class="row mt-5">
			<?php if (!empty($liste_auteur_secondaire)) { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($liste_auteur_secondaire as $key => $auteur_secondaire) { ?>
							<tr>
								<td><?= $auteur_secondaire['nom_aut_secondaire'] ?></td>
								<td><?= $auteur_secondaire['prenom_aut_secondaire'] ?></td>
								<td>
								<a href="#" class="btn btn-primary mb-3 btn-details" data-bs-toggle="modal" data-bs-target="#modal-details-<?= $auteur_secondaire['id'] ?>" data-id="<?= $auteur_secondaire['id'] ?>" data-nomaut-secondaire="<?= $auteur_secondaire['nom_aut_secondaire'] ?>" data-prenomaut-secondaire="<?= $auteur_secondaire['prenom_aut_secondaire'] ?>">Détails</a>

									<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/modifier_auteur_secondaire/<?= $auteur_secondaire['id'] ?>" class="btn btn-warning mb-3">Modifier</a>
									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modal-supprimer-<?= $auteur_secondaire['id'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le bouton "Détails" -->
							<div class="modal fade" id="modal-details-<?= $auteur_secondaire['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Détails sur l'auteur</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<p>Nom: <span id="nom-aut-secondaire-<?= $auteur_secondaire['id'] ?>"></span></p>
											<p>Prénoms: <span id="prenom-aut-secondaire-<?= $auteur_secondaire['id'] ?>"></span></p>
											<!-- Ajoutez d'autres informations de l'auteur ici -->
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal pour le bouton "Supprimer" -->
							<div class="modal fade" id="modal-supprimer-<?= $auteur_secondaire['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/supprimer_auteur_secondaire/<?= $auteur_secondaire['id'] ?>" class="btn btn-danger">Oui</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			<?php } else {
				echo 'Aucun auteur secondaire disponible pour le moment';
			} ?>
		</div>
	</main>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
    $('.btn-details').on('click', function() {
        var Id = $(this).data('id');
        var modal = $('#modal-details-' + Id);
        var nomAut = $(this).data('nomaut-secondaire');
        var prenomAut = $(this).data('prenomaut-secondaire');

        modal.find('#nom-aut-secondaire-' + Id).text(nomAut);
        modal.find('#prenom-aut-secondaire-' + Id).text(prenomAut);
    });
});

</script>

<?php
include './app/commun/footer.php';
unset($_SESSION['modification_succès']);
?>