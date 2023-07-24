<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
}
$title = 'Listes des membres';
//include './app/commun/header.php';
$liste_membres = get_liste_membres();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">


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
	<link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
	<!-- Template Main CSS File -->
	<link href="<?= PROJECT_DIR; ?>public/css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclure le fichier CSS de Toastify -->


<!-- Inclure le fichier JavaScript de Toastify -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


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
			<i class="bi bi-list toggle-sidebar-btn"></i>
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
						<img src="<?= isset($_SESSION['utilisateur_connecter_bibliothecaire']) ? $_SESSION['utilisateur_connecter_bibliothecaire']['avatar'] : 'avatar' ?>" style="width: 50px;" alt="Profile" class="rounded-circle">
						<span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?> <?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?></span>
					</a><!-- End Profile Iamge Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6><?= $_SESSION['utilisateur_connecter_bibliothecaire']['nom'] ?> <?= $_SESSION['utilisateur_connecter_bibliothecaire']['prenom'] ?></h6>
							<span><?= $_SESSION['utilisateur_connecter_bibliothecaire']['profil'] ?></span>

						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/mon-profil">
								<i class="bi bi-person"></i>
								<span>Mon Profil</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/mon-profil">
								<i class="bi bi-gear"></i>
								<span>Paramètres du compte</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/aide/index">
								<i class="bi bi-question-circle"></i>
								<span>Besoin d'aide?</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= PROJECT_DIR; ?>bibliothecaire/mon_profil/deconnexion">
								<i class="ri-logout-box-line"></i>
								<span>Se déconnecter</span>
							</a>
						</li>

					</ul><!-- End Profile Dropdown Items -->
				</li><!-- End Profile Nav -->

			</ul>
		</nav><!-- End Icons Navigation -->

	</header><!-- End Header -->

	<!-- ======= Sidebar ======= -->
	<aside id="sidebar" class="sidebar">

		<ul class="sidebar-nav" id="sidebar-nav">

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= PROJECT_DIR; ?>bibliothecaire/dashboard/index">
					<i class="bi bi-grid"></i>
					<span>Tableau de bord</span>
				</a>
			</li><!-- Fin menu dashboard -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#auteurs-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-app-store-line"></i><span>AUTEURS</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="auteurs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/liste_des_auteurs">
							<i class="bi bi-circle"></i><span>Liste des auteurs</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur/ajouter_auteurs">
							<i class="bi bi-circle"></i><span>Ajouter un auteur</span>
						</a>
					</li>

				</ul>
			</li>
			<!-- Fin menu auteur -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#ouvrages-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-book-fill"></i><span>OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/liste_des_ouvrages">
							<i class="bi bi-circle"></i><span>Liste des ouvrages</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/ouvrage/ajouter_ouvrage">
							<i class="bi bi-circle"></i><span>Ajouter un ouvrage </span>
						</a>
					</li>
				</ul>
			</li>
			<!-- Fin menu ouvrage -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#langues-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-pencil-fill"></i><span>LANGUES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="langues-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/liste_des_langues">
							<i class="bi bi-circle"></i><span>Liste des langues</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/langue/ajouter_langue">
							<i class="bi bi-circle"></i><span>Ajouter une langue</span>
						</a>
					</li>
				</ul>
			</li>
			<!-- Fin menu langue -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#emprunts-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-edge-line"></i><span>EMPRUNTS</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="emprunts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/liste_des_emprunts">
							<i class="bi bi-circle"></i><span>Liste des emprunts</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/emprunt/ajouter_emprunt">
							<i class="bi bi-circle"></i><span>Ajouter un emprunt</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu emprunt -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#membres-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-medium-line"></i><span>MEMBRES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="membres-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/membre/liste_des_membres">
							<i class="bi bi-circle"></i><span>Liste des membres</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/membre/ajouter_membre">
							<i class="bi bi-circle"></i><span>Ajouter un membre</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu membre -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#membres_indelicats-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-markdown-line"></i><span>MEMBRES INDELICATS</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="membres_indelicats-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/membre_indelicat/liste_des_membres_indelicats">
							<i class="bi bi-circle"></i><span>Liste des membres indélicats</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/membre_indelicat/ajouter_membre_indelicat">
							<i class="bi bi-circle"></i><span>Ajouter un membre indélicat</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu membre indélicat -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#domaines-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-earth-line"></i><span>DOMAINES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="domaines-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/liste_des_domaines">
							<i class="bi bi-circle"></i><span>Liste des domaines</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine/ajouter_domaine">
							<i class="bi bi-circle"></i><span>Ajouter un domaine</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin  menu domaine -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#domaines_ouvrages-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-book-open-line"></i><span>DOMAINES OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="domaines_ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine_ouvrage/liste_des_domaines_ouvrages">
							<i class="bi bi-circle"></i><span>Liste des domaines ouvrages</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/domaine_ouvrage/ajouter_domaine_ouvrage">
							<i class="bi bi-circle"></i><span>Ajouter un domaine ouvrage</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu domaine ouvrage -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#date_parution-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-calendar-event-line"></i><span>DATE PARUTION</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="date_parution-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/date_parution/liste_des_dates_parutions">
							<i class="bi bi-circle"></i><span>Liste des dates parutions</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/date_parution/ajouter_date_parution">
							<i class="bi bi-circle"></i><span>Ajouter une date parution</span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu date parution -->

			<li class="nav-item">
				<a class="nav-link collapsed" data-bs-target="#auteurs_secondaires-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-input-method-line"></i><span>AUTEURS SECONDAIRES</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="auteurs_secondaires-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/liste_des_auteurs_secondaires">
							<i class="bi bi-circle"></i><span>Liste des auteurs secondaire</span>
						</a>
					</li>
					<li>
						<a href="<?= PROJECT_DIR; ?>bibliothecaire/auteur_secondaire/ajouter_auteur_secondaire">
							<i class="bi bi-circle"></i><span>Ajouter un auteur secondaire </span>
						</a>
					</li>
				</ul>
			</li><!-- Fin menu date parution -->

			<li class="nav-heading">Pages</li>

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= PROJECT_DIR; ?>bibliothecaire/contact/index">
					<i class="bi bi-envelope"></i>
					<span>Contact</span>
				</a>
			</li><!-- End Contact Page Nav -->

	</aside><!-- End Sidebar-->
