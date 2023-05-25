<?php
include("haut.php");
$user_connected = check_if_user_conneted();

if (!$user_connected) {
    header("location:' . PROJECT_DIR .'membre/connexion");
  }
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
