<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
	exit();
}
$title = 'Modifier un ouvrage';

include 'app/commun/header.php';
// Récupérer l'identifiant de l'ouvrage depuis $_GET
if (isset($params['3']) && !empty($params['3']) && is_numeric($params['3'])) {
	$ouvrage = $params['3'];
	$_SESSION['cod_ouv'] = $ouvrage;
	$ouvrage = get_ouvrage_by_id($ouvrage);
}
$auteurPrincipal = get_auteur_by_id($ouvrage['num_aut']);
$domaines = get_domaines_by_ouvrage($ouvrage['cod_ouv']);
$domainesList = array_map(function ($domaine) {
	return htmlspecialchars($domaine['lib_dom']);
}, $domaines);
$auteursSecondaires = get_auteurs_secondaires_by_ouvrage($ouvrage['cod_ouv']);
if (!empty($auteursSecondaires)) {
	$auteursList = array_map(function ($auteur) {
		return htmlspecialchars($auteur['prenom_aut']) . ' ' . htmlspecialchars($auteur['nom_aut']);
	}, $auteursSecondaires);
	echo implode(', ', $auteursList);
}
$detailsOuvrage = get_details_ouvrage($ouvrage['cod_ouv']);
if (!empty($detailsOuvrage)) {
	foreach ($detailsOuvrage as $detail) {
	}
}

if (!empty($_SESSION['data'])) {
	$data = $_SESSION['data'];
}

?>

