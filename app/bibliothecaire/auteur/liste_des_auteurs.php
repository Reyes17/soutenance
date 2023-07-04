<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
include("header.php");
$liste_auteur = get_liste_auteurs();
// Traitement de la suppression de l'auteur
if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    
   
	$nom_aut = $_POST['nom_aut'];
		
	   
	$prenom_aut = $_POST['prenom_aut'];
				
	$suppression_effectuee = delete_auteur($nom_aut, $prenom_aut);
	
	if ($suppression_effectuee) {
					   
	$_SESSION['delete'] = "L'auteur a été supprimé avec succès.";
		} else {
			$_SESSION['undelete'] = "Échec de la suppression de l'auteur ou l'auteur n'existe pas.";
		}	
	header("");
		exit();
	}
	
//die(var_dump($liste_auteur));
?>

<section class="section dashboard">

	<main id="main" class="main">
		<div class="row">
			<!----message de succès global lors de la suppression de l'auteur---->
			<?php
			if (isset($_SESSION['delete']) && !empty($_SESSION['delete'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['delete'] ?>
				</div>
			<?php
			}
			?>
			<!----message d'erreur global lors de la suppression de l'auteur---->
			<?php
			if (isset($_SESSION['undelete']) && !empty($_SESSION['undelete'])) {
			?>
				<div class="alert alert-primary mt-3" style="color: white; background-color: #2bc717; text-align:center; border-radius: 15px; text-align:center;">
					<?= $_SESSION['undelete'] ?>
				</div>
			<?php
			}
			?>
			<div class="col-md-6">
				<h1>Liste des auteurs</h1>
			</div>

			<div class="col-md-6 text-end bibliothèque-list-add-btn">
				<a href="auteur/ajouter_auteurs" class="btn btn-primary">Ajouter un auteur</a>
			</div>

		</div>
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
									<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-modifier">Détails</a>


									<a href="modifier_auteur" class="btn btn-warning mb-3">Modifier</a>

									<a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			<?php
			} else {
				echo 'aucun auteur disponible pour le moment';
			}
			?>

		</div>
	</main>

</section>

<!-- Modal pour le boutton details-->
<div class="modal fade" id="cefp-ouvrage-modifier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Détails sur l'ouvrage </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Contenu du détails sur l'auteur
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal pour le bouton supprimer-->
<div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="" class="btn btn-danger">Oui</a>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
?>