<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Modifier catégorie';
include './app/commun/header.php';

if (isset($params['3']) && !empty($params['3']) && is_numeric($params['3'])) {
	$cod_cat = $params['3'];
	$_SESSION['cod_cat'] = $cod_cat;
	$cod_cat = get_categorie_by_id($cod_cat);
}

?>

<!-- =======================================================
	======================================================== -->
<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">

			<div class="col-md-6">
				<h1>Modifier la categorie</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/liste_des_categorie" class="btn btn-primary">Liste des catégories</a>
			</div>

		</div>

		<div class="row mt-5 ">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/categorie/modifier_categorie_traitement" method="post">

					<div class="mb-3 row">
						<label for="libellé-categorie" class="col-sm-2 col-form-label">Catégories :</label>
						<div class="col-sm-7">
							<input type="text" class="form-control <?= isset($_SESSION['modifications_errors']) ? 'is-invalid' : '' ?>" id="libellé-categorie" name="nom_cat" placeholder="Veuillez entrer la categorie" value="<?= isset($categorie['nom_cat']) ? $categorie['nom_cat'] : $data ?>">
							<?php
							if (isset($_SESSION['modifications_errors'])) {
							?>
								<div class="invalid-feedback">
									<?= $_SESSION['modifications_errors'] ?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-sm-9 text-end mt-3">
					<button class="btn btn-success"> Ajouter</button>
				</div>
			</div>
			</form>

		</div>

		</div>

	</main>
</section>
<?php
unset($_SESSION['modification_errors']);
include './app/commun/footer.php';
?>