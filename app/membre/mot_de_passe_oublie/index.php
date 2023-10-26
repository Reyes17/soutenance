<?php
if (isset($_SESSION["utilisateur_connecter_membre"])) {
	header('location:' . PROJECT_DIR . 'membre/utilisateur/acceuil');
}
$title = "Mot de passe oublié";
include './app/commun/index.php';
?>

<main>
	<div class="container">

		<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class=" col-md-6 d-flex flex-column align-items-center justify-content-center">

						<div class="d-flex justify-content-center py-4">
							<a href="" class="logo d-flex align-items-center w-auto">
								<img src="<?= PROJECT_DIR; ?>public/image/bliotheque.jpg" alt="bliotheque.jpg">
								<span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
							</a>
						</div><!-- End Logo -->

						<div class="card mb-3">

							<div class="card-body">
								<!----message de succès global lors du processus d'envoi de mail pour un changement de mot de passe----->
								<?php
								if (isset($_SESSION['mot_passe_message_success_global']) && !empty($_SESSION['mot_passe_message_success_global'])) {
								?>
									<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
										<?= $_SESSION['mot_passe_message_success_global'] ?>
									</div>
								<?php
								}
								?>
								<!----message d'erreur global lors du processus d'envoi de mail pour un changement de mot de passe----->
								<?php
								if (isset($_SESSION['mot_passe_message_erreur_global']) && !empty($_SESSION['mot_passe_message_erreur_global'])) {
								?>
									<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
										<?= $_SESSION['mot_passe_message_erreur_global'] ?>
									</div>
								<?php
								}

								?>

								<?php
								if (isset($_SESSION['validation-compte-message-erreur']) && !empty($_SESSION['validation-compte-message-erreur'])) {
								?>
									<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
										<?= $_SESSION['validation-compte-message-erreur'] ?>
									</div>
								<?php
								}

								?>

								<div class="pt-4 pb-2">
									<h5 class="card-title text-center pb-0 fs-4">Aviez-vous oublier votre mot de
										passe?</h5>
									<p class="text-center small">Veuillez entrer votre compte email afin de recevoir un
										message</p>
								</div>

								<form class="row needs-validation" action="<?= PROJECT_DIR; ?>membre/mot_de_passe_oublie/traitement" method="post" novalidate>

									<div class="col-12">
										<label for="inscription-email" style="color:black;">
											Adresse mail:
											<span class="text-danger">(*)</span>
										</label>
										<input type="email" class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : '' ?>" name="email" value="<?php if (isset($data["email"]) && !empty($data["email"])) {
																																										echo $data["email"];
																																									} else {
																																										echo '';
																																									} ?>" id="email" placeholder="Veuillez entrer votre adresse email">
										<?php
										if (isset($_SESSION['errors']['email'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['errors']['email'] ?>
											</div>
										<?php
										}
										?>
									</div>

									<div class="row mt-3 mb-3">
										<div class="col-6 w-100">
											<a href="login">Connexion</a>
										</div>

									</div>

									<div class="col-6">
										<button class="btn btn-danger w-100" type="reset">Annuler</button>
									</div>

									<div class="col-6">
										<button class="btn btn-primary w-100" type="submit">Envoyer</button>
									</div>

								</form>

							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

	</div>
</main>
<!-- End #main -->
<?php
unset($_SESSION['errors'], $_SESSION['mot_passe_message_erreur_global'], $_SESSION['mot_passe_message_success_global']);
?>