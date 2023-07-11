<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Profil';
include './app/commun/header.php';
if (!empty($_SESSION['utilisateur_connecter_bibliothecaire']['0']['id']) && !empty($_SESSION['utilisateur_connecter_bibliothecaire']['0']['id'])) {
}

?>

<main id="main">

	<div class="pagetitle">
		<h1>Profil</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="../dashbord">Home</a></li>
				<li class="breadcrumb-item active">Profil</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section profile">
		<div class="row">
			<div class="col-xl-4">

				<div class="card">

					<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

						<img src="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] == 'Non defini' ? PROJECT_DIR . 'public/image/user.png' : $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] ?>" style="width: 90px;" alt="Profile" class="rounded-circle">
						<h2><?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?> <?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?></h2>
						<h3 class="mt-2"><?= $_SESSION['utilisateur_connecter_bibliothecaire']['profil'] ?></h3>
						<p class="mt-2"><?= $_SESSION['utilisateur_connecter_bibliothecaire']['email'] ?></p>
					</div>
				</div>
				<div class="card">


					<div class="pt-2 d-flex flex-column align-items-center pb-4">
						<h3 class="card-title">Paramètres de compte</h3>
						<!----message de succès global à la connexion----->
						<?php
						if (!empty($_SESSION['desactivation-errors']) && !empty($_SESSION['desactivation-errors'])) {
						?>
							<div class="alert alert-danger" style="color: white; background-color:#dc3545; border-radius: 15px; text-align:center;">
								<?= $_SESSION['desactivation-errors'] ?>
							</div>
						<?php
						}
						?>
						<!-- Settings Form -->
						<div class="row mb-3" style="display: contents; text-align:center;">

							<div class="col-md-8 col-lg-9">
								<form action="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/desactivation" method="post">
									<div class="row mb-3">
										<div class="col-md-8 col-lg-12">
											<button type="button" name="desactiver-compte" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#desactiver"><i class="bi bi-x-octagon-fill"> Désactiver le compte</i></button>

											<div class="text-center" style="color: #070b3a;">
												<!-- Modal -->
												<div class="modal fade" id="desactiver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">
																	Mot de passe
																</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																</button>
															</div>
															<div class="modal-body">
																<div class="row mb-3">
																	<label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;">
																		Veuiller entrer votre mot de passe pour
																		appliquer l'action.</label>
																	<br>
																	<div class="col-md-8 col-lg-12">
																		<input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
																</button>
																<button type="submit" name="desactivation" class="btn btn-danger">Valider
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>


								<form action="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/supprimer" method="post">
									<div class="row mb-3">
										<div class="col-md-6 col-lg-12">
											<button type="button" name="supprimer-compte" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer"><i class="bi bi-trash-fill"> Supprimer le compte</i></button>

											<div class="text-center" style="color: #070b3a;">
												<!-- Modal -->
												<div class="modal fade" id="supprimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Mot de
																	passe</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																</button>
															</div>
															<div class="modal-body">
																<div class="row mb-3">
																	<label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;">
																		Veuiller entrer votre mot de passe pour
																		appliquer l'action.</label>
																	<br>
																	<div class="col-md-8 col-lg-12">
																		<input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
																</button>
																<button type="submit" name="supprimer" class="btn btn-danger">Valider
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>

							</div>
						</div>
						<!-- End settings Form -->

					</div>

				</div>
			</div>

			<div class="col-xl-8">
				<div class="card">
					<div class="card-body">
						<div class="tab-content">
							<div class="profile-edit pt-3">
								<h3 class="card-title">Modifications des informations personnelles</h3>
								<!-- Message d'erreur global quand la modification a échoué -->
								<?php
								if (!empty($_SESSION['passe']) && !empty($_SESSION['passe'])) {
								?>
									<div class="alert alert-danger" style="color: white; background-color: #dc3545; border-radius: 15px; padding: 2%; text-align:center;">
										<?= $_SESSION['passe'] ?>
									</div>
								<?php
								}
								?>

								<!-- Message d'erreur global quand la modification de la photo a échoué -->
								<?php
								if (!empty($_SESSION['photo-erreurs']) && !empty($_SESSION['photo-erreurs'])) {
								?>
									<div class="alert alert-danger" style="color: white; background-color: #dc3545; border-radius: 15px; padding: 2%; text-align:center;">
										<?= $_SESSION['photo-erreurs'] ?>
									</div>
								<?php
								}
								?>

								<!-- Message de succès global quand la modification a réussi -->
								<?php
								if (!empty($_SESSION['success']) && !empty($_SESSION['success'])) {
								?>
									<div class="alert alert-danger" style="color: white; background-color:#2bc717 ; border-radius: 15px; padding: 2%; text-align:center;">
										<?= $_SESSION['success'] ?>
									</div>
								<?php
								}
								?>

								<!-- Message de succès global quand la modification de la photo a réussi -->
								<?php
								if (!empty($_SESSION['photo_success']) && !empty($_SESSION['photo_success'])) {
								?>
									<div class="alert alert-danger" style="color: white; background-color:#2bc717 ; border-radius: 15px; padding: 2%; text-align:center;">
										<?= $_SESSION['photo_success'] ?>
									</div>
								<?php
								}
								?>

								<!-- Profile Edit Form -->

								<div class="row mb-3">
									<label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profil
										Image</label>
									<div class="col-md-8 col-lg-9">
										<img src="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] == 'Non defini' ? PROJECT_DIR . 'public/image/user.png' : $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] ?>" style="width: 70px;" alt="Profile" class="rounded-circle">
										<div class="pt-2">
											<form action="<?= PROJECT_DIR ?>bibliothecaire/mon_profil/traitement_photo" method="post">
												<div class="row" style="text-align: center; display:flex;">
													<div class="col-sm-9 text-secondary">
														<label class="form-label" for="customFile" style="color: gray;">Changer ma photo de profil</label>
														<input type="file" class="form-control" id="image" name="image" />
													</div>

													<!-- maj_photo Form-->
													<div class="modal-footer text-center col-sm-3" style="justify-content: center; margin-top: 31px;">
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#avatar" style="font-size: revert; padding: 9px;">Mettre à jour</button>
														<div class="col-md-8 col-lg-12">
															<div class="text-center" style="color: #070b3a;">
																<!--Modal-->
																<div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Changer la photo de profil</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																				</button>
																			</div>
																			<div class="modal-body">
																				<div class="row mb-3">
																					<label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;">
																						Veuiller entrer votre mot de passe pour
																						appliquer l'action.</label>
																					<br>
																					<div class="col-md-8 col-lg-12">
																						<input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
																				</button>
																				<button type="submit" name="avatar" class="btn btn-danger">Valider
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</form>
											<!-- suppression_photo Form -->
											<form action="<?= PROJECT_DIR ?>bibliothecaire/profil/traitement_suppression_photo" method="post"  style="display: flex; justify-content: center; align-items: center;">
												<div class="row">
													<button type="reset" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#supprimer_photo"><i class="fa fa-trash"></i> Supprimer</button>
													<div class="col-md-8 col-lg-12">
														<div class="text-center" style="color: #070b3a;">
															<!-- Modal -->
															<div class="modal fade" id="supprimer_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Supprimer la photo de profil</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																				</button>
																			</div>
																			<div class="modal-body">
																				<div class="row mb-3">
																					<label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;">
																						Veuiller entrer votre mot de passe pour
																						appliquer l'action.</label>
																					<br>
																					<div class="col-md-8 col-lg-12">
																						<input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
																				</button>
																				<button type="submit" name="avatar" class="btn btn-danger">Valider
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
														</div>

													</div>
												</div>

											</form>
											<hr>
										</div>
									</div>
								</div>
								<form action="<?= PROJECT_DIR ?>bibliothecaire/mon_profil/modifier_profil" method="post">
									<div class="row mt-3">
										<label for="nom" class="col-md-4 col-lg-3 col-form-label">
											Nom
											<span class="text-danger"> (*)</span>
											:
										</label>
										<div class="col-md-8 col-lg-9">
											<input name="nom" type="text" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['nom']) ? 'is-invalid' : '' ?>" id="fullName" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?>">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['nom'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['nom'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="prenom" class="col-md-4 col-lg-3 col-form-label">
											Prénoms
											<span class="text-danger"> (*)</span>
											:
										</label>
										<div class="col-md-8 col-lg-9">
											<input name="prenom" type="text" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['prenom']) ? 'is-invalid' : '' ?>" id="fullname" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?>">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['prenom'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['prenom'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="adresse" class="col-md-4 col-lg-3 col-form-label">Adresse : </label>
										<div class="col-md-8 col-lg-9">
											<input name="adresse" type="text" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['adresse']) ? 'is-invalid' : '' ?>" id="adresse" placeholder="Veuillez ajouter votre adresse" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['adresse'] ?>">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['adresse'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['adresse'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="nom_utilisateur" class="col-md-4 col-lg-3 col-form-label">
											Nom d'utilisateur
											<span class="text-danger"> (*)</span>
											:
										</label>
										<div class="col-md-8 col-lg-9">
											<input name="nom_utilisateur" type="text" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['nom_utilisateur']) ? 'is-invalid' : '' ?>" id="nom_utilisateur" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom_utilisateur'] ?> ">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['nom_utilisateur'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['nom_utilisateur'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="telephone" class="col-md-4 col-lg-3 col-form-label">Téléphone :</label>
										<div class="col-md-8 col-lg-9">
											<input name="telephone" type="text" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['telephone']) ? 'is-invalid' : '' ?>" id="telephone" placeholder="Veuillez renseigner votre numéro de téléphone" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['telephone'] ?>">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['telephone'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['telephone'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="date_naissance" class="col-md-4 col-lg-3 col-form-label">
											Date de naissance :
										</label>
										<div class="col-md-8 col-lg-9">
											<input name="date_naissance" type="date" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['date_naissance']) ? 'is-invalid' : '' ?>" id="date_naissance" placeholder="Veuillez renseigner votre date de naissance" value="<?= $_SESSION['utilisateur_connecter_bibliothecaire']['date_naissance'] ?>">
											<?php if (!empty($_SESSION['modifier-profil-erreur']['date_naissance'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['date_naissance'] ?>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-3">
										<label for="sexe" class="col-md-4 col-lg-3 col-form-label">
											Sexe :
										</label>
										<div class="col-md-8 col-lg-9">
											<select class="sexe form-control" id="sexe" name="sexe">
												<option value="M">Masculin</option>
												<option value="F">Féminin</option>
											</select>
											<?php if (!empty($_SESSION['modifier-profil-erreur']['sexe'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['sexe'] ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="row mt-3">
										<label for="traitement_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">
											Mot de passe
											<span class="text-danger"> (*)</span>
											:
										</label>
										<div class="col-md-8 col-lg-9">
											<input type="password" class="form-control <?= isset($_SESSION['modifier-profil-erreur']['mot_de_passe']) ? 'is-invalid' : '' ?>" name="mot_de_passe" value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"])) ?>" id="mot_de_passe" placeholder=" Veuillez entrer un mot de passe">
											<?php
											if (!empty($_SESSION['modifier-profil-erreur']['mot_de_passe'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['mot_de_passe'] ?>
												</div>
											<?php } ?>
										</div>
									</div>


									<div class=" mt-3 text-center">
										<button type="submit" name="sauvegarder" class="btn btn-primary w-100">
											Enregistrer
										</button>
									</div>
								</form>
								<!-- End Profile Edit Form -->

							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="card">
				<div class="card-body">
					<div class="tab-content">
						<div class="profile-change-password">
							<!-- Change Password Form -->
							<h3 class="card-title">Changer votre mot de passe</h3>
							<!----message d'erreur global à la désactivation du compte----->
							<?php
							if (!empty($_SESSION['changement-erreurs']) && !empty($_SESSION['changement-erreurs'])) {
							?>
								<div class="alert alert-danger" style="color: white; background-color:#dc3545; border-radius: 15px; text-align:center;">
									<?= $_SESSION['changement-erreurs'] ?>
								</div>
							<?php
							}
							?>
							<form action="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/changer_mot_de_passe" method="post">

								<div class="row mb-3">
									<label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Mot
										de passe actuel</label>
									<div class="col-md-8 col-lg-9">
										<input type="password" class="form-control <?= isset($_SESSION['changement']['mot_de_passe']) ? 'is-invalid' : '' ?>" name="mot_de_passe" value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"])) ?>" id="changer_mot_de_passe" placeholder=" Veuillez entrer un mot de passe actuel">
										<?php
										if (!empty($_SESSION['changement']['mot_de_passe'])) { ?>
											<div class="invalid-feedback">
												<?= $_SESSION['changement']['mot_de_passe'] ?>
											</div>
										<?php } ?>

									</div>
								</div>

								<div class="row mb-3">
									<label for="nouveau_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Nouveau
										mot de passe</label>
									<div class="col-md-8 col-lg-9">
										<input type="password" class="form-control <?= isset($_SESSION['changement']['nouveau_mot_de_passe']) ? 'is-invalid' : '' ?>" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe" placeholder=" Veuillez entrer votre nouveau mot de passe">
										<?php
										if (!empty($_SESSION['changement']['nouveau_mot_de_passe'])) { ?>
											<div class="invalid-feedback">
												<?= $_SESSION['changement']['nouveau_mot_de_passe'] ?>
											</div>
										<?php } ?>
										</span>
									</div>
								</div>

								<div class="row mb-3">
									<label for="confirmer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Confirmer
										mot de passe</label>
									<div class="col-md-8 col-lg-9">
										<input type="password" class="form-control <?= isset($_SESSION['changement']['confirmer_mot_de_passe']) ? 'is-invalid' : '' ?>" name="confirmer_mot_de_passe" id="confirmer_mot_de_passe" placeholder=" Veuillez entrer à nouveau votre nouveau mot de passe">
										<?php
										if (!empty($_SESSION['changement']['confirmer_mot_de_passe'])) { ?>
											<div class="invalid-feedback">
												<?= $_SESSION['changement']['confirmer_mot_de_passe'] ?>
											</div>
										<?php } ?>
									</div>
								</div>

								<div class="text-end">
									<button type="submit" class="btn btn-primary w-50">Changement</button>
								</div>
							</form>
							<!-- End Change Password Form -->

						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

</main>
<!-- End #main -->

<?php
unset($_SESSION['desactivation-errors'], $_SESSION['passe'], $_SESSION['success'], $_SESSION['changement']);
include './app/commun/footer.php';
?>