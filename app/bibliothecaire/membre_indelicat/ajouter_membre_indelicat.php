<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
} 
	include("header.php");
?>
	<section class="section dashboard">
		<main id="main" class="main">

		</main>
	</section>

<?php
	include("footer.php");
?>