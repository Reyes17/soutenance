<?php
if (empty($_SESSION["utilisateur_connecter_membre"])) {
	header('location:' . PROJECT_DIR . 'membre/connexion');
}

include("haut.php");
if (!empty($_SESSION['utilisateur_connecter_membre']['0']['id']) && !empty($_SESSION['utilisateur_connecter_membre']['0']['id'])) {
}

?>

<main id="main">

	<div class="pagetitle">
		<h1>Profil</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="acceuil">Home</a></li>
				<li class="breadcrumb-item active">Profil</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section profile">
		<div class="row">
			<div class="col-xl-4">

				<div class="card">

					<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

						<img src="<?= isset($_SESSION['utilisateur_connecter_membre']) ? $_SESSION['utilisateur_connecter_membre']['avatar'] : 'avatar' ?>" style="width: 170px;" alt="Profile" class="rounded-circle">
						<h2><?= $_SESSION['utilisateur_connecter_membre']['nom'] ?> <?= $_SESSION['utilisateur_connecter_membre']['prenom'] ?></h2>
						<h3 class="mt-2"><?= $_SESSION['utilisateur_connecter_membre']['profil'] ?></h3>
						<p class="mt-2"><?= $_SESSION['utilisateur_connecter_membre']['email'] ?></p>
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

								//die(var_dump($_SESSION));
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

								<!-- Profile Edit Form -->

								<div class="row mb-3">
									<label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profil
										Image</label>
									<div class="col-md-8 col-lg-9">
										<img src="<?= PROJECT_DIR; ?>public/image/bliotheque.jpg" alt="Profile">
										<div class="pt-2">
											<a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
											<a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
										</div>
									</div>
								</div>
								<form action="<?= PROJECT_DIR ?>bibliothecaire/mon_profil/modifier_profil" method="post">
									<div class="row mb-3">
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

									<div class="row mb-3">
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

									<div class="row mb-3">
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

									<div class="row mb-3">
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

									<div class="row mb-3">
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

									<div class="row mb-3">
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

									<div class="row mb-3">
										<label for="sexe" class="col-md-4 col-lg-3 col-form-label">
											Sexe :
										</label>
										<div class="col-md-8 col-lg-9">
											<select class="sexe form-control" id="sexe" name="sexe">
												<option value="1">Masculin</option>
												<option value="2">Féminin</option>
											</select>
											<?php if (!empty($_SESSION['modifier-profil-erreur']['sexe'])) { ?>
												<div class="invalid-feedback">
													<?= $_SESSION['modifier-profil-erreur']['sexe'] ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="row mb-3">
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


									<div class="text-center">
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


				<div class="card">
					<div class="card-body">
						<div class="tab-content">
							<div class="profile-change-password">
								<!-- Change Password Form -->
								<h3 class="card-title">Changer votre mot de passe</h3>
								<form action="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/changer_mot_de_passe" method="post">

									<div class="row mb-3">
										<label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Mot
											de passe actuel</label>
										<div class="col-md-8 col-lg-9">
											<input name="mot_de_passe" type="password" class="form-control" placeholder="Entrer votre mot de passe actuel" id="mot_de_passe">
											<span class="text-danger">
												<?php
												if (isset($errors["mot_de_passe"]) && !empty($errors["mot_de_passe"])) {
													echo $errors["mot_de_passe"];
												}
												?>
											</span>
										</div>
									</div>

									<div class="row mb-3">
										<label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Nouveau
											mot de passe</label>
										<div class="col-md-8 col-lg-9">
											<input name="nouveau_mot_de_passe" type="password" class="form-control" placeholder="Entrer le nouveau mot de passe avec au moins 08 caractères" id="nouveau_mot_de_passe">
											<span class="text-danger">
												<?php
												if (isset($errors["nouveau_mot_de_passe"]) && !empty($errors["nouveau_mot_de_passe"])) {
													echo $errors["nouveau_mot_de_passe"];
												}
												?>
											</span>
										</div>
									</div>

									<div class="row mb-3">
										<label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Confirmer
											mot de passe</label>
										<div class="col-md-8 col-lg-9">
											<input name="confirmer_mot_de_passe" type="password" class="form-control" placeholder="Entrer à nouveau le nouveau mot de passe" id="confirmer_mot_de_passe">
											<span class="text-danger">
												<?php
												if (isset($errors["confirmer_mot_de_passe"]) && !empty($errors["confirmer_mot_de_passe"])) {
													echo $errors["confirmer_mot_de_passe"];
												}
												?>
											</span>
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
		</div>
	</section>

</main>
<!-- End #main -->

<?php
unset($_SESSION['desactivation-errors'], $_SESSION['passe'], $_SESSION['success']);
include('bas.php');
?>