<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
			<!---message d'erreur global lors de l'ajout de l'ouvrage---->
			<?php if (isset($_SESSION['ajout-ouvrage-error'])) : ?>
				<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['ajout-ouvrage-error'] ?>
				</div>
				<?php unset($_SESSION['ajout-ouvrage-error']); ?>
			<?php endif; ?>

			<!---message de succès global lors de l'ajout de l'ouvrage---->
			<?php if (isset($_SESSION['ajout-ouvrage-success'])) : ?>
				<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
					<?= $_SESSION['ajout-ouvrage-success'] ?>
				</div>
				<?php unset($_SESSION['ajout-ouvrage-success']); ?>
			<?php endif; ?>
			<div class="col-md-6">
				<h1>Modifier ouvrage</h1>
			</div>

			<div class="col-md-6 text-end bibliotheque-list-add-btn">
				<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/liste_des_ouvrages" class="btn btn-primary">Liste des ouvrages</a>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-md-12 col-lg-8 offset-lg-2 bd-example">
				<form action="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/traitement_modifier_ouvrage" method="post" enctype="multipart/form-data">
					<div class="col-md-12 mb-3">
						<label for="titre-ouvrage" class="form-label">Titre <span class="text-danger">(*)</span> :</label>
						<input type="text" class="form-control <?= !empty($_SESSION['ajout-ouvrage-errors']['titre-ouvrage']) ? 'is-invalid' : '' ?>" id="titre-ouvrage" name="titre-ouvrage" value="<?= !empty($ouvrage['titre']) ? $ouvrage['titre'] : $data ?>" placeholder="Veuillez entrer le titre de l'ouvrage">

						<?php if (!empty($_SESSION['ajout-ouvrage-errors']['titre-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['titre-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>


					<div class="col-md-12 mb-3">
						<label for="nombre-exemplaire-ouvrage" class="form-label">Nombre exemplaire <span class="text-danger">(*)</span> :</label>
						<input type="number" class="form-control <?= !empty($_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage']) ? 'is-invalid' : '' ?>" id="nombre-exemplaire-ouvrage" name="nombre-exemplaire-ouvrage" value="<?= !empty($ouvrage['nb_ex']) ? $ouvrage['nb_ex'] : $data ?>" placeholder="Veuillez entrer le nombre d'exemplaire">
						<?php if (isset($_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['nombre-exemplaire-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>

					<label for="auteur-principal-ouvrage" class="col-sm-2 col-form-label">Auteur <span class="text-danger">(*)</span> :</label>
					<div class="col-md-12 mb-3">
						<select class="form-select select2bs4 <?= isset($_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage']) ? 'is-invalid' : '' ?>" id="auteur-principal-ouvrage" name="auteur-principal-ouvrage">
							<option value="0"></option>
							<?php
							// Appeler la fonction pour récupérer la liste des auteurs
							$liste_auteurs = get_liste_auteurs();

							// Afficher les auteurs dans le menu déroulant
							foreach ($liste_auteurs as $auteur) {

							?>

								<option value="<?= $auteur['num_aut'] ?>" <?php if (!empty($data['auteur-principal-ouvrage']) && $data['auteur_principal_ouvrage'] == $auteur['num_aut']) {
																				echo 'selected';
																			} elseif ($ouvrage['num_aut'] == $auteur['num_aut']) {
																				echo 'selected';
																			} ?>>
									<?= $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] ?>
								</option>

							<?php
							}
							?>
						</select>
						<?php if (isset($_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['auteur-principal-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>
					<!-- Champ caché pour stocker l'ID de l'auteur sélectionné -->
					<input type="hidden" id="selected-auteur-id" name="selected-auteur-id" value="">

					<div class="col-md-12 mb-3">
						<label for="periodicite-ouvrage" class="col-sm-2 col-form-label">Périodicité :</label>
						<select class="form-select select2bs4<?= isset($_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage']) ? 'is-invalid' : '' ?>" id="periodicite-ouvrage" name="periodicite-ouvrage">
							<option value="0"></option>
							<option>Quotidien</option>
							<option>Hebdomadaire</option>
							<option>Mensuel</option>
							<option>Bimensuel</option>
							<option>Trimestriel</option>
							<option>Semestriel</option>
							<option>Annuel</option>
						</select>

						<?php if (isset($_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['periodicite-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="col-md-12 mb-3">
						<label for="auteurs-secondaires-ouvrage" class="form-label">Auteurs secondaires :</label>
						<select class="form-select select2bs4 <?= isset($erreurs['auteurs_secondaires_ouvrage']) ? 'is-invalid' : '' ?>" id="auteurs-secondaires-ouvrage" name="auteurs-secondaires-ouvrage[]" multiple>
							<option value="0"></option>
							<?php
							// Appeler la fonction pour récupérer la liste des auteurs
							$liste_auteurs = get_liste_auteurs();

							// Parcourez les auteurs disponibles
							foreach ($liste_auteurs as $auteur) {
							?>
								<option value="<?= $auteur['num_aut'] ?>" <?php echo !empty($data['auteurs-secondaires-ouvrage']) && in_array($auteur['num_aut'], $data['auteurs-secondaires-ouvrage']) ? 'selected' : '' ?>><?= $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] ?></option>
								<?php
							}

							// Parcourez les auteurs secondaires associés à l'ouvrage spécifique (dans $auteursList)
							if (!empty($auteursList)) {
								foreach ($auteursList as $auteur_secondaire) {
								?>
									<option value="<?= htmlspecialchars($auteur_secondaire) ?>" selected><?= htmlspecialchars($auteur_secondaire) ?></option>
							<?php
								}
							}
							?>
						</select>
						<?php if (isset($_SESSION['ajout-ouvrage-errors']['auteurs_secondaires_ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['auteurs_secondaires_ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="col-md-12 mb-3">
						<label for="image-ouvrage" class="form-label">Image de la page de garde <span class="text-danger">(*)</span> :</label>
						<input type="file" class="form-control <?= isset($_SESSION['ajout-ouvrage-errors']['image-ouvrage']) ? 'is-invalid' : '' ?>" id="image-ouvrage" name="image-ouvrage">
						<?php if (isset($_SESSION['ajout-ouvrage-errors']['image-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['image-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="col-md-12">
						<label for="domaines-ouvrage" class="col-sm-2 col-form-label">Domaines <span class="text-danger">(*)</span> :</label>
						<select class="form-select select2bs4 <?= isset($_SESSION['ajout-ouvrage-errors']['domaines-ouvrage']) ? 'is-invalid' : '' ?>" id="domaines-ouvrage" name="domaines-ouvrage[]" multiple>
							<option value="0"></option>
							<?php
							// Appeler la fonction pour récupérer la liste des domaines
							$liste_domaine = get_liste_domaine();

							// Parcourez les domaines disponibles
							foreach ($liste_domaine as $domaine_item) {
							?>
								<option value="<?= $domaine_item['cod_dom'] ?>" <?php echo !empty($data['domaines-ouvrage']) && in_array($domaine_item['cod_dom'], $data['domaines-ouvrage']) ? 'selected' : '' ?>><?= $domaine_item['lib_dom'] ?></option>
							<?php
							}

							// Parcourez les domaines associés à l'ouvrage spécifique (dans $domainesList)
							foreach ($domainesList as $domaine_item) {
							?>
								<option value="<?= htmlspecialchars($domaine_item) ?>" selected><?= htmlspecialchars($domaine_item) ?></option>
							<?php
							}
							?>
						</select>
						<?php if (!empty($_SESSION['ajout-ouvrage-errors']['domaines-ouvrage'])) : ?>
							<div class="invalid-feedback">
								<?= $_SESSION['ajout-ouvrage-errors']['domaines-ouvrage'] ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="row mt-3">
						<div class="col-md-3">
							<label for="langue" class="form-label">Langue <span class="text-danger">(*)</span> :</label>
							<select class="form-select select2bs4 <?= !empty($_SESSION['ouvrage-errors']['langue']) ? 'is-invalid' : '' ?>" id="langue" name="langue[]">
								<option value="0"></option>
								<?php
								// Appeler la fonction pour récupérer la liste des langues
								$liste_langue = get_liste_langue();
								$selectedLangue = $detailsOuvrage[0]['langue'];

								// Afficher les langues dans le menu déroulant
								foreach ($liste_langue as $langue_item) {
									$selected = $selectedLangue == $langue_item['cod_lang'] ? 'selected' : '';
									echo '<option value="' . $langue_item['cod_lang'] . '" ' . $selected . '>' . $langue_item['lib_lang'] . '</option>';
									echo 'Selected Langue: ' . $selectedLangue;
									echo 'Langue Item Cod Lang: ' . $langue_item['cod_lang'];
								}
								?>
							</select>
							<?php if (!empty($_SESSION['ouvrage-errors']['langue'])) : ?>
								<?php foreach ($_SESSION['ouvrage-errors']['langue'] as $error) : ?>
									<div class="invalid-feedback">
										<?= $error ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<div class="col-md-4">
							<label for="annee-publication" class="form-label">Année publication <span class="text-danger">(*)</span> :</label>
							<input type="number" class="form-control annee-publication <?= !empty($_SESSION['ouvrage-errors']['annee_publication']) ? 'is-invalid' : '' ?>" id="annee-publication" name="annee_publication[]" value="<?php echo $detailsOuvrage[0]['annee_publication']; ?>">
							<?php if (!empty($_SESSION['ouvrage-errors']['annee_publication'])) : ?>
								<?php foreach ($_SESSION['ouvrage-errors']['annee_publication'] as $error) : ?>
									<div class="invalid-feedback">
										<?= $error ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<div class="col-md-4">
							<label for="nb-exemplaire-langue" class="form-label">Nbres par langue<span class="text-danger">(*)</span> :</label>
							<input type="number" class="form-control nb-exemplaire-langue<?= !empty($_SESSION['ouvrage-errors']) ? 'is-invalid' : '' ?>" id="nb-exemplaire-langue" name="nb-exemplaire-langue[]" value="<?php echo $detailsOuvrage[0]['nb_exemplaire_langue']; ?>">
							<?php if (!empty($_SESSION['ouvrage-errors'])) : ?>
								<?php foreach ($_SESSION['ouvrage-errors'] as $error) : ?>
									<div class="invalid-feedback">
										<?= $error ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="col-md-1">
							<button type="button" class="btn btn-success btn-add">+</button>
						</div>
						<div id="form-container"></div>
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
<script>
	// Gérer le changement de sélection dans le champ de sélection de l'auteur
	document.getElementById('auteur-principal-ouvrage').addEventListener('change', function(event) {
		const selectedAuthorId = event.target.value;
		document.getElementById('selected-auteur-id').value = selectedAuthorId;
	});

	// Vérifier l'année de publication par rapport à l'année en cours
	function validatePublicationYear() {
		const anneePublicationInputs = document.querySelectorAll('.annee-publication');
		const anneeEnCours = new Date().getFullYear(); // Obtenir l'année en cours

		anneePublicationInputs.forEach(input => {
			input.addEventListener('blur', function() {
				const anneePublication = parseInt(input.value);

				if (anneePublication > anneeEnCours) {
					alert('L\'année de publication ne peut pas être supérieure à l\'année en cours (' + anneeEnCours + ').');
					input.value = ''; // Réinitialiser la valeur du champ
				}
			});
		});
	}

	// Fonction pour recalculer la somme des exemplaires par langue et vérifier
	function calculateAndCheckTotalExemplaires() {
		const nombreExemplaireInput = document.getElementById('nombre-exemplaire-ouvrage');
		const totalExemplaires = parseInt(nombreExemplaireInput.value);

		// Récupérer tous les champs d'exemplaires par langue
		const exemplairesLangueInputs = document.querySelectorAll('.nb-exemplaire-langue');

		// Calculer la somme des exemplaires par langue
		let sumExemplairesLangue = 0;
		exemplairesLangueInputs.forEach(input => {
			const exemplairesLangue = parseInt(input.value);
			if (!isNaN(exemplairesLangue)) {
				sumExemplairesLangue += exemplairesLangue;
			}
		});

		// Comparer la somme aux exemplaires totaux
		if (sumExemplairesLangue !== totalExemplaires) {
			// Afficher un message d'erreur
			alert('Noter que la somme d\'exemplaire par langue doit correspondre au nombre total d\'exemplaires.');
		}
	}

	// Écouter les changements dans le champ "Nombre exemplaire" lorsque l'utilisateur quitte le champ
	const nombreExemplaireInput = document.getElementById('nombre-exemplaire-ouvrage');
	nombreExemplaireInput.addEventListener('blur', calculateAndCheckTotalExemplaires);

	// Écouter les changements dans les champs "Exemplaire par langue" lorsque l'utilisateur quitte le champ
	const exemplairesLangueInputs = document.querySelectorAll('.nb-exemplaire-langue');
	exemplairesLangueInputs.forEach(input => {
		input.addEventListener('blur', calculateAndCheckTotalExemplaires);
	});

	document.addEventListener('DOMContentLoaded', function() {
		// Compteur pour identifier les champs ajoutés
		let counter = 1;

		// Fonction pour créer un nouveau groupe de champs
		function createNewField() {
			const row = document.createElement('div');
			row.classList.add('row', 'mt-3');

			// Langue
			const col1 = document.createElement('div');
			col1.classList.add('col-md-3');

			const labelLangue = document.createElement('label');
			labelLangue.classList.add('form-label');
			labelLangue.textContent = 'Langue:';

			const selectLangue = document.createElement('select');
			selectLangue.classList.add('form-select', 'langue-select');
			selectLangue.name = 'langue[]';
			selectLangue.required = true;
			selectLangue.dataset.index = counter;
			selectLangue.innerHTML = `
            <option value="0"></option>
            <?php
			// Appeler la fonction pour récupérer la liste des langues
			$liste_langue = get_liste_langue();

			// Afficher les langues dans le menu déroulant
			foreach ($liste_langue as $langue_item) {
				$selected = $data['langue_ouvrage'] == $langue_item['cod_lang'] ? 'selected' : '';
				echo '<option value="' . $langue_item['cod_lang'] . '" ' . $selected . '>' . $langue_item['lib_lang'] . '</option>';
			}
			?>
        `;

			col1.appendChild(labelLangue);
			col1.appendChild(selectLangue);

			// Année de Publication
			const col2 = document.createElement('div');
			col2.classList.add('col-md-4');

			const labelAnnee = document.createElement('label');
			labelAnnee.classList.add('form-label');
			labelAnnee.textContent = 'Année publication:';

			const inputAnnee = document.createElement('input');
			inputAnnee.type = 'number';
			inputAnnee.classList.add('form-control', 'annee-publication');
			inputAnnee.name = 'annee_publication[]';
			inputAnnee.required = true;
			inputAnnee.min = '0';

			col2.appendChild(labelAnnee);
			col2.appendChild(inputAnnee);

			// Nombre/langue
			const col3 = document.createElement('div');
			col3.classList.add('col-md-4');

			const labelNbLangue = document.createElement('label');
			labelNbLangue.classList.add('form-label');
			labelNbLangue.textContent = 'Nbres par langue:';

			const inputNbLangue = document.createElement('input');
			inputNbLangue.type = 'number';
			inputNbLangue.classList.add('form-control', 'nb-exemplaire-langue');
			inputNbLangue.name = 'nb-exemplaire-langue[]';

			col3.appendChild(labelNbLangue);
			col3.appendChild(inputNbLangue);

			// Bouton Supprimer
			const col4 = document.createElement('div');
			col4.classList.add('col-md-1');

			const btnRemove = document.createElement('button');
			btnRemove.type = 'button';
			btnRemove.classList.add('btn', 'btn-danger', 'btn-remove');
			btnRemove.textContent = '-';
			btnRemove.dataset.index = counter;

			col4.appendChild(btnRemove);

			// Ajout de tous les éléments au groupe de champs
			row.appendChild(col1);
			row.appendChild(col2);
			row.appendChild(col3);
			row.appendChild(col4);

			// Ajout du groupe de champs au conteneur
			document.getElementById('form-container').appendChild(row);

			// Incrémenter le compteur pour les futurs champs ajoutés
			counter++;

			// Appeler les fonctions de validation pour les champs initiaux
			validatePublicationYear();
			calculateAndCheckTotalExemplaires();
		}



		// Fonction pour supprimer un groupe de champs
		function removeField(index) {
			const fieldToRemove = document.querySelector(`[data-index="${index}"]`).closest('.row');
			fieldToRemove.remove();
		}

		// Gérer le clic sur le bouton "+"
		document.querySelector('.btn-add').addEventListener('click', function() {
			createNewField();
		});

		// Gérer le clic sur le bouton "-"
		document.addEventListener('click', function(event) {
			if (event.target.classList.contains('btn-remove')) {
				const indexToRemove = event.target.dataset.index;
				removeField(indexToRemove);
			}
		});

		// Appeler les fonctions de validation pour les champs initiaux
		validatePublicationYear();
		calculateAndCheckTotalExemplaires();
	});


	// Fonction pour valider que le champ nombre d'exemplaire contient uniquement des chiffres
	function validateNumberInput(event) {
		const input = event.target;
		const inputValue = input.value;

		// Vérifier si la valeur contient uniquement des chiffres
		if (!/^\d+$/.test(inputValue)) {
			input.classList.add('is-invalid');
		} else {
			input.classList.remove('is-invalid');
		}
	}
</script>

<?php
include './app/commun/footer.php';
unset($_SESSION['ajout-ouvrage-error'], $_SESSION['ajout-ouvrage-success'], $_SESSION['ajout-ouvrage-errors'], $_SESSION['saisie-precedente'], $_SESSION['data']);

?>