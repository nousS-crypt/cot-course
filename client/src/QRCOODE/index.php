<?php
// Inclure la bibliothèque phpqrcode
include "phpqrcode/qrlib.php";

// Texte à convertir en QR code
$text = "https://google.com";

// Nom du fichier de sortie (peut être un chemin relatif ou absolu)
$file = 'qrcode.png';

// Taille du QR code (en pixels)
$size = 5;

// Correction d'erreur : L - faible, M - moyenne, Q - bonne, H - très bonne
$level = 'L';

// Créer le QR code
QRcode::png($text, $file, $level, $size);

// Afficher le QR code généré
echo '<img src="'.$file.'" alt="QR Code">';

