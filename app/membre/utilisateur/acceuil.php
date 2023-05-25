<?php
if (!check_if_user_connected()) {
	header("location:" . PROJECT_DIR ."membre/connexion");
}
include("haut.php");
?>

<section class="section">
	<main id="main">
		<div class="row">

		</div>
	</main>

</section>

<?php
include("bas.php");
?>
