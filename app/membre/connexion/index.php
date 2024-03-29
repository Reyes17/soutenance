<?php
$title = 'Connexion';
include 'app/commun/header_membre.php';
if (isset($_SESSION["utilisateur_connecter_membre"])) {
	header('location:' . PROJECT_DIR . 'membre/accueil/index');
}
$compteSupprime = isset($_GET['compte_supprime']) ? $_GET['compte_supprime'] : null;

if ($compteSupprime == 1) {
	echo '<div class="alert alert-warning">Votre compte a été supprimé par le bibliothécaire.</div>';
}
// Vérifier si le cookie existe
if (isset($_COOKIE['compte_supprime_message'])) {
	// Afficher le message d'alerte
	echo '<div class="alert alert-danger mt-3" style="color: white; background-color: #dc3545; border: 5px; text-align: center;">' . $_COOKIE['compte_supprime_message'] . '</div>';
	// Supprimer le cookie
	setcookie("compte_supprime_message", "", time() - 3600, "/");
}

if (isset($_COOKIE['utilisateur_connecter_membre']) and !empty($_COOKIE['utilisateur_connecter_membre'])) {
	$users_utilisateur = json_decode($_COOKIE['utilisateur_connecter_membre']);
}
?>
<main id="main" style="margin-left: 0px; padding: 3px;">
	<div class="container">
		<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

						<!-- End Logo -->

						<div class="card mb-3">

							<div class="card-body">

								<div class="pt-4 pb-2">

									<!----message d'erreur global après envoie d'un mauvais mot de passe ou non utilisiateur à la connexion----->
									<?php
									if (isset($_SESSION['danger']) && !empty($_SESSION['danger'])) {
									?>
										<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
											<?= $_SESSION['danger'] ?>
										</div>
									<?php
									}
									?>

									<!----message de succès global après validation de mail----->
									<?php
									if (isset($_SESSION['validation-compte-message-success']) && !empty($_SESSION['validation-compte-message-success'])) {
									?>
										<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
											<?= $_SESSION['validation-compte-message-success'] ?>
										</div>
									<?php
									}
									?>

									<!----message de succès global après changement de mot de passe----->
									<?php
									if (isset($_SESSION['changement-success']) && !empty($_SESSION['changement-success'])) {
									?>
										<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
											<?= $_SESSION['changement-success'] ?>
										</div>
									<?php
									}
									?>

									<!----message d'erreur global après validation de mail----->
									<?php
									if (isset($_SESSION['validation-compte-message-erreur']) && !empty($_SESSION['validation-compte-message-erreur'])) {
									?>
										<div class="alert alert-danger mt-3" style="border-radius: 15px; text-align: center;">
											<?= $_SESSION['validation-compte-message-erreur'] ?>
										</div>
									<?php
									}
									?>

									<h5 class="card-title text-center pb-0 fs-4">
										Connectez-vous à votre compte
									</h5>
									<p class="text-center small">
										Entrez votre nom d'utilisateur et votre mot de passe pour vous connecter
									</p>
								</div>

								<form class="row g-3 needs-validation" action="<?= PROJECT_DIR; ?>membre/connexion/traitement" method="post">

									<div class="col-12 mt-3">
										<label for="connexion_nom_utilisateur" class="form-label">
											Nom d'utilisateur
											<span class="text-danger"> (*)</span>
											:
										</label>
										<div class="input-group has-validation">
											<input type="text" id="connexion_nom_utilisateur" class="form-control <?= isset($_SESSION['errors']['nom_utilisateur']) ? 'is-invalid' : '' ?>" name="nom_utilisateur" placeholder="Veuillez entrer un nom d'utilisateur" value="<?php if (isset($data["nom_utilisateur"]) && !empty($data["nom_utilisateur"])) {
																																																																					echo $data["nom_utilisateur"];
																																																																				} else {
																																																																					echo '';
																																																																				} ?>" placeholder="Veuillez entrer un nom d'utilisateur">

											<?php if (isset($_SESSION['errors']['nom_utilisateur']) && !empty($_SESSION['errors']['nom_utilisateur'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['errors']['nom_utilisateur'] ?>
												</div>
											<?php } ?>
										</div>

									</div>

									<div class="col-12 mt-3">
										<label for="connexion_mot_de_passe" class="form-label">
											Mot de passe
											<span class="text-danger"> (*)</span>
											:
										</label>
										<input type="password" id="connexion_mot_de_passe" class="form-control <?= isset($_SESSION['errors']['mot_de_passe']) ? 'is-invalid' : '' ?>" name="mot_de_passe" placeholder=" Veuillez entrer un mot de passe" value="">
										<?php if (isset($_SESSION['errors']['mot_de_passe']) && !empty($_SESSION['errors']['mot_de_passe'])) { ?>
											<div class="invalid-feedback">
												<?= $_SESSION['errors']['mot_de_passe'] ?>
											</div>
										<?php } ?>
									</div>
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="rappeler" value="true" id="se-rappeler">
											<label class="form-check-label" for="se-rappeler">Se souvenir de moi</label>
										</div>
									</div>
									<div class="col-12">
										<button class="btn btn-primary w-100" type="submit">Connexion</button>
									</div>
									<div class="col-md-6">
										<p>
											<a href="<?= PROJECT_DIR; ?>membre/inscription">Créer un compte</a>
										</p>
									</div>
									<div class="col-md-6">
										<p>
											<a href="<?= PROJECT_DIR; ?>membre/mot_de_passe_oublie">
												Mot de passe oublié
											</a>
										</p>
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
<?php
unset($_SESSION['danger'], $_SESSION['validation-compte-message-success'], $_SESSION['validation-compte-message-erreur'],  $_SESSION['errors'], $_SESSION['changement-success']);
include 'app/commun/footer_membre.php';
?>