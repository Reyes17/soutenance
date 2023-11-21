<?php
$title = 'Formulaire des emprunts';
include 'app/commun/header_membre.php';


?>

<main id="main" style="margin-left: 0px; padding: 30px;">
    <div class="pagetitle">
        <h1>Formulaire d'emprunt</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines">Domaines</a></li>
                <li class="breadcrumb-item active">Emprunts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">

        <div class="row">
            
            <div class="col">
                <div class="card-body">
                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ouvrage</th>
                                <th scope="col">Langue</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Brandon Jacob</td>
                                <td>Designer</td>
                                <td>
                                    <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cefp-ouvrage-supprimer">Retirer l'ouvrage</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <!-- End Table with hoverable rows -->

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-success">Soumettre votre emprunt</button>
                </div>
            </div>

            <!-- Modal pour le bouton supprimer-->
            <div class="modal fade" id="cefp-ouvrage-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Retirer ouvrage</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Etes vous sur de vouloir retirer cet ouvrage ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                            <a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/retirer_traitement" class="btn btn-danger">Oui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include 'app/commun/footer_membre.php';
?>