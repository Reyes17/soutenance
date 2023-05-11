<?php
include 'app/commun/fonction/fonction.php';
if(check_if_user_conneted()){
include("haut.php");
?>

<section class="section dashboard">
   <main id="main" class="main">
        
    </main>    
</section>

<?php
include("bas.php");
} else{
    header('location:' . PROJECT_DIR .'bibliothecaire/connexion/index');
  }
?>