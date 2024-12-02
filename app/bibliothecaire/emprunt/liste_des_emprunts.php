<?php
// Vérification de l'authentification
if (!isset($_SESSION['utilisateur_connecter_bibliothecaire'])) {
    header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
    exit();
} 

$title = 'Liste des emprunts';
include './app/commun/header.php';

// Récupérer la liste des emprunts non actifs
$emprunts_non_actifs = get_emprunts_non_actifs();
?>

<section class="section dashboard">
    <main id="main" class="main">
        <div class="row">
            <div class="col-md-6">
                <h1>Liste des emprunts</h1>
            </div>

            <div class="col-md-6 text-end cefp-list-add-btn">
                <a href="ajouter_emprunt" class="btn btn-primary">Ajouter un emprunt</a>
            </div>
        </div>

        <div class="row mt-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Membres</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emprunts_non_actifs as $emprunt): ?>
                        <tr>
                            <th scope="row"><?php echo $emprunt['nom_utilisateur'] . ' ' . $emprunt['prenom_utilisateur']; ?></th>
                            <td>
                                <!-- Bouton Détails -->
                                <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" 
                                   data-bs-target="#cefp-ouvrage-modifier" 
                                   data-num-emp="<?php echo $emprunt['numero_emprunt']; ?>"
                                   data-titre-ouvrage="<?php echo $emprunt['titre_ouvrage']; ?>"
                                   data-date-emprunt="<?php echo $emprunt['date_emprunt']; ?>"
                                   data-date-butoir="<?php echo $emprunt['date_butoir']; ?>"
                                   data-code-ouvrage="<?php echo $emprunt['code_ouvrage']; ?>">
                                    Détails
                                </a>

                                <!-- Bouton Modifier -->
                                <a href="modifier_emprunt" class="btn btn-warning mb-3">Modifier</a>

                                <!-- Bouton Supprimer -->
                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</section>

<!-- Modal pour le bouton Détails -->
<div class="modal fade" id="cefp-ouvrage-modifier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Détails sur l'emprunt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Numéro d'emprunt : </strong><span id="modal-num-emp"></span></p>
                <p><strong>Titre de l'ouvrage : </strong><span id="modal-titre-ouvrage"></span></p>
                <p><strong>Date d'emprunt : </strong><span id="modal-date-emprunt"></span></p>
                <p><strong>Date butoir : </strong><span id="modal-date-butoir"></span></p>
                <p><strong>Code de l'ouvrage : </strong><span id="modal-code-ouvrage"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour le bouton Supprimer-->
<div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer l'emprunt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet emprunt ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button type="button" class="btn btn-danger">Oui</button>
            </div>
        </div>
    </div>
</div>

<?php
include './app/commun/footer.php';
?>

<script>
    // Récupérer les détails de l'emprunt pour afficher dans le modal
    var myModal = document.getElementById('cefp-ouvrage-modifier');
    myModal.addEventListener('show.bs.modal', function (event) {
        // Récupérer les informations des données d'attributs
        var button = event.relatedTarget; // Bouton qui a ouvert le modal
        var numEmp = button.getAttribute('data-num-emp');
        var titreOuvrage = button.getAttribute('data-titre-ouvrage');
        var dateEmprunt = button.getAttribute('data-date-emprunt');
        var dateButoir = button.getAttribute('data-date-butoir');
        var codeOuvrage = button.getAttribute('data-code-ouvrage');

        // Mettre à jour les contenus dans le modal
        document.getElementById('modal-num-emp').textContent = numEmp;
        document.getElementById('modal-titre-ouvrage').textContent = titreOuvrage;
        document.getElementById('modal-date-emprunt').textContent = dateEmprunt;
        document.getElementById('modal-date-butoir').textContent = dateButoir;
        document.getElementById('modal-code-ouvrage').textContent = codeOuvrage;
    });
</script>
