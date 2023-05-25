<?php
include 'app/commun/fonction/fonction.php';
if (check_if_user_conneted()) {
	include("haut.php");
	?>
	<main>
		<div class="container">

			<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
				<h1>404</h1>
				<h2>The page you are looking for doesn't exist.</h2>
				<a class="btn" href="dashboard">Back to home</a>
			</section>

		</div>
	</main><!-- End #main -->


	<?php
	include("bas.php");
} else {
	header('location:' . PROJECT_DIR . 'bibliothecaire/connexion/index');
}
?>