<section class="section dashboard">
	<main id="main" class="main">
		<div class="row">
		
			<div class="col-md-6">
				<h1>Liste des membres</h1>
			</div>

		</div>
		<div class="row mt-5">
			<?php if (!empty($liste_membres)) { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénoms</th>
							<th scope="col">Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($liste_membres as $membre) { ?>
							<tr>
								<td><?= $membre['nom'] ?></td>
								<td><?= $membre['prenom'] ?></td>
								<td>
									<a href="#" class="btn btn-primary mb-3 btn-details" data-bs-toggle="modal" data-bs-target="#modal-details-<?= $membre['id'] ?>" data-id="<?= $membre['id'] ?>" data-email="<?= $membre['email'] ?>" data-adresse="<?= $membre['adresse'] ?>" data-sexe="<?= $membre['sexe'] ?>" data-date_naissance="<?= $membre['date_naissance'] ?>" data-telephone="<?= $membre['telephone'] ?>">Détails</a>

									<a href="#" class="btn btn-danger mb-3 btn-supprimer" data-bs-toggle="modal" data-bs-target="#modal-supprimer" data-id="<?= $membre['id'] ?>">Supprimer</a>
								</td>
							</tr>
							<!-- Modal pour le boutton details-->
							<div class="modal fade" id="modal-details-<?= $membre['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Détails sur le membre</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<p><strong>Email :</strong> <?= $membre['email'] ?></p>
											<p><strong>Adresse :</strong> <?= $membre['adresse'] ?></p>
											<p><strong>Sexe :</strong> <?= $membre['sexe'] ?></p>
											<p><strong>Date de naissance :</strong> <?= $membre['date_naissance'] ?></p>
											<p><strong>Téléphone :</strong> <?= $membre['telephone'] ?></p>
											<!-- Ajoutez d'autres informations du membre ici -->
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal pour le bouton supprimer-->
							<!-- Modal pour le bouton "Supprimer" -->
							<div class="modal fade" id="modal-supprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Supprimer le membre</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Êtes-vous sûr de vouloir supprimer ce membre ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
											<button type="button" class="btn btn-danger" id="btn-confirmer-suppression">Oui</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			<?php } else {
				echo 'Aucun membre disponible pour le moment';
			} ?>
		</div>
	</main>
</section>


<script>
	$(document).ready(function() {
		$('.btn-details').on('click', function() {
			var idMembre = $(this).data('id');
			var modal = $('#modal-details-' + idMembre);

			// Ajoutez les autres informations du membre ici
			var emailMembre = $(this).data('email');
			var adresseMembre = $(this).data('adresse');
			var sexeMembre = $(this).data('sexe');
			var dateNaissanceMembre = $(this).data('date_naissance');
			var telephoneMembre = $(this).data('telephone');

			modal.find('#email-membre').text(emailMembre);
			modal.find('#adresse-membre').text(adresseMembre);
			modal.find('#sexe-membre').text(sexeMembre);
			modal.find('#date-naissance-membre').text(dateNaissanceMembre);
			modal.find('#telephone-membre').text(telephoneMembre);
		});
	});

	// ...
    $(document).ready(function() {
        $('.btn-supprimer').on('click', function() {
            var idMembre = $(this).data('id');

            // Quand on clique sur le bouton "Oui" dans le modal de suppression
            $('#btn-confirmer-suppression').on('click', function() {
                // Appeler la fonction pour supprimer le compte du membre via AJAX
                supprimerCompteMembre(idMembre);
            });
        });

        // Fonction pour supprimer le compte du membre via AJAX
        function supprimerCompteMembre(idMembre) {
            $.ajax({
                url: '<?= PROJECT_DIR; ?>bibliothecaire/membre/supprimer_membre_traitement',
                method: 'POST',
                data: {
                    id: idMembre
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Afficher le message de succès directement sur la page sans utiliser la session
                        alert('La suppression a été effectuée avec succès !');
                        // Rafraîchir la page pour mettre à jour la liste des membres
                        window.location.reload();
                    } else {
                        // Afficher le message d'erreur directement sur la page sans utiliser la session
                        alert(data.message);
                    }
                },
                error: function() {
                    // Afficher un message d'erreur en cas d'erreur du serveur
                    alert('Une erreur s\'est produite lors de la suppression. Veuillez réessayer.');
                }
            });
        }
    });
</script>
<!-- ... -->

// ...

</script>
<?php
include 'app/commun/footer.php';
?>