<?php
// Démarre la session
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion ou l'accueil
header("Location: index.php?pg=login"); // ou toute autre page
exit;
