<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tableau de bord</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<?php
include('header.php');
include('sidebar.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="">
          
          <div class="row">

            <!-- table Card -->
            <div class="col-lg-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">AUTEURS </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-app-store-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_auteurs.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

          <!-- table Card -->
          <div class="col-lg-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">LANGUES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-pencil-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_langues.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

            <!-- table Card -->
          <div class="col-lg-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">DOMAINES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-earth-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_domaines.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

            <!-- table Card -->
          <div class="col-lg-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">MEMBRES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-medium-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_membres.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

            <!-- table Card -->
          <div class="col-lg-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">EMPRUNTS</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-edge-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_emprunts.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

            <!-- table Card -->
          <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">OUVRAGES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-book-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_ouvrages.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

             <!-- table Card -->
          <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">DOAMINES OUVRAGES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-book-open-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_domaines_ouvrages.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

             <!-- table Card -->
          <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">DATE PARUTION</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-calendar-event-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_dates.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

             <!-- table Card -->
          <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">AUTEURS SECONDAIRES</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-input-method-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <button type="button" class="btn btn-outline-primary"><a href="liste_des_auteurs_secondaires.php"> Voir plus</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End table Card -->

         </div>

 <?php
  include('footer.php')
?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>