<?php
$title = 'Ouvrages';
if (empty($_SESSION["utilisateur_connecter_membre"])) {
  header('location:' . PROJECT_DIR . 'membre/connexion/index');
}
include 'app/commun/header_membre.php';
?>


<main id="main" style="margin-left: 0px; padding: 30px;">
  <div class="pagetitle">
    <h1>Catégorie</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>bibliothecaire/accueil/index">Accueil</a></li>
        <li class="breadcrumb-item">Domaines</li>
        <li class="breadcrumb-item active">Catégorie</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-4">
          <img src="<?= PROJECT_DIR; ?>public/image/Les amours_disperséees.jpg" class="card-img-top img-fluid" alt="Les amours_disperséees.jpg" style=" width: auto; height: 400px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <div>
              <h1 class="card-title">Les amours disperséees</h1>
              <h5 class="card-subtitle mb-2 text-muted">Auteur: Mahias Besserie</h5>
              <h5 class="card-subtitle mb-2 text-muted">Langue: Français</h5>
              <h6 class="card-subtitle mb-2 text-muted">Publié en: 2003</h6>
            </div>
            <button type="button" class="btn btn-outline-primary">Emprunter</button>
          </div>
        </div>
      </div>
            
    </div>
  </section>
</main>
<?php
include 'app/commun/footer_membre.php';

?>