<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title?></title>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclure la bibliothèque du select2 -->
	<link rel="stylesheet" href="<?= PROJECT_DIR; ?>public/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= PROJECT_DIR; ?>public/select2-bootstrap4/select2-bootstrap4.min.css">
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
			<i class="bi bi-list toggle-sidebar-btn"></i>
		</div><!-- End Logo -->

		

		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">

				<li class="nav-item d-block d-lg-none">
					<a class="nav-link nav-icon search-bar-toggle " href="#">
						<i class="bi bi-search"></i>
					</a>
				</li><!-- End Search Icon-->

				



				<li class="nav-item dropdown pe-3">

				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<img src="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] == 'Non defini' ? PROJECT_DIR . 'public/image/user.png' : $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] ?>" style="width: 50px;" alt="Profile" class="rounded-circle">
					<span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?> <?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?></span>
				</a><!-- End Profile Iamge Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6><?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?> <?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?></h6>
							<span><?= $_SESSION['utilisateur_connecter_bibliothecaire']['profil'] ?></span>

						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/mon-profil">
								<i class="bi bi-person"></i>
								<span>Mon Profil</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/mon-profil">
								<i class="bi bi-gear"></i>
								<span>Paramètres du compte</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/aide/index">
								<i class="bi bi-question-circle"></i>
								<span>Besoin d'aide?</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/deconnexion">
								<i class="ri-logout-box-line"></i>
								<span>Se déconnecter</span>
							</a>
						</li>

					</ul><!-- End Profile Dropdown Items -->
				</li><!-- End Profile Nav -->

			</ul>
		</nav><!-- End Icons Navigation -->

	</header><!-- End Header -->

	<!-- ======= Sidebar ======= -->
	<aside id="sidebar" class="sidebar">

		<ul class="sidebar-nav" id="sidebar-nav">

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= PROJECT_DIR; ?>bibliothecaire/dashboard/index">
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
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/liste_des_auteurs">
							<i class="bi bi-circle"></i><span>Liste des auteurs</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/ajouter_auteurs">
							<i class="bi bi-circle"></i><span>Ajouter un auteur</span>
						</a>
					</li>

				</ul>
			</li>
			<!-- Fin menu auteur -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#ouvrages-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-book-fill"></i><span>OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/liste_des_ouvrages">
							<i class="bi bi-circle"></i><span>Liste des ouvrages</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/ajouter_ouvrage">
							<i class="bi bi-circle"></i><span>Ajouter un ouvrage </span>
						</a>
					</li>
				</ul>
			</li>
			<!-- Fin menu ouvrage -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#langues-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-pencil-fill"></i><span>LANGUES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="langues-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/liste_des_langues">
							<i class="bi bi-circle"></i><span>Liste des langues</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/ajouter_langue">
							<i class="bi bi-circle"></i><span>Ajouter une langue</span>
						</a>
					</li>
				</ul>
			</li>
			<!-- Fin menu langue -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#emprunts-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-edge-line"></i><span>EMPRUNTS</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="emprunts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/liste_des_emprunts">
							<i class="bi bi-circle"></i><span>Liste des emprunts</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/ajouter_emprunt">
							<i class="bi bi-circle"></i><span>Ajouter emprunts</span>
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
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/membre/liste_des_membres">
							<i class="bi bi-circle"></i><span>Liste des membres</span>
						</a>
					</li>
				</ul>	
					

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#domaines-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-earth-line"></i><span>DOMAINES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="domaines-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/liste_des_domaines">
							<i class="bi bi-circle"></i><span>Liste des domaines</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/ajouter_domaine">
							<i class="bi bi-circle"></i><span>Ajouter un domaine</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin  menu domaine -->

		

			<li class="nav-heading">Pages</li>

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= PROJECT_DIR; ?>bibliothecaire/contact/index">
					<i class="bi bi-envelope"></i>
					<span>Contact</span>
				</a>
			</li><!-- End Contact Page Nav -->

	</aside><!-- End Sidebar-->