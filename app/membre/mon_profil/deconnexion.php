<?php
session_destroy();

header('location:' . PROJECT_DIR . 'membre/connexion');
exit;
?>