<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title></title>
	<meta content="" name="description">
	<meta content="" name="keywords">


	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

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


			<li class="nav-item dropdown pe-3">

				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<img
						src="<?= isset($_SESSION['utilisateur_connecter']) ? $_SESSION['utilisateur_connecter']['avatar'] : 'avatar' ?>"
						style="width: 170px;" alt="Profile" class="rounded-circle">
					<span
						class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['utilisateur_connecter']['nom'] ?> <?= $_SESSION['utilisateur_connecter']['prenom'] ?></span>
				</a><!-- End Profile Iamge Icon -->

				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
					<li class="dropdown-header">
						<h6><?= $_SESSION['utilisateur_connecter']['nom'] ?> <?= $_SESSION['utilisateur_connecter']['prenom'] ?></h6>
						<span><?= $_SESSION['utilisateur_connecter']['profil'] ?></span>

					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li>
						<a class="dropdown-item d-flex align-items-center"
						   href="<?= PROJECT_DIR; ?>membre/utilisateur/mon-profil">
							<i class="bi bi-person"></i>
							<span>Mon Profil</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li>
						<a class="dropdown-item d-flex align-items-center"
						   href="<?= PROJECT_DIR; ?>membre/utilisateur/historique_emprunt">
							<i class="bi bi-h-circle"></i>
							<span>Historique des emprunts</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li>
						<a class="dropdown-item d-flex align-items-center"
						   href="<?= PROJECT_DIR; ?>membre/utilisateur/mon-profil">
							<i class="bi bi-gear"></i>
							<span>Paramètres du compte</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li>
						<a class="dropdown-item d-flex align-items-center"
						   href="<?= PROJECT_DIR; ?>membre/utilisateur/aide">
							<i class="bi bi-question-circle"></i>
							<span>Besoin d'aide?</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li>
						<a class="dropdown-item d-flex align-items-center"
						   href="<?= PROJECT_DIR; ?>membre/utilisateur/deconnexion">
							<i class="ri-logout-box-line"></i>
							<span>Se déconnecter</span>
						</a>
					</li>

				</ul><!-- End Profile Dropdown Items -->
			</li><!-- End Profile Nav -->

		</ul>
	</nav><!-- End Icons Navigation -->

</header><!-- End Header -->