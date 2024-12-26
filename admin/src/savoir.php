<?php
// Démarrer la session
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: index.php?pg=login");
    exit;
}

// Intégrer la base de données
require_once("model/database.php");
$id = $_REQUEST["refPro"];
$user_id = $_SESSION['user_id'];
$supermarket_id = $user_id;

// Écriture de la requête
$req = "SELECT * FROM produits WHERE supermarket_id = $supermarket_id AND produit_id = $id";
// Exécution de la requête
$result = mysqli_query($conn, $req);

while ($row = mysqli_fetch_assoc($result)) {
    $pro = $row["produit_id"];
    $nom = $row["nom"];
    $photo = $row["photo"];
    $prix = $row["prix_unitaire"];
    $des = $row["description"];
    $categorie = $row["categorie"];
    $vol= $row["poids_volume"];
    $qteStock= $row["quantite_en_stock"];
    $exp=$row['date_expiration'];
?>

<style>
    /* Styles CSS */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 800px;
        margin: auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        padding-top: 80px;
    }
    .header {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }
    .header img {
        width: 200px;
        border-radius: 8px;
        margin-right: 20px;
    }
    .header h1 {
        font-size: 24px;
        color: #8a2be2;
        margin: 0;
        padding-top: 10%;
    }
    .header div{
        display: flex;
    }
    .header div span{
        color: #ff4da6;
        font-size:xx-large;
        padding-left: 40%;
    }
    .info {
        margin-top: 20px;
    }
    .features, .safety {
        background-color: #f0f0f0;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .suppr {
        margin-left: 15%;
        width: 250px;
        height: 50px;
        position: fixed;
        bottom: 20px;
        z-index: 1;
        display: flex;
        justify-content: space-between;
    }
    .features ul li span{
        font-weight: 600;
    }
</style>
</head>
<body>
    <form method="post" <?php // echo isset($_REQUEST['update']) ? 'index.php?pg=edition' : 'index.php?pg=del'; ?> action="index.php?pg=edition" enctype="multipart/form-data">  
        <input type="hidden" name="pro" value="<?php echo $pro; ?>">

        <div class="container">
            <h1>Détails du Produit</h1>
  
            <div class="header">
                <img src="photo_pro/<?php echo $photo; ?>" alt="<?php echo $nom; ?>">
                <div>
                    <h1><?php echo $nom; ?></h1>
                    <span><?php echo "$prix CFA"; ?> </span>
                </div>
            </div>

            <div class="info">
                <h2>À propos de ce produit</h2>
                <div class="features">
                    <ul>
                        <li><span>Catégorie:</span> <?php echo"$categorie" ?></li>
                        <li><span>Qté en Stock:</span> <?php echo"$qteStock" ?> </li>
                        <li><span>Poids/Volume:</span> <?php echo"$vol" ?> </li>
                    </ul>
                    <h3>Description</h3>
                    <?php echo $des; ?>
                </div>

                <h2>Sécurité du produit</h2>
                <div class="safety">
                    <ul>
                        <li>A Consommer avant le : <?php echo $exp; ?> </li>
                        <li>Lisez toujours l'étiquette et les informations sur le produit avant utilisation.</li>
                    </ul>
                </div>
            </div>

            <div class="suppr">
                <input type="submit" class="btn btn-warning" value="Mettre à jour" name="update">
            </div>
        </div>
    </form>
</body>
</html>

<?php
}
?>
