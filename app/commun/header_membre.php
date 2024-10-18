<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= PROJECT_DIR; ?>public/image/favicon.png" rel="icon">
	<link href="<?= PROJECT_DIR; ?>public/image/apple-icon.png" rel="apple-touch-icon">


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

	<!--- inclure toatify --->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js" integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css" integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- =======================================================
	======================================================== -->
</head>

<body>
	<!-- ======= Header ======= -->
	<header id="header" class="header fixed-top d-flex align-items-center">

		<div class="d-flex align-items-center justify-content-between">
			<a href="<?= PROJECT_DIR; ?>membre/accueil/index" class="logo d-flex align-items-center">
				<img src="<?= PROJECT_DIR; ?>public/image/logo.png" alt="logo.png">
				<span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
			</a>
		</div><!-- End Logo -->

		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">

				<li class="nav-item">
					<a class="nav-link nav-icon" href="<?= PROJECT_DIR; ?>membre/accueil"> Accueil </a>
				</li>

				<li class="nav-item">
					<a class="nav-link nav-icon" href="<?= PROJECT_DIR; ?>membre/utilisateur/a_propos"> A propos </a>
				</li>

				<li class="nav-item">
					<a class="nav-link nav-icon" href="<?= PROJECT_DIR; ?>membre/utilisateur/contact"> Conctez-nous </a>
				</li>

				<li class="nav-item d-block d-lg-none">
					<a class="nav-link nav-icon search-bar-toggle " href="#">
						<i class="bi bi-search"></i>
					</a>
				</li><!-- End Search Icon-->

				<?php if (isset($_SESSION["utilisateur_connecter_membre"])) { ?>
    <a class="nav-link nav-icon" href="<?= PROJECT_DIR; ?>membre/emprunt/formulaire_emprunt">
        <i class="bi bi-cart"></i>
        <span id="cartItemCount" class="badge bg-primary badge-number"><?= count($_SESSION['panier'] ?? []); ?></span>
    </a><!-- End Notification Icon -->
<?php } ?>


				<li class="nav-item dropdown pe-3">
					<?php
					if (!isset($_SESSION["utilisateur_connecter_membre"])) {
					?>

				<li>
					<a href="<?= PROJECT_DIR ?>membre/connexion/index" class="nav-link scrollto" style="background: #012970; color: #fff; padding: 10px 25px; margin-left: 30px; border-radius: 50px;"><strong>SE CONNECTER</strong></a>
				</li>
			<?php
					}
			?>

			<?php
			if (isset($_SESSION["utilisateur_connecter_membre"])) {
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
						<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>membre/utilisateur/catalogue">
							<i class="bx bxl-c-plus-plus"></i>
							<span>Catalogue</span>
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