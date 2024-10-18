<?php

// Vider le panier en supprimant la variable de session 'panier'
unset($_SESSION['panier']);

// Rediriger l'utilisateur vers la page du formulaire d'emprunt (ou une autre page selon vos besoins)
header('Location: ' . PROJECT_DIR . 'membre/emprunt/formulaire_emprunt');
exit();
?>
