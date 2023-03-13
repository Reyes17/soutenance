<? 
  include ('./app/commun/index.php');
 ?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                <img src="public/image/bliotheque.jpg" alt="bliotheque.jpg">
                  <span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h2 class="card-title text-center pb-0 fs-4">Créer un compte</h2>
                    <h3 class="text-center small">Entrer vos informations personnelles pour créer un compte</h3>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Nom</label>
                      <input type="text" name="name" class="form-control" id="yourName" placeholder="Entrer votre nom s'il vous plaît!" required>

                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Prénoms</label>
                      <input type="text" name="name" class="form-control" id="yourName" placeholder="Veuillez saisir vos prénoms" required>
                      <!------<div class="invalid-feedback">Entrer vos prénoms s'il vous plaît!</div>---->
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Votre Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" placeholder="Veuillez enter votre adresse email!" required>
                      <!---<div class="invalid-feedback">Enter une adresse e-mail valide s'il vous plaît!</div>---->
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Nom d'utilisateur</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Entrer votre nom d'utilisateur!" required>
                        <!---<div class="invalid-feedback">Choisir un nom d'utilisateur.</div>---->
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Veuillez définir un mot de passe!" required>
                      <!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirmer mot de passe</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Veuillez saisir à nouveau votre mot de passe!" required>
                      <!---<div class="invalid-feedback">Entrer un mot de passe s'il vous plaît!</div>---->
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Je suis d'accord et j'accepte les <a href="#">termes et les conditions</a></label>
                        <div class="invalid-feedback">Vous devez accepter avant de soumettre.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Créer un compte</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Vous aviez déjà un compte? <a href="login.php">Se Connecter</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  