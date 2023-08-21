<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Ouvrages';
include './app/commun/header.php';
$liste_ouvrages = get_liste_ouvrages();
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
			<?php
			if (!empty($liste_ouvrages)) {
			?>
			<table class="table table-hover">
				<thead>

					<tr>
						<th scope="col">Titre</th>
						<th scope="col">Nombre d'exemplaire</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				

					<tbody>
						<?php
						foreach ($liste_ouvrages as $key => $ouvrage) {
							$titre = $ouvrage['titre'];
                            $nb_exemplaire = $ouvrage['nb_ex'];
                            $cod_ouv = $ouvrage['cod_ouv'];
						?>
							<tr>
								<td><?php echo htmlspecialchars($titre); ?></td>
								<td><?php echo $nb_exemplaire; ?></td>
								<td>
								<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier-<?php echo $cod_ouv; ?>">Détails</a>


									<a href="modifier_ouvrage.php" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
								</td>
							</tr>
							<tr>


								<!-- Modal pour le bouton details-->
<div class="modal fade" id="cefp-ouvrage-modifier-<?php echo $cod_ouv; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage <?php echo $titre; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Domaines :</p>
                <?php
                $domaines = get_domaines_by_ouvrage($cod_ouv);
                foreach ($domaines as $domaine) {
                    echo htmlspecialchars($domaine['lib_dom']) . '<br>';
                }
                ?>

                <p>Auteurs secondaires :</p>
                <?php
                $auteursSecondaires = get_auteurs_secondaires_by_ouvrage($cod_ouv);
                foreach ($auteursSecondaires as $auteur) {
                    echo htmlspecialchars($auteur['prenom_aut']) . ' ' . htmlspecialchars($auteur['nom_aut']) . '<br>';
                }
                ?>

               
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
												<h5 class="modal-title" id="exampleModalLabel">Supprimer l'ouvrage</h5>
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
					</tbody>
				<?php
						}
				?>
				</table>
		</div>
	<?php
			} else {
				echo 'Aucune langue disponible pour le moment';
			}
	?>
	</main>
</section>



<?php
include './app/commun/footer.php';
?>