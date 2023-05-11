<?php 
  session_start();
  $data= [];
  if (isset($_SESSION['data']) && !empty($_SESSION['data'])) {
    $data = $_SESSION['data'];
}
  include './app/commun/index.php';
  include 'app/commun/fonction/fonction.php';
if(check_if_user_conneted()){
  
  header('location:' . PROJECT_DIR .'membre/utilisateur/acceuil');
}
?>


<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                <img src="../public/image/bliotheque.jpg" alt="bliotheque.jpg">
                  <span class="d-none d-lg-block">Bibliothèque AKAII</span>
                </a>
              </div><!-- End Logo -->
              
              <div class="card mb-3">

                <div class="card-body">   

                  <div class="pt-4 pb-2">
                    <h2 class="card-title text-center pb-0 fs-4">Créer un compte</h2>
                    <h3 class="text-center small">Entrer vos informations personnelles pour créer un compte</h3>
                  </div>

                  <form action="<?= PROJECT_DIR;?>membre/inscription/inscription_traitement" method="post" novalidate class="row g-3 needs-validation" novalidate>
                    <div class="col-12 mb-3">
                      <label for="incription_nom" class="form-label">Nom
                        <span class="text-danger"> (*)</span>
                      </label>
                      <input type="text"  class="form-control <?= isset($_SESSION['errors']['nom']) ? 'is-invalid' : ''?>" name="nom" id="nom"   value="<?php if (isset($data["nom"]) && !empty($data["nom"])) {echo $data["nom"]; }else{ echo '';}?>"
                                    placeholder="Veuillez entrer votre nom">
                                    <?php
                                    if(isset($_SESSION['errors']['nom'])){ 
                                    ?>
                                    <div class="invalid-feedback">
                                        <?=$_SESSION['errors']['nom']?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                    </div>

                    <div class="col-12 mt-3">
                      <label for="incription_prenom" class="form-label">Prénoms
                        <span class="text-danger"> (*)</span>
                      </label>
                      <input type="text"  class="form-control <?= isset($_SESSION['errors']['prenom']) ? 'is-invalid' : ''?>" name="prenom" id="prenom" value="<?php if (isset($data["prenom"]) && !empty($data["prenom"])) {echo $data["prenom"]; }else{ echo '';}?>" 
                                    placeholder="Veuillez entrer vos prénoms">
                                    <?php
                                    if(isset($_SESSION['errors']['prenom'])){ 
                                    ?>
                                    <div class="invalid-feedback">
                                        <?=$_SESSION['errors']['prenom']?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                      <!------<div class="invalid-feedback">Entrer vos prénoms s'il vous plaît!</div>---->
                    </div>

                    <div class="col-12 mt-3">
                      <label for="yourEmail" class="form-label"> Email
                        <span class="text-danger"> (*)</span>
                      </label>
                      <input type="email"  class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : ''?>" name="email" value="<?php if (isset($data["email"]) && !empty($data["email"])) {echo $data["email"]; }else{ echo '';}?>"
                                    id="email" placeholder="Veuillez entrer votre adresse email">
                                    <?php
                                    if(isset($_SESSION['errors']['email'])){ 
                                    ?>
                                    <div class="invalid-feedback">
                                        <?=$_SESSION['errors']['email']?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                      <!---<div class="invalid-feedback">Enter une adresse e-mail valide s'il vous plaît!</div>---->

                    </div>

                    <div class=" col-12 mt-3">
                      <label for="inscription-date-naissance"> Date de naissance:
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="date" name="date_naissance" id="inscription_date_naissance" class="form-control"  value="<?php if (isset($data["date_naissance"]) && !empty($data["date_naissance"])) {echo $data["date_naissance"]; }else{ echo '';}?>">
                                   
                                    <span class="text-danger">
                                        <?php
                                        if (isset($_SESSION['errors']["date_naissance"]) && !empty($_SESSION['errors']["date_naissance"])) {
                                            echo $_SESSION['errors']["date_naissance"];
                                        }
                                        ?>
                                    </span>
                    </div>          

                        
                        <div class="col-sm-12 mt-3">
                          <label for="sexe" class="form-label">Sexe
                            <span class="text-danger"> (*)</span>
                          </label>                        
                              <select id="sexe" name="sexe" class="form-control" value="<?php if (isset($data["sexe"]) && !empty($data["sexe"])) {echo $data["sexe"]; }else{ echo '';}?>">
                                  <option value="">Veuillez sectionner votre sexe</option>
                                  <option value="M">Masculin</option>
                                  <option value="F">Féminin</option>  
                                  <option value="A">Autres</option>                             
                              </select>  
                              <span class="text-danger">
                                        <?php
                                        if (isset($_SESSION['errors']["sexe"]) && !empty($_SESSION['errors']["sexe"])) {
                                            echo $_SESSION['errors']["sexe"];
                                        }
                                        ?>
                                    </span>                  
                      </div>
                                                                   
                      <div class="col-12 mt-3">
                        <label for="incription_nom_utilisateur" class="form-label">Nom d'utilisateur
                          <span class="text-danger">(*)</span>
                        </label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text"  class="form-control <?= isset($_SESSION['errors']['nom_utilisateur']) ? 'is-invalid' : ''?>" name="nom_utilisateur" id="nom_utilisateur" value="<?php if (isset($data["nom_utilisateur"]) && !empty($data["nom_utilisateur"])) {echo $data["nom_utilisateur"]; }else{ echo '';}?>"
                                      placeholder="Veuillez entrer un nom d'utilisateur">
                                      <?php
                                      if(isset($_SESSION['errors']['nom_utilisateur'])){ 
                                      ?>
                                      <div class="invalid-feedback">
                                          <?=$_SESSION['errors']['nom_utilisateur']?>
                                      </div>
                                      <?php
                                      }
                                      ?>
                          <!---<div class="invalid-feedback">Choisir un nom d'utilisateur.</div>---->
                        </div>
                        
                      </div>

                      <div class="col-12 mt-3">
                        <label for="incription_mot_de_passe" class="form-label">Mot de passe
                          <span class="text-danger"> (*)</span>
                        </label>
                        <input type="password"  class="form-control <?= isset($_SESSION['errors']['mot_de_passe']) ? 'is-invalid' : ''?>" name="mot_de_passe" value="<?php if (isset($data["mot_de_passe"]) && !empty($data["mot_de_passe"])) {echo $data["mot_de_passe"]; }else{ echo '';}?>"
                                      id="mot_de_passe" placeholder=" Veuillez entrer un mot de passe. Au moins huit (08) caractères">
                                      <?php
                                      if(isset($_SESSION['errors']['mot_de_passe'])){ 
                                      ?>
                                      <div class="invalid-feedback">
                                          <?=$_SESSION['errors']['mot_de_passe']?>
                                      </div>
                                      <?php
                                      }
                                      ?>
                        <!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->
                      
                      </div>

                      <div class="col-12 mt-3">
                        <label for="incription_confirmer_mot_de_passe" class="form-label">Confirmer mot de passe
                          <span class="text-danger"> (*)</span>
                        </label>
                        <input type="password"  class="form-control <?= isset($_SESSION['errors']['confirmer_mot_de_passe']) ? 'is-invalid' : ''?>" name="confirmer_mot_de_passe" value="<?php if (isset($data["confirmer_mot_de_passe"]) && !empty($data["confirmer_mot_de_passe"])) {echo $data["confirmer_mot_de_passe"]; }else{ echo '';}?>"
                                      id="confirmer_mot_de_passe" placeholder="Veuillez confirmer le mot de passe">
                                      <?php
                                      if(isset($_SESSION['errors']['confirmer_mot_de_passe'])){ 
                                      ?>
                                      <div class="invalid-feedback">
                                          <?=$_SESSION['errors']['confirmer_mot_de_passe']?>
                                      </div>
                                      <?php
                                      }
                                      ?>
                        <!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->
                        
                      </div>
                      <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox"  id="acceptTerms" >
                        <label class="form-check-label" for="acceptTerms">Je suis d'accord et j'accepte les <a href="#">termes et les conditions</a></label>
                        <div class="invalid-feedback">Vous devez accepter avant de soumettre.</div>
                        <span class="text-danger">
                        <?php
                                        if (isset($_SESSION['errors']["terms"]) && !empty($_SESSION['errors']["terms"])) {
                                            echo $_SESSION['errors']["terms"];
                                        }
                                        ?>
                                        </span>
                      </div>

                      <div class="col-12 mt-3">
                        <button class="btn btn-primary w-100" type="submit">Créer un compte</button>
                      </div>
                      <div class="col-12 mt-3">
                        <p class="small mb-0">Vous aviez déjà un compte? <a href="login">Se Connecter</a></p>
                      </div>
                      <?php
                          unset($_SESSION['errors']);
                      ?>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->