<?php
include("haut.php");
include '../soutenance/app/commun/fonction/fonction.php';
$user_connected = check_if_user_conneted();

if (!$user_connected) {
    header("location: /soutenance/membre/connexion");
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
