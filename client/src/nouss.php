<?php
// Démarrer la session
session_start();

if (!isset($_SESSION['panier'])) {
    //si une session panier n'existe pas on en creer une et on y met un tableau
    $_SESSION['panier']= array();  
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: index.php?pg=login");
    exit;
}
$market = $_REQUEST['id'];
?>
    <link rel="stylesheet" href="Styles/supermar.css">
    <!-- Deuxième header -->
    <header class="secondary-header">
        <img src="uploads/24.jpg" alt="Logo secondaire" width="70" height="50">
        <div class="logo"><span style="color: #ff4da6;">24 heures</span></div>
        <div class="search-bar">
            <input type="text" placeholder="Rechercher un produit">
            <button>Rechercher</button>
        </div>
        <nav>
            <div class="cart-tab">
                <a href="index.php?pg=panier&market=<?php echo "$market"?>"> 🛒<span style="color: #ff4da6;">Panier<span style="color:red;font-size:1.5em;"> <?=array_sum($_SESSION['panier']); ?></span> </span></a>
            </div>
        </nav>
    </header>

    <section class="product-section">
        <h2>Les catégories les plus populaires</h2>
        <br><br>
        <div class="product-grid">
            <div class="product-card">
                <img src="uploads/vins.jpg" alt="Produit 1">
                <h3>VINS</h3>
                <button>Explorer</button>
            </div>

            <div class="product-card">
                <img src="uploads/pain.jpg" alt="Produit 2">
                <h3>Patisserie</h3>
                <button>Explorer</button>
            </div>

            <div class="product-card">
                <img src="uploads/viande.jpg" alt="Produit 3">
                <h3>Boucherie</h3>
                <button>Explorer</button>
            </div>

            <div class="product-card">
                <img src="uploads/crudite.jpg" alt="Produit 4">
                <h3>Crudité</h3>
                <button>Explorer</button>
            </div>
        </div>
    </section>

<?php
// print_r($_SESSION);
$market = $_REQUEST['id'];
// Intégrer la base de données
require_once("model/database.php");

//ecriture requete
$req = "SELECT * FROM produits WHERE supermarket_id =  $market";
//execution de la requete
$result=mysqli_query($conn,$req);

echo"<section class='produits-section'>
        <h2>Nos Meilleures Offres / Débutez votre panier</h2>
        <div class='produits-container'>";
//Tant qu'on peut mettre dans $row un enregistremnt faire
while($row=mysqli_fetch_assoc($result)){
$pro=$row["produit_id"];
$nom=$row["nom"];
$photo=$row["photo"];
$prix=$row["prix_unitaire"];

echo"<div class='produit-card'>
            <form method='POST' action='index.php?pg=ajout_panier&market=$market'>
                <img src='../../admin/src/photo_pro/$photo' alt='$nom'>
                <input type='hidden' name='ref' value='$pro'>
                <input type='hidden' name='market' value='$market'>
                <h3>$nom</h3>
                <p style='color:red; font-weight:bold'>$prix FCFA</p>
                <input type='submit'class='btn btn-danger' name='ajouter' value='Ajouter au panier'>
            </form>
     </div>"; 
}
echo"
            <div class='produit-card'  width: 250px;  height: 180px>
                <span style='text-align: center;'><h3>Découvrir plus d'offres</h3></span>
                <button>Voir plus</button>
            </div>    
            
        </div>
    </section>";

?>

<div style="display:flex; margin-left:8%; gap:5%">
        <section class="extra-cards-section">
            <div class="extra-card-1">
                <a href="cave.html"><h1><span style="color: white;text-decoration:none;"><p style="text-decoration:none;">Cave à vin </span></p></h1></a>
            
            </div>

        </section>

        <section class="extra-cards-section">
            <div class="extra-card-2">
                <a href="boulangerie.html"><h1><span style="color: white;"><p>Boulangerie</span></p></h1></a>
                
            </div>
        
        </section>
</div>
