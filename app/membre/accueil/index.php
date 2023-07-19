<?php
$title = 'Acceuil';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= PROJECT_DIR; ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= PROJECT_DIR; ?>public/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= PROJECT_DIR; ?>public/css/style.css" rel="stylesheet">

  <!-- =======================================================
	======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="<?= PROJECT_DIR; ?>public/image/bliotheque.jpg" alt="bliotheque.jpg">
        <span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
      </a>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <?php if (!empty($_SESSION["utilisateur_connecter_membre"])) { ?>
          <a class="nav-link nav-icon" href="<?= PROJECT_DIR; ?>membre/emprunt/formulaire_emprunt">
            <i class="bi bi-cart"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->
        <?php } ?>


        <li class="nav-item dropdown pe-3">
          <?php
          if (empty($_SESSION["utilisateur_connecter_membre"])) {
          ?>

        <li>
          <a href="<?= PROJECT_DIR ?>membre/connexion/index" class="nav-link scrollto" style="background: #012970; color: #fff; padding: 10px 25px; margin-left: 30px; border-radius: 50px;"><strong>SE CONNECTER</strong></a>
        </li>
      <?php
          }
      ?>

      <?php
      if (!empty($_SESSION["utilisateur_connecter_membre"])) {
      ?>

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= $_SESSION['utilisateur_connecter_membre']['avatar'] == 'Non defini' ? PROJECT_DIR . 'public/image/user.png' : $_SESSION['utilisateur_connecter_membre']['avatar'] ?>" style="width: 50px;" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['utilisateur_connecter_membre']['nom'] ?> <?= $_SESSION['utilisateur_connecter_membre']['prenom'] ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= $_SESSION['utilisateur_connecter_membre']['nom'] ?> <?= $_SESSION['utilisateur_connecter_membre']['prenom'] ?></h6>
            <span><?= $_SESSION['utilisateur_connecter_membre']['profil'] ?></span>

          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/mon_profil/mon-profil">
              <i class="bi bi-person"></i>
              <span>Mon Profil</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/mon_profil/historique_emprunt">
              <i class="bi bi-h-circle"></i>
              <span>Historique des emprunts</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/mon_profil/mon-profil">
              <i class="bi bi-gear"></i>
              <span>Paramètres du compte</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/mon_profil/aide">
              <i class="bi bi-question-circle"></i>
              <span>Besoin d'aide?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/mon_profil/deconnexion">
              <i class="ri-logout-box-line"></i>
              <span>Se déconnecter</span>
            </a>
          </li>
        <?php
      }
        ?>

        </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

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

  <main id="main" style="margin-left: 0px; padding: 50px;">

    <section class="section card">
      <div class="row">
        <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>

            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>

            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
            </ul>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body mt-3" style= background-color:black>
            <h5 class="card-title">Domaines</h5>
            <ul>
              <li><a href="#">Cuisine</a></li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
              <li>Cuisine</li>
            </ul>
          </div>
        </div>
      </div>

    </section>
  </main>

  <?php
  include 'app/commun/footer_membre.php';

  ?>