<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Ajouter un ouvrage';

include './app/commun/header.php';
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<div class="col-md-6">
				<h1>Ajouter un ouvrage</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="liste_des_ouvrages" class="btn btn-primary">Liste des ouvrages</a>
			</div>
		</div>

		<div class="row mt-5">

			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

				<form action="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/ajout_ouvrage_traitement" method="post" enctype="multipart/form-data">



					<div class="mb-3 row">
						<label for="titre-ouvrage" class="col-sm-2 col-form-label">Titre:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="titre-ouvrage" name="titre-ouvrage" placeholder="Veuillez entrer le titre de l'ouvrage">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="nombre-exemplaire-ouvrage" class="col-sm-2 col-form-label">Nombre d'exemplaire:</label>
						<div class="col-sm-10">
							<select class="form-select" id="nombre-exemplaire-ouvrage" name="nombre-exemplaire-ouvrage">
								<option value="0"></option>
								<?php
								for ($nombre = 1; $nombre <= 200; $nombre++) {
									$nombreFormatte = str_pad($nombre, 2, '0', STR_PAD_LEFT);
									echo '<option value="' . $nombreFormatte . '">' . $nombreFormatte . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="auteur-principal-ouvrage" class="col-sm-2 col-form-label">Auteur principal:</label>
						<div class="col-sm-7">
							<select class="form-select" id="auteur-principal-ouvrage" name="auteur-principal-ouvrage">
								<option value="0"></option>
								<?php
								// Appeler la fonction pour récupérer la liste des auteurs
								$liste_auteurs = get_liste_auteurs();

								// Afficher les auteurs dans le menu déroulant
								foreach ($liste_auteurs as $auteur) {
									echo '<option value="' . $auteur['num_aut'] . '">' . $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>



					<div class="mb-3 row">
						<label for="auteurs-secondaires-ouvrage" class="col-sm-2 col-form-label">Auteurs
							secondaires:
						</label>

						<div class="col-sm-7">
							<select class="form-select" id="auteurs-secondaires-ouvrage" name="auteurs-secondaires-ouvrage">
								<option value="0"></option>
								<?php
								// Appeler la fonction pour récupérer la liste des auteurs
								$liste_auteur_secondaire = get_liste_auteurs_secondaire();

								// Afficher les auteurs dans le menu déroulant
								foreach ($liste_auteur_secondaire as $auteur_secondaire) {
									echo '<option value="' . $auteur_secondaire['id'] . '">' . $auteur_secondaire['nom_aut_secondaire'] . ' ' . $auteur_secondaire['prenom_aut_secondaire'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="domaine-ouvrage" class="col-sm-2 col-form-label">Domaine:</label>
						<div class="col-sm-7">
							<select class="form-select" id="domaine-ouvrage" name="domaine-ouvrage">
								<option value="0"></option>
								<?php
								// Appeler la fonction pour récupérer la liste des auteurs
								$liste_domaine = get_liste_domaine();

								// Afficher les auteurs dans le menu déroulant
								foreach ($liste_domaine as $domaine) {
									echo '<option value="' . $domaine['cod_dom'] . '">' . $domaine['lib_dom']. '</option>';
								}
								?>
								<!-- Ajoutez ici les autres options de domaine -->
							</select>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="langue-ouvrage" class="col-sm-2 col-form-label">Langue:</label>
						<div class="col-sm-7">
							<select class="form-select" id="langue-ouvrage" name="langue-ouvrage">
								<option value="0"></option>
								<?php
								// Appeler la fonction pour récupérer la liste des auteurs
								$liste_langue = get_liste_langue();

								// Afficher les auteurs dans le menu déroulant
								foreach ($liste_langue as $langue) {
									echo '<option value="' . $langue['cod_lang'] . '">' . $langue['lib_lang']. '</option>';
								}
								?>
								<!-- Ajoutez ici les autres options de langue -->
							</select>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="categorie-ouvrage" class="col-sm-2 col-form-label">Catégorie:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="categorie-ouvrage" name="categorie-ouvrage" placeholder="Veuillez entrer la catégorie de l'ouvrage">
						</div>
					</div>

					<div class="mb-3 row">
						<label for="annee-publication" class="col-sm-2 col-form-label">Année de publication:</label>
						<div class="col-sm-10">
							<select class="form-select" id="annee-publication" name="annee-publication">
								<option value="0"></option>
								<?php
								$anneeActuelle = date("Y");
								for ($annee = 1870; $annee <= 2024; $annee++) {
									echo '<option value="' . $annee . '">' . $annee . '</option>';
								}
								?>
							</select>
						</div>
					</div>


					<div class="mb-3 row">
						<label for="image-ouvrage" class="col-sm-2 col-form-label">Image de la page de garde:</label>
						<div class="col-sm-7">
							<input type="file" class="form-control" id="image-ouvrage" name="image-ouvrage">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 text-center mt-3">
							<button type="submit" class="btn btn-success w-50"> Ajouter</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</main>
</section>

<?php
include './app/commun/footer.php';
?>