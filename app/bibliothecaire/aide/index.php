<?php
if (empty($_SESSION["utilisateur_connecter_bibliothecaire"])) {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion');
} 
$title = 'Aide';

include './app/commun/header.php';
	?>

	<main id="main" class="main">
		<p class="text-center p-5">
			This page is only available in the pro version! <a
				href="https://bootstrapmade.com/demo/templates/NiceAdmin/pages-faq.html" target="_blank">Preview the
				page online</a> | <a href="https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/#download"
									 target="_blank">Buy the pro version</a>
		</p>
	</main><!-- End #main -->
	<?php
	include 'app/commun/footer.php';

?>  