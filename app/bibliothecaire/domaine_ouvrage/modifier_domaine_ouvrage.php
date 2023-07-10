<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
} 
$title ='Modifier un domaine ouvrage';
include './app/commun/header.php';
?>

	<section class="section dashboard">
		<main id="main" class="main">

		</main>
	</section>

<?php
include './app/commun/footer.php';
?>