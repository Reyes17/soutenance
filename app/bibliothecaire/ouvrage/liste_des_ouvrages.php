<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
    exit();
}
$title = 'Listes ouvrages';
include './app/commun/header.php';

// Récupérer la valeur du champ de recherche s'il a été soumis
$titre = !empty($_POST['titre']) ? $_POST['titre'] : '';

// Effectuer la recherche en fonction du titre
$liste_ouvrages = get_liste_ouvrages($titre);
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<div class="col-md-6">
				<h1>Liste des ouvrages</h1>
			</div>
			<div class="col-md-6 text-end cefp-list-add-btn">
				<a href="ajouter_ouvrage" class="btn btn-primary">Ajouter un ouvrage</a>
			</div>
		</div>

		<div class="row mt-5">
			<form action="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/liste_des_ouvrages" method="post">
				<div class="row">
					<div class="col-md-6 mb-3" style="display: flex;">
						<input type="text" class="form-control" value="<?= htmlspecialchars($titre) ?>" name="titre" placeholder="Rechercher un ouvrage par son titre">
						<button type="submit" name="search" class="btn btn-primary">Rechercher</button>
					</div>
				</div>
			</form>
		</div>

		<div class="row mt-5">
			<?php if (!empty($liste_ouvrages)) : ?>
				<table class="table text-center table-hover">
					<thead>
						<tr>
							<th scope="col">Titre</th>
							<th scope="col">Exemplaires</th>
							<th scope="col">Empruntés</th>
							<th scope="col">Disponibles</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($liste_ouvrages as $key => $ouvrage) : ?>
							<?php
							$titre = $ouvrage['titre'];
							$nb_exemplaire = $ouvrage['nb_ex'];
							$cod_ouv = $ouvrage['cod_ouv'];
							?>
							<tr>
								<td scope="row"><?php echo htmlspecialchars($titre); ?></td>
								<td><?php echo $nb_exemplaire; ?></td>
								<td></td>
								<td></td>
								<td>
									<a href="#" title="Détails" class="link-primary" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier-<?php echo $cod_ouv; ?>"><i class="bi bi-eye-fill"></i></a>
									<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/modifier_ouvrage/<?= $ouvrage['cod_ouv'] ?>" title="Modifier" class="link-warning m-3"><i class="bi bi-pencil-square"></i></a>

									<a href="#" class="link-danger mb-3" title="Supprimer" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
							<!-- Modal pour le bouton details -->
							<div class="modal modal-blur fade" id="cefp-ouvrage-modifier-<?php echo $cod_ouv; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage <?php echo $titre; ?></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body text-center">
											<!-- Ajoutez le nom de l'auteur de l'ouvrage -->
											<p class="fw-bold">Auteur :
												<?php
												$auteurPrincipal = get_auteur_by_id($ouvrage['num_aut']);
												if ($auteurPrincipal) {
													echo htmlspecialchars($auteurPrincipal['prenom_aut']) . ' ' . htmlspecialchars($auteurPrincipal['nom_aut']);
												} else {
													echo 'Auteur non trouvé';
												}
												?>
											</p>
											<p class="fw-bold">Domaines :
												<?php
												$domaines = get_domaines_by_ouvrage($cod_ouv);
												$domainesList = array_map(function ($domaine) {
													return htmlspecialchars($domaine['lib_dom']);
												}, $domaines);
												echo implode(' | ', $domainesList);
												?>
											</p>
											<p class="fw-bold">Auteurs secondaires :
												<?php
												$auteursSecondaires = get_auteurs_secondaires_by_ouvrage($cod_ouv);
												if (!empty($auteursSecondaires)) {
													$auteursList = array_map(function ($auteur) {
														return htmlspecialchars($auteur['prenom_aut']) . ' ' . htmlspecialchars($auteur['nom_aut']);
													}, $auteursSecondaires);
													echo implode(', ', $auteursList);
												} else {
													echo 'Aucun auteur secondaire';
												}
												?>
											</p>
											<p class="fw-bold">Langue | Année | Nombre:</p>
											<?php
											$detailsOuvrage = get_details_ouvrage($cod_ouv);
											if (!empty($detailsOuvrage)) {
												foreach ($detailsOuvrage as $detail) {
													echo '<p>' . htmlspecialchars($detail['langue']) . ' |' .  htmlspecialchars($detail['annee_publication'])  . '| ' . htmlspecialchars($detail['nb_exemplaire_langue']) . '</p>';
												}
											} else {
												echo '<p>Aucun détail disponible</p>';
											}
											?>
											<img class="resizable-image" src="<?php echo $ouvrage['img'] ?>" alt="Aucune image">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal pour le bouton supprimer-->
							<div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class= "modal-title" id="exampleModalLabel">Supprimer l'ouvrage</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Etes vous sur de vouloir supprimer ce ouvrage ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<button type="button" class="btn btn-danger">Oui</button>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<p>Aucun ouvrage disponible pour le moment</p>
			<?php endif; ?>
		</div>
	</main>
</section>
<?php include './app/commun/footer.php'; ?>
