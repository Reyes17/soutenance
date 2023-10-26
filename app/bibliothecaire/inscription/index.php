<?php
if (isset($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/dossier/dashboard');
}

if (isset($_SESSION['donnees-utilisateur']) && !empty($_SESSION['donnees-utilisateur'])) {
	$data = $_SESSION['donnees-utilisateur'];
}

$title = 'Inscription';
include 'app/commun/index.php';

?>


<main>
	<div class="container">

		<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

						<div class="d-flex justify-content-center py-4">
							<a href="" class="logo d-flex align-items-center w-auto">
								<img src="../public/image/bliotheque.jpg" alt="bliotheque.jpg">
								<span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
							</a>
						</div><!-- End Logo -->

						<div class="card mb-3">

							<div class="card-body">
								<!----message de succès global à la connexion----->
								<?php
								if (isset($_SESSION['message_success_global']) && !empty($_SESSION['message_success_global'])) {
								?>
									<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
										<?= $_SESSION['message_success_global'] ?>
									</div>
								<?php
								}
								?>
								<!----message d'erreur global à la connexion----->
								<?php
								if (isset($_SESSION['message_errors_global']) && !empty($_SESSION['message_errors_global'])) {
								?>
									<div class="alert alert-success mt-3" style="border-radius: 15px; text-align: center;">
										<?= $_SESSION['message_errors_global'] ?>
									</div>
								<?php
								}

								?>
								<div class="pt-4 pb-2">
									<h2 class="card-title text-center pb-0 fs-4">Créer un compte</h2>
									<h3 class="text-center small">Entrer vos informations personnelles pour créer un
										compte</h3>
								</div>

								<form action="<?= PROJECT_DIR; ?>bibliothecaire/inscription/inscription_traitement" method="post" class="row g-3 needs-validation" novalidate>
									<div class="col-12">
										<label for="incription_nom" class="form-label">Nom
											<span class="text-danger"> (*)</span>
										</label>
										<input type="text" class="form-control <?= isset($_SESSION['inscription-erreurs']['nom']) ? 'is-invalid' : '' ?>" name="nom" id="incription_nom" value="<?= (isset($data["nom"]) && !empty($data["nom"])) ? $data['nom'] : ''; ?>" placeholder="Veuillez entrer votre nom">
										<?php
										if (isset($_SESSION['inscription-erreurs']['nom'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['inscription-erreurs']['nom'] ?>
											</div>
										<?php
										}
										?>
									</div>

									<div class="col-12 mt-3">
										<label for="incription_prenom" class="form-label">Prénoms
											<span class="text-danger"> (*)</span>
										</label>
										<input type="text" class="form-control <?= isset($_SESSION['inscription-erreurs']['prenom']) ? 'is-invalid' : '' ?>" name="prenom" id="incription_prenom" value="<?php if (isset($data["prenom"]) && !empty($data["prenom"])) {
																																																				echo $data["prenom"];
																																																			} else {
																																																				echo '';
																																																			} ?>" placeholder="Veuillez entrer vos prénoms">
										<?php
										if (isset($_SESSION['inscription-erreurs']['prenom'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['inscription-erreurs']['prenom'] ?>
											</div>
										<?php
										}
										?>
										<!------<div class="invalid-feedback">Entrer vos prénoms s'il vous plaît!</div>---->
									</div>

									<div class="col-12 mt-3">
										<label for="yourEmail" class="form-label"> Email
											<span class="text-danger"> (*)</span>
										</label>
										<input type="email" class="form-control <?= isset($_SESSION['inscription-erreurs']['email']) ? 'is-invalid' : '' ?>" name="email" value="<?php if (isset($data["email"]) && !empty($data["email"])) {
																																														echo $data["email"];
																																													} else {
																																														echo '';
																																													} ?>" id="yourEmail" placeholder="Veuillez entrer votre adresse email">
										<?php
										if (isset($_SESSION['inscription-erreurs']['email'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['inscription-erreurs']['email'] ?>
											</div>
										<?php
										}
										?>
										<!---<div class="invalid-feedback">Enter une adresse e-mail valide s'il vous plaît!</div>---->

									</div>


									<div class="col-12 mt-3">
										<label for="incription_nom_utilisateur" class="form-label">Nom d'utilisateur
											<span class="text-danger">(*)</span>
										</label>
										<div class="input-group has-validation">
											<input type="text" class="form-control <?= isset($_SESSION['inscription-erreurs']['nom_utilisateur']) ? 'is-invalid' : '' ?>" name="nom_utilisateur" id="incription_nom_utilisateur" value="<?php if (isset($data["nom_utilisateur"]) && !empty($data["nom_utilisateur"])) {
																																																											echo $data["nom_utilisateur"];
																																																										} else {
																																																											echo '';
																																																										} ?>" placeholder="Veuillez entrer un nom d'utilisateur">
											<?php
											if (isset($_SESSION['inscription-erreurs']['nom_utilisateur'])) {
											?>
												<div class="invalid-feedback">
													<?= $_SESSION['inscription-erreurs']['nom_utilisateur'] ?>
												</div>
											<?php
											}
											?>
											<!---<div class="invalid-feedback">Choisir un nom d'utilisateur.</div>---->
										</div>

									</div>

									<div class="col-12 mt-3">
										<label for="incription_mot_de_passe" class="form-label">Mot de passe
											<span class="text-danger"> (*)</span>
										</label>
										<input type="password" class="form-control <?= isset($_SESSION['inscription-erreurs']['mot_de_passe']) ? 'is-invalid' : '' ?>" name="mot_de_passe" value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"])) {
																																																		echo $data["mot_de_passe"];
																																																	} else {
																																																		echo '';
																																																	} ?>" id="incription_mot_de_passe" placeholder="Mot de passe à 08 caractères au moins">
										<?php
										if (isset($_SESSION['inscription-erreurs']['mot_de_passe'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['inscription-erreurs']['mot_de_passe'] ?>
											</div>
										<?php
										}
										?>
										<!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->

									</div>

									<div class="col-12 mt-3">
										<label for="incription_confirmer_mot_de_passe" class="form-label">Confirmer mot
											de passe
											<span class="text-danger"> (*)</span>
										</label>
										<input type="password" class="form-control <?= isset($_SESSION['inscription-erreurs']['confirmer_mot_de_passe']) ? 'is-invalid' : '' ?>" name="confirmer_mot_de_passe" value="<?php if (isset($data["confirmer_mot_de_passe"]) && !empty($data["confirmer_mot_de_passe"])) {
																																																							echo $data["confirmer_mot_de_passe"];
																																																						} else {
																																																							echo '';
																																																						} ?>" id="incription_confirmer_mot_de_passe" placeholder="Veuillez confirmer le mot de passe">
										<?php
										if (isset($_SESSION['inscription-erreurs']['confirmer_mot_de_passe'])) {
										?>
											<div class="invalid-feedback">
												<?= $_SESSION['inscription-erreurs']['confirmer_mot_de_passe'] ?>
											</div>
										<?php
										}
										?>
										<!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->

									</div>
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" name="terms" type="checkbox" id="acceptTerms">
											<label class="form-check-label" for="acceptTerms">Je suis d'accord et
												j'accepte les <a href="#">termes et les conditions</a></label>
											<div class="invalid-feedback">Vous devez accepter avant de soumettre.</div>
											<span class="text-danger">
												<?php
												if (isset($_SESSION['inscription-erreurs']["terms"]) && !empty($_SESSION['inscription-erreurs']["terms"])) {
													echo $_SESSION['inscription-erreurs']["terms"];
												}
												?>
											</span>
										</div>

										<div class="col-12 mt-3">
											<button class="btn btn-primary w-100" type="submit">Créer un compte</button>
										</div>
										<div class="col-12 mt-3">
											<p class="small mb-0">Vous aviez déjà un compte? <a href="login">Se
													Connecter</a></p>
										</div>
										<?php
										session_destroy();
										?>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

	</div>
</main><!-- End #main -->