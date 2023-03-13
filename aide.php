<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Aide</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="public/img/favicon.png" rel="icon">
  <link href="public/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="public/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="public/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="public/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="public/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="public/css/style.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

 <!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
    <img src="assets/image/bliotheque.jpg" alt="bliotheque.jpg">
      <span class="d-none d-lg-block">Gestion d'une bibliothèque</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
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



      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="" alt="" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>Kevin Anderson</h6>
            <span>Web Designer</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../mon-profil.php">
              <i class="bi bi-person"></i>
              <span>Mon Profil</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../mon-profil.php">
              <i class="bi bi-gear"></i>
              <span>Paramètres du compte</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../aide.php">
              <i class="bi bi-question-circle"></i>
              <span>Besoin d'aide?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <span>Se déconnecter</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->



 

  <main id="main" class="main">
    <p class="text-center p-5">
      This page is only available in the pro version! <a href="https://bootstrapmade.com/demo/templates/NiceAdmin/pages-faq.html" target="_blank">Preview the page online</a> | <a href="https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/#download" target="_blank">Buy the pro version</a>
    </p>
  </main><!-- End #main -->
  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="../index.php">
        <i class="bi bi-grid"></i>
        <span>Tableau de bord</span>
      </a>
    </li><!-- Fin menu dashboard -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#auteurs-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-app-store-line"></i><span>AUTEURS</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="auteurs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="auteur/liste_des_auteurs.php">
            <i class="bi bi-circle"></i><span>Listes des auteurs</span>
          </a>
        </li>
        <li>
          <a href="ajouter_auteurs.php">
            <i class="bi bi-circle"></i><span>Ajouter un auteur</span>
          </a>
        </li>
        
      </ul>
    </li><!-- Fin menu auteur -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#langues-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-pencil-fill"></i><span>LANGUES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="langues-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="listes_des_langues.php">
            <i class="bi bi-circle"></i><span>Listes des langues</span>
          </a>
        </li>
        <li>
          <a href="ajouter_langue.php">
            <i class="bi bi-circle"></i><span>Ajoutes une langue</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu langue -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#emprunts-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-edge-line"></i><span>EMPRUNTS</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="emprunts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_emprunts.php">
            <i class="bi bi-circle"></i><span>Liste des emprunts</span>
          </a>
        </li>
        <li>
          <a href="ajouter_emprunt.php">
            <i class="bi bi-circle"></i><span>Ajouter un emprunt</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu emprunt -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#membres-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-medium-line"></i><span>MEMBRES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="membres-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_membres.php">
            <i class="bi bi-circle"></i><span>Listes des membres</span>
          </a>
        </li>
        <li>
          <a href="ajouter_membre.php">
            <i class="bi bi-circle"></i><span>Ajouer un membre</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu membre -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#domaines-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-earth-line"></i><span>DOMAINES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="domaines-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_domaines.php">
            <i class="bi bi-circle"></i><span>Liste des domaines</span>
          </a>
        </li>
        <li>
          <a href="ajouter_domaine.php">
            <i class="bi bi-circle"></i><span>Ajouter un domaine</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin  menu domaine -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#domaines_ouvrages-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-open-line"></i><span>DOMAINES OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="domaines_ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_domaines_ouvrages.php">
            <i class="bi bi-circle"></i><span>Listes des domaines ouvrages</span>
          </a>
        </li>
        <li>
          <a href="ajouter_domaines_ouvrages.php">
            <i class="bi bi-circle"></i><span>Ajouer un domaine ouvrage</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu domaine ouvrage -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#date_parution-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-calendar-event-line"></i><span>DATE PARUTION</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="date_parution-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_dates_parutions.php">
            <i class="bi bi-circle"></i><span>Listes des dates parutions</span>
          </a>
        </li>
        <li>
          <a href="ajouter_date_parution.php">
            <i class="bi bi-circle"></i><span>Ajouer une date parution</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu date parution -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#auteurs_secondaires-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-input-method-line"></i><span>AUTEURS SECONDAIRES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="auteurs_secondaires-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="liste_des_auteurs_secondaires.php">
            <i class="bi bi-circle"></i><span>Listes des auteurs secondaire</span>
          </a>
        </li>
        <li>
          <a href="ajouter_auteur_secondaire.php">
            <i class="bi bi-circle"></i><span>Ajouer un auteur secondaire </span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu date parution -->
  
  
   
  
    
  
    <li class="nav-heading">Pages</li>
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="mon-profil.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link " href="aide.php">
        <i class="bi bi-question-circle"></i>
        <span>Aide</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="contact.php">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="inscription.php">
        <i class="bi bi-card-list"></i>
        <span>Inscription</span>
      </a>
    </li><!-- End Register Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="login.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Connexion</span>
      </a>
    </li><!-- End Login Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.php">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li><!-- End Error 404 Page Nav -->
  </ul>
  
  </aside><!-- End Sidebar-->
 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
  </div>
</footer><!-- End Footer -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
  <!-- Vendor JS Files -->
  <script src="public/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/vendor/chart.js/chart.umd.js"></script>
  <script src="public/vendor/echarts/echarts.min.js"></script>
  <script src="public/vendor/quill/quill.min.js"></script>
  <script src="public/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="public/vendor/tinymce/tinymce.min.js"></script>
  <script src="public/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="public/js/main.js"></script>

</body>

</html>