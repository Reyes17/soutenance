<?php
session_start();
include 'app/commun/index.php';
include 'app/commun/fonction/fonction.php';
$data = [];
if (isset($_SESSION['data']) && !empty($_SESSION['data'])) {
	$data = $_SESSION['data'];
}

if (check_if_user_connected()) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/dossier/dashboard');
} else {

	?>

	<div class="container">

		<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

						<div class="d-flex justify-content-center py-4">
							<a href="" class="logo d-flex align-items-center w-auto">
								<img src="<?= PROJECT_DIR; ?>public/image/bliotheque.jpg" alt="bliotheque.jpg">
								<span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
							</a>
						</div><!-- End Logo -->

						<div class="card mb-3">

							<div class="card-body">

								<div class="pt-4 pb-2">
									<?php
									if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
										?>
										<div class="alert alert-primary"
											 style="color: white; background-color: #1cc88a; border-color: snow;">
											<?= $_SESSION['success'] ?>
										</div>
										<?php
									}
									?>
									<h5 class="card-title text-center pb-0 fs-4">Connectez-vous à votre compte</h5>
									<p class="text-center small">Entrez votre nom d'utilisateur et votre mot de passe
										pour vous connecter</p>
								</div>

								<form class="row g-3 needs-validation"
									  action="<?= PROJECT_DIR; ?>membre/connexion/traitement" method="post">

									<div class="col-12 mt-3">
										<label for="incription_nom_utilisateur" class="form-label">Nom d'utilisateur
										</label>
										<div class="input-group has-validation">
											<span class="input-group-text" id="inputGroupPrepend">@</span>
											<input type="text"
												   class="form-control <?= isset($_SESSION['errors']['nom_utilisateur']) ? 'is-invalid' : '' ?>"
												   name="nom_utilisateur" id="nom_utilisateur"
												   value="<?php if (isset($data["nom_utilisateur"]) && !empty($data["nom_utilisateur"])) {
													   echo $data["nom_utilisateur"];
												   } else {
													   echo '';
												   } ?>" placeholder="Veuillez entrer un nom d'utilisateur">
											<?php
											if (isset($_SESSION['errors']['nom_utilisateur'])) {
												?>
												<div class="invalid-feedback">
													<?= $_SESSION['errors']['nom_utilisateur'] ?>
												</div>
												<?php
											}
											?>

											<!---<div class="invalid-feedback">Choisir un nom d'utilisateur.</div>---->
										</div>

									</div>

									<div class="col-12 mt-3">
										<label for="incription_mot_de_passe" class="form-label">Mot de passe

										</label>
										<input type="password"
											   class="form-control <?= isset($_SESSION['errors']['mot_de_passe']) ? 'is-invalid' : '' ?>"
											   name="mot_de_passe"
											   value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"])) {
												   echo $data["mot_de_passe"];
											   } else {
												   echo '';
											   } ?>" id="mot_de_passe" placeholder=" Veuillez entrer un mot de passe">
										<?php
										if (isset($_SESSION['errors']['mot_de_passe'])) {
											?>
											<div class="invalid-feedback">
												<?= $_SESSION['errors']['mot_de_passe'] ?>
											</div>
											<?php
										}
										?>
										<!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->

									</div>
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="rappeler" value="true"
												   id="serappeler">
											<label class="form-check-label" for="serappeler">Se rappeler</label>
										</div>
									</div>
									<div class="col-12">
										<button class="btn btn-primary w-100" type="submit">Connexion</button>
									</div>
									<div class="col-6">
										<p><a href="<?= PROJECT_DIR; ?>bibliothecaire/inscription">Créer un compte</a>
										</p>
									</div>
									<div class="col-6">
										<p><a href="<?= PROJECT_DIR; ?>bibliothecaire/mot_de_passe_oublie"> Mot de passe
												oublié</a></p>
									</div>
									<?php
									session_destroy()
									?>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

	</div>
	<?php
}
?>