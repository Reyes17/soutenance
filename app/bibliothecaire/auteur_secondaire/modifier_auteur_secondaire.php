<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Modifier auteur secondaire';
include 'app/commun/header.php';

if(isset($params['3']) && !empty($params['3']) && is_numeric($params['3'])){
	$id = $params['3'];
	$_SESSION['id']=$id;
	$auteur_secondaire = get_auteur_secondaire_by_id($id);
	if (!empty($auteur_secondaire)) {
		$nom_aut_secondaire = $auteur_secondaire['nom_aut_secondaire'];
		$prenom_aut_secondaire = $auteur_secondaire['prenom_aut_secondaire'];
	}
}
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<div class="col-md-6">
				<h1>Modifier l'auteur secondaire</h1>
			</div>

			<div class="col-md-6 text-end cefp-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/liste_des_auteurs_secondaires" class="btn btn-primary">Liste des auteurs secondaires</a>
			</div>

		</div>

		<div class="row mt-5 ">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/modifier_auteur_secondaire_traitement" method="post">

					<div class="mb-3 row">
						<label for="nom-auteur" class="col-sm-2 col-form-label">Nom:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['modification_errors']['nom_aut_secondaire']) ? 'is-invalid' : '' ?>" id="nom-auteur" name="nom_aut_secondaire" value="<?= isset($nom_aut_secondaire) ? $nom_aut_secondaire : '' ?><?= isset($_SESSION['nom_aut_secondaire']) ? $_SESSION['nom_aut_secondaire'] : '' ?>">
							
							<?php
							if (isset($_SESSION['modification_errors']['nom_aut_secondaire'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['modification_errors']['nom_aut_secondaire'] ?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="prenom-auteur" class="col-sm-2 col-form-label">Prénoms:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['modification_errors']['prenom_aut_secondaire']) ? 'is-invalid' : '' ?>" id="prenom-auteur" name="prenom_aut_secondaire" value="<?= isset($prenom_aut_secondaire) ? $prenom_aut_secondaire : '' ?><?= isset($_SESSION['prenom_aut_secondaire']) ? $_SESSION['prenom_aut_secondaire'] : '' ?>">
							
							<?php
							if (isset($_SESSION['modification_errors']['prenom_aut_secondaire'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['modification_errors']['prenom_aut_secondaire'] ?>
								</div>
							<?php
							}
							?>
						</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 text-end mt-3">
							<button class="btn btn-success"> Ajouter</button>
						</div>
					</div>
			</div>
			</form>
		</div>

		</div>

	</main>
</section>

<?php
include './app/commun/footer.php';
unset($_SESSION['modification_errors']);
?>