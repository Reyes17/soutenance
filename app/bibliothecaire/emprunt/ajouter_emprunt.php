<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
	exit();
}
$title = 'Ajouter un emprunt';
include './app/commun/header.php';
?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<div class="col-md-6">
				<h2>Ajouter Emprunts</h2>
			</div>
			<div class="col-md-6 text-end cefp-list-add-btn">
				<a href="liste_des_emprunts" class="btn btn-primary">Liste Emprunts</a>
			</div>
		</div>

		<div class="row mt-3">
			<form action="<?= PROJECT_DIR; ?>bibliothecaire/emprunts/traitement_ajouter_emprunt" method="post">
				<div class="mb-3 col-md-12">
					<label for="numero-membre" class="form-label">Membre :</label>
					<span class="text-danger">*</span>
					<select class="form-select <?= isset($erreurs['num_mem']) ? 'is-invalid' : '' ?>" id="numero-membre" name="num_mem">
						<option value="0">Sélectionner le membre auquel associer cet emprunt.</option>
						<?php
						// ... code pour afficher la liste des membres
						?>
					</select>
					<?php if (isset($erreurs['num_mem'])) : ?>
						<div class="invalid-feedback">
							<?= $erreurs['num_mem'] ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="ouvrages-container">
					<div class="ouvrage-row">
						<div class="row">
							<div class="col-md-5 ouvrage mt-3">
								<label class="form-label">Ouvrage(s) :</label>
								<span class="text-danger">*</span>

								<select class="form-select select2bs4 <?= isset($erreurs['cod_ouv']) ? 'is-invalid' : '' ?>" name="cod_ouv[]">
									<option value="0">Sélectionner un ouvrage</option>
									<?php
									$ouvrages = get_liste_ouvrages();
									foreach ($ouvrages as $ouvrage) {
										$langues = get_langues_for_ouvrage($ouvrage['cod_ouv']);
									?>
										<option value="<?= $ouvrage['cod_ouv']; ?>" data-langues="<?= json_encode($langues); ?>"><?= htmlspecialchars($ouvrage['titre']); ?></option>
									<?php
									}
									?>
								</select>
							</div>

							<div class="col-md-5 mt-3" id="langues">
								<label class="form-label">Langue(s) :</label>
								<select class="form-select select-langue" name="langue[]">
									<option value="0">Sélectionner une langue</option>
								</select>
							</div>


							<?php if (isset($erreurs['cod_ouv'])) : ?>
								<div class="invalid-feedback">
									<?= $erreurs['cod_ouv'] ?>
								</div>
							<?php endif; ?>
							<div class="col-md-1">
								<button type="button" class="btn btn-success btn-add-ouvrage mt-5">+</button>
							</div>
						</div>
					</div>
				</div>

				<div class="text-end">
					<button class="btn btn-success mt-5" type="submit">Ajouter</button>
				</div>
			</form>
		</div>
	</main>
</section>

<script>
	// Fonction pour cloner le modèle de champ d'ouvrage
	function cloneOuvrage() {
		var ouvrageContainer = document.querySelector('.ouvrage-row');
		var clone = ouvrageContainer.cloneNode(true);

		// Réinitialiser le champ cloné
		var languesSelect = clone.querySelector('.select-langue');
		languesSelect.innerHTML = '<option value="0">Sélectionner une langue</option>';

		// Mettre à jour le bouton du champ cloné
		var btnRemove = document.createElement('button');
		btnRemove.className = 'btn btn-danger btn-remove-ouvrage mt-3';
		btnRemove.textContent = '-';
		btnRemove.addEventListener('click', function() {
			clone.parentNode.removeChild(clone);
		});

		// Ajouter le bouton et le champ cloné
		clone.appendChild(btnRemove);
		document.querySelector('.ouvrages-container').appendChild(clone);
	}

	// Fonction pour mettre à jour les langues en fonction de l'ouvrage sélectionné
	function updateLangues(select) {
		// Récupérer les données JSON pour les langues depuis l'attribut "data-langues"
		var selectedLangues = JSON.parse(select.options[select.selectedIndex].getAttribute('data-langues'));

		// Sélectionner le champ de sélection des langues
		var languesSelect = select.closest('.ouvrage-row').querySelector('.select-langue');

		// Réinitialiser le champ des langues
		languesSelect.innerHTML = '<option value="0">Sélectionner une langue</option>';

		// Ajouter les options des langues en fonction de l'ouvrage sélectionné
		selectedLangues.forEach(function(langue) {
			var option = document.createElement('option');
			option.value = langue.id;
			option.textContent = langue.langue;
			languesSelect.appendChild(option);
		});
	}
	// Ajoutez un écouteur d'événement pour le bouton d'ajout d'ouvrage
	document.querySelector('.btn-add-ouvrage').addEventListener('click', cloneOuvrage);

	// Ajoutez un écouteur d'événement pour les changements de sélection d'ouvrage
	document.addEventListener('change', function(event) {
		if (event.target.classList.contains('select2bs4')) {
			updateLangues(event.target);
		}
	});
</script>

<?php
include './app/commun/footer.php';
?>