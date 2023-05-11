<?php
include '../soutenance/app/commun/fonction/fonction.php';
if(check_if_user_conneted()){
include("haut.php");
?>

  <section class="section dashboard">
   <main id="main" class="main">
      <div class="row">

             <div class="col-md-6">
                <h1>Ajouter une langue</h1>
             </div>

              <div class="col-md-6 text-end bibliotheque-list-add-btn">
                <a href="liste_des_langues" class="btn btn-primary">Liste des langues</a>
              </div>

      </div>

            <div class="row mt-5 ">

              <div class="col-md-12 col-lg-8 offset-lg-2 bd-example">

                <form action="">

                      <div class="mb-3 row">
                        <label for="code-langue" class="col-sm-2 col-form-label">Code:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="code-langue" name="code-langue"
                                placeholder="Veuillez entrer le code de la langue">
                        </div>
                    </div>

                      <div class="mb-3 row">
                        <label for="libellé-langue" class="col-sm-2 col-form-label">Libellé:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="libellé-langue" name="libellé-langue"
                                placeholder="Veuillez entrer le libellé de la libellé">
                        </div>            
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-9 text-end mt-3">
                      <button class="btn btn-success"> Ajouter </button>
                    </div>
                </div>
                </form>

            </div>

      </div>
        
    </main>    
</section>

<?php
include("bas.php");
}else{
  header('location: /soutenance/bibliothecaire/connexion/index');
}
?>
 