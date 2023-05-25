<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_connected()) {
	include("haut.php");
	?>

	<main id="main" class="main">

		<div class="pagetitle">
			<h1>Profil</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard">Home</a></li>
					<li class="breadcrumb-item active">Profil</li>
				</ol>
			</nav>
		</div><!-- End Page Title -->

		<section class="section profile">
			<div class="row">
				<div class="col-xl-4">

					<div class="card">
						<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

							<img src="" alt="Profile" class="rounded-circle">
							<h2>Kevin Anderson</h2>
							<h3>Web Designer</h3>
						</div>
					</div>

				</div>

				<div class="col-xl-8">

					<div class="card">
						<div class="card-body pt-3">
							<!-- Bordered Tabs -->
							<ul class="nav nav-tabs nav-tabs-bordered">

								<li class="nav-item">
									<button class="nav-link active" data-bs-toggle="tab"
											data-bs-target="#profile-overview">Aperçu
									</button>
								</li>

								<li class="nav-item">
									<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
										Modifier le profil
									</button>
								</li>

								<li class="nav-item">
									<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">
										Paramètres
									</button>
								</li>

								<li class="nav-item">
									<button class="nav-link" data-bs-toggle="tab"
											data-bs-target="#profile-change-password">Changer mot de passe
									</button>
								</li>

							</ul>
							<div class="tab-content pt-2">

								<div class="tab-pane fade show active profile-overview" id="profile-overview">
									<h5 class="card-title"> A propos</h5>
									<p class="small fst-italic"></p>

									<h5 class="card-title">Profil détails</h5>

									<div class="row">
										<div class="col-lg-3 col-md-4 label ">Nom & Prénoms</div>
										<div class="col-lg-9 col-md-8"></div>
									</div>


									<div class="row">
										<div class="col-lg-3 col-md-4 label">Job</div>
										<div class="col-lg-9 col-md-8"></div>
									</div>


									<div class="row">
										<div class="col-lg-3 col-md-4 label">Adresse</div>
										<div class="col-lg-9 col-md-8"></div>
									</div>

									<div class="row">
										<div class="col-lg-3 col-md-4 label">Téléphone</div>
										<div class="col-lg-9 col-md-8"></div>
									</div>

									<div class="row">
										<div class="col-lg-3 col-md-4 label">Email</div>
										<div class="col-lg-9 col-md-8"></div>
									</div>

								</div>

								<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

									<!-- Profile Edit Form -->
									<form>
										<div class="row mb-3">
											<label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profil
												Image</label>
											<div class="col-md-8 col-lg-9">
												<img src="assets/img/profile-img.jpg" alt="Profile">
												<div class="pt-2">
													<a href="#" class="btn btn-primary btn-sm"
													   title="Upload new profile image"><i class="bi bi-upload"></i></a>
													<a href="#" class="btn btn-danger btn-sm"
													   title="Remove my profile image"><i class="bi bi-trash"></i></a>
												</div>
											</div>
										</div>

										<div class="row mb-3">
											<label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom &
												Prénoms</label>
											<div class="col-md-8 col-lg-9">
												<input name="fullName" type="text" class="form-control" id="fullName"
													   value="">
											</div>
										</div>

										<div class="row mb-3">
											<label for="apropos" class="col-md-4 col-lg-3 col-form-label">A
												propos</label>
											<div class="col-md-8 col-lg-9">
												<textarea name="about" class="form-control" id="about"
														  style="height: 100px"></textarea>
											</div>
										</div>


										<div class="row mb-3">
											<label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
											<div class="col-md-8 col-lg-9">
												<input name="job" type="text" class="form-control" id="Job" value="">
											</div>
										</div>


										<div class="row mb-3">
											<label for="Address"
												   class="col-md-4 col-lg-3 col-form-label">Adresse</label>
											<div class="col-md-8 col-lg-9">
												<input name="address" type="text" class="form-control" id="Address"
													   value="">
											</div>
										</div>

										<div class="row mb-3">
											<label for="Phone"
												   class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
											<div class="col-md-8 col-lg-9">
												<input name="phone" type="text" class="form-control" id="Phone"
													   value="">
											</div>
										</div>

										<div class="row mb-3">
											<label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
											<div class="col-md-8 col-lg-9">
												<input name="email" type="email" class="form-control" id="Email"
													   value="">
											</div>
										</div>

										<div class="text-center">
											<button type="submit" class="btn btn-primary">Enregistrer</button>
										</div>
									</form><!-- End Profile Edit Form -->

								</div>

								<div class="tab-pane fade pt-3" id="profile-settings">

									<!-- Settings Form -->
									<form>

										<div class="row mb-3">
											<label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
												Notifications</label>
											<div class="col-md-8 col-lg-9">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="changesMade"
														   checked>
													<label class="form-check-label" for="modifications">
														Modifications apportées à votre compte
													</label>
												</div>


												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="securityNotify"
														   checked disabled>
													<label class="form-check-label" for="securityNotify">
														Alertes de sécurité
													</label>
												</div>
											</div>
										</div>

										<div class="text-center">
											<button type="submit" class="btn btn-primary">Enregistrer</button>
										</div>
									</form><!-- End settings Form -->

								</div>

								<div class="tab-pane fade pt-3" id="profile-change-password">
									<!-- Change Password Form -->
									<form>

										<div class="row mb-3">
											<label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de
												passe actuel</label>
											<div class="col-md-8 col-lg-9">
												<input name="password" type="password" class="form-control"
													   id="currentPassword">
											</div>
										</div>

										<div class="row mb-3">
											<label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau
												mot de passe</label>
											<div class="col-md-8 col-lg-9">
												<input name="newpassword" type="password" class="form-control"
													   id="newPassword">
											</div>
										</div>

										<div class="row mb-3">
											<label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer
												mot de passe</label>
											<div class="col-md-8 col-lg-9">
												<input name="renewpassword" type="password" class="form-control"
													   id="renewPassword">
											</div>
										</div>

										<div class="text-center">
											<button type="submit" class="btn btn-primary">Changer de mot de passe
											</button>
										</div>
									</form><!-- End Change Password Form -->

								</div>

							</div><!-- End Bordered Tabs -->

						</div>
					</div>

				</div>
			</div>
		</section>

	</main><!-- End #main -->

	<?php
	include('bas.php');
} else {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion/index');
}
?>

 