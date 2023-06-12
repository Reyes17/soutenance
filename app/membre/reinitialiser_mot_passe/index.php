<?php
/*if (check_if_user_connected()) {
    header('location:' . PROJECT_DIR . 'membre/utilisateur/acceuil');
}*/

include './app/commun/index.php';
?>
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            div class="row justify-content-center">
            <div class=" col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="" class="logo d-flex align-items-center w-auto">
                        <img src="../public/image/bliotheque.jpg" alt="bliotheque.jpg">
                        <span class="d-none d-lg-block">Bibliothèque AKAITSUKI</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Réinitialiser mot de passe</h5>
                        
                        </div>

                        <form class="row needs-validation" action="<?= PROJECT_DIR; ?>membre/reinitialiser_mot_passe/traitement" method="post" novalidate>

                            <div class="col-12">
                                <label for="nouveau_mot_passe" class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe" placeholder="Veuillez enter votre nouveau mot de passe" required>
                                <!---<div class="invalid-feedback">Enter une adresse e-mail valide s'il vous plaît!</div>---->
                            </div>

                            <div class="col-12">
                                <label for="confirmer_mot_passe" class="form-label">Confirmer mot de passe</label>
                                <input type="password" name="password" class="form-control" id="confirmer_mot_passe" placeholder="Veuillez confirmer votre nouveau mot de passe" required>
                                <!---<div class="invalid-feedback">Enter une adresse e-mail valide s'il vous plaît!</div>---->
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-6 w-100">
                                    <a href="login">Connexion</a>
                                </div>

                            </div>

                            <div class="col-6">
                                <button class="btn btn-danger w-100" type="reset">Annuler</button>
                            </div>

                            <div class="col-6">
                                <button class="btn btn-primary w-100" type="submit">Envoyer</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
</main>