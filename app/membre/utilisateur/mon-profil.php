<?php
include("haut.php");
if(isset($_SESSION['utilisateur_connecter']['0']['id']) && !empty($_SESSION['utilisateur_connecter']['0']['id'])){

}

if(isset($_SESSION['desactivation-errors']) && !empty($_SESSION['desactivation-errors'])){
  $errors = $_SESSION['desactivation-errors'];
}

if(isset($_SESSION['passe']) && !empty($_SESSION['passe'])){
  $errors = $_SESSION['passe'];
}
$user_connected = check_if_user_conneted();


if (!$user_connected) {
    header('location:' . PROJECT_DIR . 'membre/connexion');
   }
?>

<main id="main">

    <div class="pagetitle">
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="acceuil">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
           
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
  
                <img src="<?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['avatar'] : 'avatar' ?>" style="width: 170px;" alt="Profile" class="rounded-circle">
                <h2><?= $_SESSION["utilisateur_connecter"][0]['nom']?> <?= $_SESSION["utilisateur_connecter"][0]['prenom']?></h2>
                <h3><?= $_SESSION["utilisateur_connecter"][0]['profil']?></h3>
              </div>
          </div>
            <div class="card">
              
               
              <div class="pt-2 d-flex flex-column align-items-center pb-4">
                <h3 class="card-title">Paramètres de compte</h3>
                 <!----message de succès global à la connexion----->
                 <?php
                                    if (isset($_SESSION['desactivation-errors']) && !empty($_SESSION['desactivation-errors'])) {
                                    ?>
                                        <div class="alert alert-danger" style="color: white; background-color:#dc3545; border-radius: 15px; text-align:center;">
                                            <?= $_SESSION['desactivation-errors'] ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                  <!-- Settings Form -->
                    <div class="row mb-3" style="display: contents; text-align:center;">
                    
                      <div class="col-md-8 col-lg-9">
                        <form action="<?= PROJECT_DIR;?>membre/utilisateur/desactivation" method="post">
                          <div class="row mb-3" >
                            <div class="col-md-8 col-lg-12">
                              <button type="button" name="desactiver-compte" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#desactiver"> <i class="bi bi-x-octagon-fill"> Désactiver le compte</i></button>

                              <div class="text-center" style="color: #070b3a;">
                                <!-- Modal -->
                                <div class="modal fade" id="desactiver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mot de passe</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row mb-3">
                                          <label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;"> 
                                            Veuiller entrer votre mot de passe pour appliquer l'action.</label>
                                          <br>
                                          <div class="col-md-8 col-lg-12">
                                            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" name="desactivation" class="btn btn-danger">Valider</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        
                        
                        
                        <form action="<?= PROJECT_DIR;?>membre/utilisateur/supprimer" method="post">
                          <div class="row mb-3" >
                            <div class="col-md-6 col-lg-12">
                              <button type="button" name="supprimer-compte" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer"> <i class="bi bi-trash-fill"> Supprimer le compte</i></button>

                              <div class="text-center" style="color: #070b3a;">
                                <!-- Modal -->
                                <div class="modal fade" id="supprimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mot de passe</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row mb-3">
                                          <label for="mot_de_passe" class="col-12 col-form-label" style="color: #070b3a;"> 
                                            Veuiller entrer votre mot de passe pour appliquer l'action.</label>
                                          <br>
                                          <div class="col-md-8 col-lg-12">
                                            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" name="supprimer" class="btn btn-danger">Valider</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        
                      </div>
                    </div>                  
                  <!-- End settings Form -->

                </div>

              </div>
            </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body">
   
              <div class="tab-content">

                <div class="profile-overview" >
              
                  <h3 class="card-title">Informations du profil</h3>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom & Prénoms </div>
                    <div class="col-lg-9 col-md-8"> <?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['nom'] : 'Nom' ?> <?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['prenom'] : 'Prenom' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Sexe</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['sexe'] : 'sexe' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nom d'utilisateur</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['nom_utilisateur'] : 'nom_utilisateur' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de naissance</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['date_naissance'] : 'date_naissance' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['adresse'] : 'adresse' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['telephone'] : 'telephone' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= isset($_SESSION['utilisateur_connecter']) ?  $_SESSION['utilisateur_connecter'][0]['email'] : 'email' ?></div>
                  </div>

                </div>                

              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
          
              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="profile-edit pt-3">
                      <h3 class="card-title">Modifications des informations personnelles</h3>
                      <!-- Message d'erreur global quand la modification a échoué -->
                      <?php
                                    if (isset($_SESSION['passe']) && !empty($_SESSION['passe'])) {
                                    ?>
                                        <div class="alert alert-danger" style="color: white; background-color: #dc3545; border-radius: 15px; padding: 2%; text-align:center;">
                                            <?= $_SESSION['passe'] ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                       <!-- Message de succès global quand la modification a réussi -->
                       <?php
                                    if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                                    ?>
                                        <div class="alert alert-danger" style="color: white; background-color:#2bc717 ; border-radius: 15px; padding: 2%; text-align:center;">
                                            <?= $_SESSION['success'] ?>
                                        </div>
                                    <?php
                                    }
                                    ?>

                      <!-- Profile Edit Form -->
                      
                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profil Image</label>
                          <div class="col-md-8 col-lg-9">
                            <img src="<?= PROJECT_DIR; ?>public/image/bliotheque.jpg" alt="Profile">
                            <div class="pt-2">
                              <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                              <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                            </div>                        
                          </div>
                        </div>
                      <form action="<?= PROJECT_DIR ?>membre/utilisateur/modifier_profil" method="post">
                        <div class="row mb-3">
                          <label for="nom" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="nom" type="text" class="form-control" id="fullName"  value="<?= $_SESSION["utilisateur_connecter"][0]['nom']?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="prenom" class="col-md-4 col-lg-3 col-form-label">Prénoms</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="prenom" type="text" class="form-control" id="fullname"  value="<?= $_SESSION["utilisateur_connecter"][0]['prenom']?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="adresse" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="adresse" type="text" class="form-control" id="adresse" placeholder="Veuillez ajouter votre adresse" value="<?= $_SESSION["utilisateur_connecter"][0]['adresse']?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="nom_utilisateur" class="col-md-4 col-lg-3 col-form-label">Nom d'utilisateur</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="nom_utilisateur" type="text" class="form-control" id="nom_utilisateur"   value="<?= $_SESSION["utilisateur_connecter"][0]['nom_utilisateur']?> ">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="telephone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="telephone" type="text" class="form-control" id="telephone" placeholder="Veuillez renseigner votre numéro de téléphone" value="<?= $_SESSION["utilisateur_connecter"][0]['telephone']?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="traitement_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Mot de passe</label>
                          <div class="col-md-8 col-lg-9">
                            <input type="password"  class="form-control <?= isset($_SESSION['errors']['mot_de_passe']) ?  : ''?>" name="mot_de_passe" value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"]))?>"
                                      id="mot_de_passe" placeholder=" Veuillez entrer un mot de passe">
                                      <?php
                                      if(isset($_SESSION['errors']['mot_de_passe'])){ 
                                      ?>
                                      <div class="invalid-feedback">
                                          <?=$_SESSION['errors']['mot_de_passe']?>
                                      </div>
                                      <?php
                                      }
                                      ?>
                          </div>
                        </div>


                        <div class="text-center">
                          <button type="submit" name="sauvegarder" class="btn btn-primary w-100">Enregistrer</button>
                        </div>
                      </form>
                      <!-- End Profile Edit Form -->

                    </div>
                  </div>
                </div>
              </div>



              
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <div class="profile-change-password">
                      <!-- Change Password Form -->
                      <h3 class="card-title">Changer votre mot de passe</h3>
                      <form action="<?= PROJECT_DIR; ?>membre/utilisateur/changer_mot_de_passe" method="post">

                        <div class="row mb-3">
                          <label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="mot_de_passe" type="password" class="form-control" placeholder="Entrer votre mot de passe actuel" id="mot_de_passe">
                            <span class="text-danger">
                          <?php
                          if (isset($errors["mot_de_passe"]) && !empty($errors["mot_de_passe"])) {
                            echo $errors["mot_de_passe"];
                          }
                          ?>
                        </span>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="nouveau_mot_de_passe" type="password" class="form-control" placeholder="Entrer le nouveau mot de passe avec au moins 08 caractères" id="nouveau_mot_de_passe">
                            <span class="text-danger">
                          <?php
                          if (isset($errors["nouveau_mot_de_passe"]) && !empty($errors["nouveau_mot_de_passe"])) {
                            echo $errors["nouveau_mot_de_passe"];
                          }
                          ?>
                        </span>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="changer_mot_de_passe" class="col-md-4 col-lg-3 col-form-label">Confirmer mot de passe</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="confirmer_mot_de_passe" type="password" class="form-control" placeholder="Entrer à nouveau le nouveau mot de passe" id="confirmer_mot_de_passe">
                            <span class="text-danger">
                          <?php
                          if (isset($errors["confirmer_mot_de_passe"]) && !empty($errors["confirmer_mot_de_passe"])) {
                            echo $errors["confirmer_mot_de_passe"];
                          }
                          ?>
                        </span>
                          </div>
                        </div>

                        <div class="text-end">
                          <button type="submit" class="btn btn-primary w-50">Changement</button>
                        </div>
                      </form>
                      <!-- End Change Password Form -->

                  </div>
                </div>            
            </div>
          </div>
          

        </div>
      </div>
    </section>

  </main>
    <!-- End #main -->
        
<?php
unset($_SESSION['desactivation-errors'], $_SESSION['passe'], $_SESSION['success']);
  include('bas.php');
?>

 