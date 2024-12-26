<?php
session_start();
require_once("model/database.php");
if (isset($_REQUEST['modif'])) {
    $id = $_REQUEST["refPro"];
    $user_id = $_SESSION['user_id'];
    $supermarket_id = $user_id;
    $nom = mysqli_real_escape_string($conn, $_POST['marque']);
    $des = mysqli_real_escape_string($conn, $_POST['desPro']);
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
    $qteStock = mysqli_real_escape_string($conn, $_POST['qteStock']);
    $prix = mysqli_real_escape_string($conn, $_POST['prix']);
    $exp = mysqli_real_escape_string($conn, $_POST['expiration']);
    $vol = mysqli_real_escape_string($conn, $_POST['poids']);
    
    // Gérer l'upload de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Exemple de types autorisés
        if (!in_array($_FILES['photo']['type'], $allowedTypes)) {
            echo "Format de fichier non autorisé.";
            exit;
        }
        $photo = 'photo_pro/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
        $photo = mysqli_real_escape_string($conn, $photo);
    } else {
        echo "Erreur lors du téléchargement de la photo.";
        exit;
    }
    

$updateQuery = "UPDATE produits SET 
                    nom = '$nom',
                    description = '$des',
                    categorie = '$categorie',
                    quantite_en_stock = '$qteStock',
                    prix_unitaire = '$prix',
                    date_expiration = '$exp',
                    poids_volume = '$vol',
                    photo = '$photo'
                    WHERE supermarket_id = $supermarket_id AND produit_id = $id";
    //echo $updateQuery; // Pour déboguer et vérifier la requête


    if (mysqli_query($conn, $updateQuery)) {
        header("Location:index.php?pg=detail&refPro=$id");
    } else {
        echo "Erreur lors de la mise à jour du produit : " . mysqli_error($conn);
    }
}