<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Listes des membres';
include 'app/commun/header.php';
$liste_membres = get_liste_membres();
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
		
			<div class="col-md-6">
				<h1>Liste des membres</h1>
			</div>

		</div>
		<div class="row mt-5">
			<?php if (!empty($liste_membres)) { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($liste_membres as $membre) { ?>
							<tr>
								<td><?= $membre['nom'] ?></td>
								<td><?= $membre['prenom'] ?></td>
								<td>
									<a href="#" class="btn btn-outline-info mb-3 btn-details" data-bs-toggle="modal" data-bs-target="#modal-details-<?= $membre['id'] ?>" data-id="<?= $membre['id'] ?>" data-email="<?= $membre['email'] ?>" data-adresse="<?= $membre['adresse'] ?>" data-sexe="<?= $membre['sexe'] ?>" data-date_naissance="<?= $membre['date_naissance'] ?>" data-telephone="<?= $membre['telephone'] ?>">Détails</a>

									<a href="#" class="btn btn-outline-danger mb-3 btn-supprimer" data-bs-toggle="modal" data-bs-target="#modal-supprimer" data-id="<?= $membre['id'] ?>">Supprimer</a>
									<a href="#" class="btn btn-outline-warning mb-3 btn-reactiver" data-bs-toggle="modal" data-bs-target="#modal-reactiver" data-id="<?= $membre['id'] ?>">Ré-activer</a>
								</td>
							</tr>
							<!-- Modal pour le boutton details-->
							<div class="modal fade" id="modal-details-<?= $membre['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Détails sur le membre</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<p><strong>Email :</strong> <?= $membre['email'] ?></p>
											<p><strong>Adresse :</strong> <?= $membre['adresse'] ?></p>
											<p><strong>Sexe :</strong> <?= $membre['sexe'] ?></p>
											<p><strong>Date de naissance :</strong> <?= $membre['date_naissance'] ?></p>
											<p><strong>Téléphone :</strong> <?= $membre['telephone'] ?></p>
											<!-- Ajoutez d'autres informations du membre ici -->
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>

							
							<!-- Modal pour le bouton "Supprimer" -->
							<div class="modal fade" id="modal-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer le membre</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Êtes-vous sûr de vouloir supprimer ce membre ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Non</button>
											<button type="button" class="btn btn-outline-danger" id="btn-confirmer-suppression">Oui</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal pour le bouton "Ré-activer" -->
							<div class="modal fade" id="modal-reactiver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Réactiver le membre</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Êtes-vous sûr de vouloir réactiver ce membre ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Non</button>
											<button type="button" class="btn btn-outline-success" id="btn-confirmer-suppression">Oui</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			<?php } else {
				echo 'Aucun membre disponible pour le moment';
			} ?>
		</div>
	</main>
</section>


<script>
	$(document).ready(function() {
		$('.btn-details').on('click', function() {
			var idMembre = $(this).data('id');
			var modal = $('#modal-details-' + idMembre);

			// Ajoutez les autres informations du membre ici
			var emailMembre = $(this).data('email');
			var adresseMembre = $(this).data('adresse');
			var sexeMembre = $(this).data('sexe');
			var dateNaissanceMembre = $(this).data('date_naissance');
			var telephoneMembre = $(this).data('telephone');

			modal.find('#email-membre').text(emailMembre);
			modal.find('#adresse-membre').text(adresseMembre);
			modal.find('#sexe-membre').text(sexeMembre);
			modal.find('#date-naissance-membre').text(dateNaissanceMembre);
			modal.find('#telephone-membre').text(telephoneMembre);
		});
	});

	// ...
    $(document).ready(function() {
        $('.btn-supprimer').on('click', function() {
            var idMembre = $(this).data('id');

            // Quand on clique sur le bouton "Oui" dans le modal de suppression
            $('#btn-confirmer-suppression').on('click', function() {
                // Appeler la fonction pour supprimer le compte du membre via AJAX
                supprimerCompteMembre(idMembre);
            });
        });

        // Fonction pour supprimer le compte du membre via AJAX
        function supprimerCompteMembre(idMembre) {
            $.ajax({
                url: '<?= PROJECT_DIR; ?>bibliothecaire/membre/supprimer_membre_traitement',
                method: 'POST',
                data: {
                    id: idMembre
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Afficher le message de succès directement sur la page sans utiliser la session
                        alert('La suppression a été effectuée avec succès !');
                        // Rafraîchir la page pour mettre à jour la liste des membres
                        window.location.reload();
                    } else {
                        // Afficher le message d'erreur directement sur la page sans utiliser la session
                        alert(data.message);
                    }
                },
                error: function() {
                    // Afficher un message d'erreur en cas d'erreur du serveur
                    alert('Une erreur s\'est produite lors de la suppression. Veuillez réessayer.');
                }
            });
        }
    });
</script>
<!-- ... -->

// ...

</script>
<?php
include 'app/commun/footer.php';
?>