<?php
//inclure page conn a la bd
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("model/database.php"); 
$market = $_REQUEST['market'];
$id= null;
if (isset($_REQUEST['ajouter'])) {
    # code...
    $id= $_REQUEST['ref'];

$id= $_REQUEST['ref'];
var_dump($id);
//creer une session
if (!isset($_SESSION['panier'])) {
    //si une session panier n'existe pas on en creer une et on y met un tableau
    $_SESSION['panier']= array();  
}
var_dump($_REQUEST['ref']); 
//Recuperation de l'id dans le lien  
if (isset($_REQUEST['ref'])) {
$id = $_REQUEST['ref'];
    //verifier si le prduit existe dans a bd grace a l'id/*  */
    $query= mysqli_query($conn,"SELECT * FROM produits WHERE produit_id = $id");
    if (empty(mysqli_fetch_assoc($query))) {
        die ("Ce produit n'existe pas");
    }


//Ajouter le produit dans le panier
if(isset($_SESSION['panier'][$id])){//si le produit est dejà dans le panier
    $_SESSION['panier'][$id]++;//represente la qte
}else{
    //sinon on l'ajoute
    $_SESSION['panier'][$id]=1;
    // echo'goog';
    // var_dump($_SESSION['panier']);
}
//redirection vers la page d'achat
header(header: "Location: index.php?pg=nouss&id=$market");
}

}