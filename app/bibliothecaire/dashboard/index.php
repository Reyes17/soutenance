<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Dashbord';
include './app/commun/header.php';
?>

	<section>
		<main id="main" class="main">

			<div class="pagetitle">
				<h1>Tableau de bord</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= PROJECT_DIR; ?>bibliothecaire/dashboard/index">Home</a></li>
						<li class="breadcrumb-item active">Tableau de bord</li>
					</ol>
				</nav>
			</div><!-- End Page Title -->
			<section class="section dashboard">
				<!-- Left side columns -->
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
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/liste_des_auteurs"> Voir
												plus</a></button>
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
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/liste_des_langues"> Voir
												plus</a></button>
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
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/liste_des_domaines">
												Voir plus</a></button>
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
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/membre/liste_des_membres"> Voir
												plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->

					<!-- table Card -->
					<div class="col-lg-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">MEMBRES INDELICATS</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="ri-markdown-line"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/membre_indelicat/liste_des_membres_indelicats">
												Voir plus</a></button>
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
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/liste_des_emprunts">
												Voir plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->

					<!-- table Card -->
					<div class="col-lg-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">OUVRAGES</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="ri-book-fill"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/liste_des_ouvrages">
												Voir plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->

					<!-- table Card -->
					<div class="col-lg-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">Catégories</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="ri-book-open-line"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/categorie/liste_des_categories">
												Voir plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->

					<!-- table Card -->
					<div class="col-lg-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">DATE PARUTION</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="ri-calendar-event-line"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/date_parution/liste_des_dates_parutions">
												Voir plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->

					<!-- table Card -->
					<div class="col-lg-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">AUTEURS SECONDAIRES</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="ri-input-method-line"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<button type="button" class="btn btn-outline-primary"><a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/liste_des_auteurs_secondaires">
												Voir plus</a></button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End table Card -->
		</main>
	</section>

<?php
include './app/commun/footer.php';
?>