<div class="mb-3 row">
    <label for="auteurs-secondaires-ouvrage" class="col-sm-2 col-form-label">Auteurs secondaires:</label>
    <div class="col-sm-10">
        <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage']) ? 'is-invalid' : '' ?>" id="auteurs-secondaires-ouvrage" name="auteurs-secondaires-ouvrage[]" multiple>
            <?php
            // Appeler la fonction pour récupérer la liste des auteurs secondaires
            $liste_auteur = get_liste_auteurs();

            // Afficher les auteurs secondaires dans le menu déroulant
            foreach ($liste_auteur as $auteur) {
                $selected = $auteur === $auteur['num_aut'] ? 'selected' : '';
                echo '<option value="' . $auteur['num_aut'] . '" ' . $selected . '>' . $auteur['nom_aut'] . ' ' . $auteur['prenom_aut'] . '</option>';
            }
            ?>
        </select>
        <?php if (isset($_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage'])) : ?>
            <div class="invalid-feedback">
                <?= $_SESSION['ajout-ouvrage-errors']['auteurs-secondaires-ouvrage'] ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="mb-3 row">
    <label for="domaineListe" class="col-sm-2 col-form-label">Domaine:</label>
    <div class="col-sm-10">
        <select class="form-select <?= isset($_SESSION['ajout-ouvrage-errors']['domaine-ouvrage']) ? 'is-invalid' : '' ?>" id="domaine-ouvrage" name="domaine-ouvrage[]" multiple>
            <option value="0"></option>
            <?php
            // Appeler la fonction pour récupérer la liste des domaines
            $liste_domaine = get_liste_domaine();

            // Afficher les domaines dans le menu déroulant
            foreach ($liste_domaine as $domaine_item) {
                $selected = $domaine === $domaine_item['cod_dom'] ? 'selected' : '';
                echo '<option value="' . $domaine_item['cod_dom'] . '" ' . $selected . '>' . $domaine_item['lib_dom'] . '</option>';
            }
            ?>
        </select>
        <?php if (isset($_SESSION['ajout-ouvrage-errors']['domaine-ouvrage'])) : ?>
            <div class="invalid-feedback">
                <?= $_SESSION['ajout-ouvrage-errors']['domaine-ouvrage'] ?>
            </div>
        <?php endif; ?>
    </div>
</div>



<div class="row mt-3">
    <label for="langue-et-annnee" class="col-sm-2 col-form-label">Langue et année de publication:</label>
    <div class="col-md-5">
        <select class="form-select langue-select <?= isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage']) ? 'is-invalid' : '' ?>" id="langue et annnee" name="langue[]" required data-index="0">
            <option value="0"></option>
            <?php
            // Appeler la fonction pour récupérer la liste des domaines
            $liste_langue = get_liste_langue();

            // Afficher les domaines dans le menu déroulant
            foreach ($liste_langue as $langue) {
                $selected = $langue === $langue['cod_lang'] ? 'selected' : '';
                echo '<option value="' . $langue['cod_lang'] . '" ' . $selected . '>' . $langue['lib_lang'] . '</option>';
            }
            ?>
        </select>
        <?php if (isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'])) : ?>
            <div class="invalid-feedback">
                <?= $_SESSION['ajout-ouvrage-errors']['langue-ouvrage'] ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-4">
        <select class="form-select annee-publication-select <?= isset($_SESSION['ajout-ouvrage-errors']['annee_publication']) ? 'is-invalid' : '' ?>" id="langue et annnee" name="annee_publication[]" required data-index="0">
            <option value="0"></option>
            <?php
            $anneeActuelle = date("Y");
            $anneeDebut = 1700; // Année de départ
            $anneeFin = $anneeActuelle; // Année de fin (utilise $anneeActuelle ou une autre valeur si nécessaire)

            for ($annee = $anneeDebut; $annee <= $anneeFin; $annee++) {
                $selected = in_array(strval($annee), $annee_publication) ? 'selected' : '';
                echo '<option value="' . $annee . '" ' . $selected . '>' . $annee . '</option>';
            }
            ?>
        </select>
        <?php if (isset($_SESSION['ajout-ouvrage-errors']['langue-ouvrage'])) : ?>
            <div class="invalid-feedback">
                <?= $_SESSION['ajout-ouvrage-errors']['langue-ouvrage'] ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-success btn-add">+</button>
    </div>
    <div id="form-container"></div>
</div>



// Vérification des auteurs secondaires
$data['auteurs-secondaires-ouvrage'] = $auteurs_secondaires;

// Vérification des domaines
if (empty($domaines)) {
$errors['domaine-ouvrage'] = "Aucun domaine n'a été sélectionné.";
} else {
$data['domaine-ouvrage'] = $domaines;
}

// Vérification des langues et dates de parution
foreach ($langues as $index => $langue) {
if ($langue == 0 || empty($dates_parution[$index])) {
$errors['langue-ouvrage'] = "Veuillez sélectionner une langue et une date de publication pour chaque entrée.";
break;
}
}



document.addEventListener('DOMContentLoaded', function() {
// Compteur pour identifier les champs ajoutés
let counter = 1;

// Fonction pour créer un nouveau champ "Langue et année de publication"
function createNewField() {
const row = document.createElement('div');
row.classList.add('row', 'mt-3');

const label = document.createElement('label');
label.classList.add('col-sm-2', 'col-form-label');
label.textContent = 'Langue et année de publication:';

const col1 = document.createElement('div');
col1.classList.add('col-md-5');

const selectLangue = document.createElement('select');
selectLangue.classList.add('form-select', 'langue-select');
selectLangue.name = 'langue[]';
selectLangue.required = true;
selectLangue.dataset.index = counter;
selectLangue.innerHTML = `
<option value="0"></option>
<?php
// Code PHP pour afficher les langues (comme dans ton code d'origine)
?>
`;

const col2 = document.createElement('div');
col2.classList.add('col-md-4');

const selectAnnee = document.createElement('select');
selectAnnee.classList.add('form-select', 'annee-publication-select');
selectAnnee.name = 'annee_publication[]';
selectAnnee.required = true;
selectAnnee.dataset.index = counter;
selectAnnee.innerHTML = `
<option value="0"></option>
<?php
// Code PHP pour afficher les années (comme dans ton code d'origine)
?>
`;

const col3 = document.createElement('div');
col3.classList.add('col-md-1');

const btnRemove = document.createElement('button');
btnRemove.type = 'button';
btnRemove.classList.add('btn', 'btn-danger', 'btn-remove');
btnRemove.textContent = '-';
btnRemove.dataset.index = counter;

col1.appendChild(selectLangue);
col2.appendChild(selectAnnee);
col3.appendChild(btnRemove);

row.appendChild(label);
row.appendChild(col1);
row.appendChild(col2);
row.appendChild(col3);

document.getElementById('form-container').appendChild(row);

// Incrémenter le compteur pour les futurs champs ajoutés
counter++;
}

// Fonction pour supprimer un champ "Langue et année de publication"
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
});



/ Assurez-vous de prendre en compte d'autres champs du formulaire
$requete_insertion = 'INSERT INTO ouvrage (titre, nb_ex, num_aut, img, creer_le, est_actif, est_supprimer, maj_le) VALUES (:titre, :nb_ex, :num_aut, :img, :creer_le, :est_actif, :est_supprimer, :maj_le)';

// Préparation de la requête
$requete_preparee = $db->prepare($requete_insertion);

// Exécution de la requête en liant les valeurs
$resultat_insertion = $requete_preparee->execute([
'titre' => $titre,
'nb_ex' => $nb_ex,
'num_aut' => $selectedAuteurId,
'img' => $img,
'creer_le' => time(),
'est_actif' => 1,
'est_supprimer' => 0,
'maj_le' => null
]);

// Vérification du résultat de l'insertion
if ($resultat_insertion) {
// Succès
$_SESSION['ajout-ouvrage-success'] = 'L\'ouvrage a été ajouté avec succès.';
header('Location: ' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter');
exit();
} else {
// Erreur
$_SESSION['ajout-ouvrage-error'] = 'Une erreur est survenue lors de l\'ajout de l\'ouvrage.';
header('Location: ' . PROJECT_DIR . 'bibliothecaire/ouvrage/ajouter');
exit();
}