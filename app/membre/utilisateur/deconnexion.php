<?php
session_start();
session_destroy();
header("location:' . PROJECT_DIR .'membre/connexion")
?>