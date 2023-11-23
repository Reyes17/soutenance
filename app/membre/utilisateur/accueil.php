<?php
$title = 'Accueil';
include 'app/commun/header_membre.php';
// Vérifier si le compte du membre a été supprimé ou désactivé par le bibliothécaire
if (isset($_SESSION['utilisateur_membre_connecter'])) {
  $idMembreConnecte = $_SESSION['utilisateur_membre_connecter']['id'];
  $membre = obtenir_membre_par_id($idMembreConnecte);

  if (!$membre || $membre['est_supprimer'] || !$membre['est_actif']) {
    // Rediriger vers la page de connexion avec le message
    header("Location: " . PROJECT_DIR . "membre/connexion/index?compte_supprime=1");
    exit;
  }
}
// Vérifier si le cookie avec le message de compte supprimé est présent
if (isset($_COOKIE['compte_supprime_message'])) {
  // Afficher le message avec le style appliqué
  echo '<div class="alert alert-danger mt-3" style="color: white; background-color: #dc3545; border: 5px; text-align: center;">' . $_COOKIE['compte_supprime_message'] . '</div>';

  // Supprimer le cookie après l'avoir affiché
  setcookie("compte_supprime_message", "", time() - 3600, "/");
}

?>



  <header>


    <!-- Slides with captions -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= PROJECT_DIR; ?>public/image/cafe-francfort-allemagne_1268-20912.avif" alt="cafe-francfort-allemagne_1268-20912.avif" style="width: 100%; height: 500px;" />
          <div class="carousel-caption d-none d-md-block">
            <h1>Bienvenue à la</h1> <br>
            <h1 style="background-color: #fff; color:#012970;">Bibliothèque AKAITSUKI</h1>
            <h3>Ici, vous pouvez voir la plupart des livres dont nous disposons tout en étant chez vous.</h3><br>
            <h3 style=color:#012970>Et ce n'est pas tout</h3>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= PROJECT_DIR; ?>public/image/livre-ses-pages-forme-coeur_23-2148213796.avif" alt="livre-ses-pages-forme-coeur_23-2148213796.avif" style="width: 100%; height: 500px;" />
          <div class="carousel-caption d-none d-md-block">
            <h1>Sur notre plateforme, la</h1> <br>
            <h1 style="color:#012970;">Bibliothèque AKAITSUKI</h1>
            <h3 style="background-color: #fff; color:#012970;">vous donne la possibilité de vous inscrire tous seul en tant que membre <br> afin de bénéficier de tous les avantages qui vont avec.</h3>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= PROJECT_DIR; ?>public/image/Jeune homme.avif" alt="Jeune homme.avif" style="width: 100%; height: 500px;" />
          <div class="carousel-caption d-none d-md-block">
            <h1>Avec notre plateforme,</h1>
            <h3 style="background-color: #fff; color:#012970;">Les emprunts deviennent encore plus facile.</h3>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

    </div><!-- End Slides with captions -->
  </header><!-- End Header -->

  <!-- ... Autres parties de votre code HTML ... -->

  <main id="main" style="margin-left: 0px; padding: 30px;">
    <section class="section dashboard">
      <h3 class="text-center font-weight-bold mb-3" style="background-color: #ccc; padding:10px" id="domaines">Domaines</h3>
      <div class="row">
        <?php
        $liste_domaines = get_liste_domaine();

        // Afficher les trois premiers domaines
        for ($i = 0; $i < 3 && $i < count($liste_domaines); $i++) {
          $domaine = $liste_domaines[$i];
          echo '<div class="col-md-3">';
          echo '<div class="card info-card sales-card">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $domaine['lib_dom'] . '</h5>';
          echo '<div class="d-flex align-items-center">';
          echo '<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">';
          echo '<i class="ri-earth-line"></i>';
          echo '</div>';
          echo '<div class="ps-3">';
          echo '<h5>' . $domaine['nb_ouvrages']  . ' ouvrages</h5>';
          echo '<a href="' . PROJECT_DIR . 'membre/domaine_ouvrage/index/' . $domaine['cod_dom'] . '"> Parcourir</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>

        <!-- Bouton "Le reste des domaines" -->
        <div class="col-md-3">
           <a class="btn btn-outline-primary mt-5 p-4" href="<?= PROJECT_DIR; ?>membre/domaine_ouvrage/liste_des_domaines">Le reste des domaines</a>
        </div>
      </div>
    </section>




  </main>



  <!-- ... Autres parties de votre code HTML ... -->



  <?php
  include 'app/commun/footer_membre.php';

  ?>