<?php
$user_connected = check_if_user_connected();

if (!$user_connected) {
	header("location:' . PROJECT_DIR .'membre/connexion");
}
include("haut.php");
?>

<main id="main">
	<p class="text-center p-5">
		This page is only available in the pro version! <a
			href="https://bootstrapmade.com/demo/templates/NiceAdmin/pages-faq.html" target="_blank">Preview the page
			online</a> | <a href="https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/#download"
							target="_blank">Buy the pro version</a>
	</p>
</main><!-- End #main -->
<?php
include("bas.php");
?>  