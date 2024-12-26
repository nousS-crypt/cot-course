<?php // A mettre en tete de page avant le !DOCTYPE
session_start();
$user = $_SESSION['user_id'];
// Intégrer la base de données
require_once("model/database.php"); 
//supprimer les produits ajoutées
//si del existe
if(isset($_REQUEST['del'])){
    $id_del = $_REQUEST['del'];
    //deleted
    unset($_SESSION['panier'][$id_del]);
}
$marche = $_REQUEST['market'];

// Préparez une requête SQL pour récupérer les informations de l'utilisateur
$stmt = $conn->prepare("SELECT * FROM supermarches WHERE supermarket_id = ?");
$stmt->bind_param("s", $marche);
$stmt->execute();
$result = $stmt->get_result();

// Vérifiez si l'utilisateur existe
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $super = $row["nom"];
    $market = $row["supermarket_id"];
}
?>

    <link rel="stylesheet" href="Styles/panier.css">

    <section class="promo-section">
        <h1>Panier</h1>
        <p>Ayez un aperçu sur toutes vos courses !</p>
    </section>

    <main class="panier">
            
            <p><a href="index.php?pg=nouss&id=<?="$market"?>"class="liens btn btn-primary" style="text-decoration:none;"><?="$super"?></a></p>
            <section>
                <form action="index.php?pg=panier&market=<?="$market"?>" method="post">
                    <table>
                        <tr>
                            <th>Apercu</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantités</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $total=0;
                        //Lister les produits ajouter
                        //recuperer les clés
                        include_once("ajouter_panier.php");// essai
                        $ids = array_keys($_SESSION['panier']);
                        if(empty($ids)){
                            echo"<h5 style='text-align:center; color:red;'>Votre panier est vide</h5>";
                        }
                        else {
                        $queries = mysqli_query($conn,"SELECT * FROM produits WHERE produit_id IN(".implode(',',$ids).")");

                            //lister les produits avec foreach
                            // Variable pour stocker les noms des produits
                            $produits_noms = "";    
                            foreach ($queries as $value):
                                //calcul total
                                $total= $total + $value['prix_unitaire'] * $_SESSION['panier'][$value['produit_id']];
                                // Ajouter le nom du produit à la variable $produits_noms
                                if ($produits_noms != "") {
                                    $produits_noms .= ", ";  // Ajoute une virgule pour séparer les noms
                                }
                                $produits_noms .= $value['nom'] . "*". $_SESSION['panier'][$value['produit_id']] ;
                        ?>
                        <tr>
                            <td><img src="../../admin/src/photo_pro/<?=$value['photo'];?>" alt=""></td>
                            <td><?=$value['nom'];?> <input type="hidden" name="nomPro" value="<?=$value['nom'];?>"></td>
                            <td><?=$value['prix_unitaire'];?> <input type="hidden" name="prixPro" value="<?=$value['prix_unitaire'];?>"></td>
                            <td><?=$_SESSION['panier'][$value['produit_id']]; //Qtés?> <input type="hidden" name="qtePro" value="<?=$_SESSION['panier'][$value['produit_id']];?>"></td>
                            <td><a href="index.php?pg=panier&market=<?="$market"?>&del=<?=$value['produit_id'];?>"><img src="uploads/disposition.png" alt="poubelle"></a></td>
                        </tr>

                        <?php
                        endforeach;
                        }
                        ?>
                        <tr class="total">
                            <td>Total :<?=$total;?> FCFA <input type="hidden" name="total" value="<?=$total;?>"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="total" value="<?="$market"?>">
                    <input type="submit" name="commande" class="btn btn-success"  value="Mon Bon de Commande" style="margin-left:40%">
                </form>
            </section>
    </main>
    <h1 style="text-align:center">Bons de Commandes</h1>
            <hr>
    <style>
        .panier{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .panier img{
            width: 40px;
            padding: 8px 0;
        }
        .panier section{
            width: 70%;
            background-color: #F8D1C3;
            padding: 10px;
            border-radius: 6px;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            letter-spacing: 1px;
            font-size: 15px;
        }
        th{
            padding: 10px 0;
            font-weight: 600;
        }
        td{
            border-top: 0.5px solid #999;
            text-align: center;
        }
        tr{
            border-bottom: 0.5px solid #999;
        }
        .total{
            border: 0;
            float: left;
            font-weight: 800;
            letter-spacing: 2px;
            padding: 10px;
            color: blue;
        }

.extra-card-1 {
    background-image:url(../uploads/ooo.jpg) ;
    background-size: 50%;
    background-position: center;
    background-color: #ffe6f0;
    color: #fff;
    padding: 20px;
    width: 500px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.extra-card p {
    color:white ;
    font-size: 60px;
}
.extra-card:hover{
    transform: scale(1.05);
}

.extra-cards-section {
    justify-content: center;
    gap: 150px;
    padding: 20px;
    background-color: #f9f8fd;
    
}


    </style>

    <section style="display:flex; gap:20px; flex-wrap:wrap;">


<?php

// Traitement de la commande lors de la soumission
if (isset($_REQUEST['commande'])) {
    // Variables de commande
    $produit = $produits_noms;
    $totals = $total;
    $statut = "en attente";

    // Recherche d'une commande en attente pour cet utilisateur
    $stmt = $conn->prepare("SELECT * FROM commandes WHERE user_id = ? AND statut = ?");
    $stmt->bind_param("ss", $user, $statut);
    $stmt->execute();
    $result = $stmt->get_result();
    $commande = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $commande = $row["commande_id"];
    }
    $stmt->close();

    // Générer le QR code
    $stmt = $conn->prepare("SELECT * FROM commandes WHERE user_id = ? statut = ? ORDER BY commande_id DESC LIMIT 1");
    $stmt->bind_param("ss", $user, $statut);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {    
    $row=mysqli_fetch_assoc($result);
    $commande = (int) $row["commande_id"] + 1;
    include "QRCOODE/phpqrcode/qrlib.php";
    $text = "Bon de Commande $commande ----- Produit: $produit ----- Total: $totals FCFA";
    $stmt->close();
    $date = date("Y-m-d H-i-s");
    $file = "qrcode_supermarket=$super"."_user_id_$user"."_". $date .".png";
    $size = 5;
    $level = 'H';
    
    QRcode::png($text, $file, $level, $size);
    }
    // Insertion de la commande dans la base de données
    // Debug: Vérifier les valeurs avant insertion
    // echo "Produits: $produit <br>";
    // echo "QRCode: $file <br>";
    // echo "Total: $totals <br>";
    // echo "User ID: $user <br>";
    // echo "Statut: $statut <br>";

    $conn->begin_transaction();
    // inserer dans la base de donnée
    $stmt = $conn->prepare("INSERT INTO commandes (produits, qrcode, total, user_id, statut) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $produit, $file, $totals, $user, $statut);
    $stmt->execute();
    $resulta = $stmt->get_result();
    $conn->commit();
    $stmt->close();

     //pour afficher le bon de commande
     $stmt = $conn->prepare("SELECT * FROM commandes WHERE user_id = ? AND statut = ? ORDER BY commande_id DESC");
     $stmt->bind_param("ss", $user, $statut);
     $stmt->execute();
     $result = $stmt->get_result();

      // Vérifiez si la commande existe
        if ($result->num_rows > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $commande = $row["commande_id"];
            $prod = $row["produits"];
            $tot = $row["total"];
            $code = $row["qrcode"];
            $state = $row["statut"];
        // Afficher le QR code généré
        //echo '<img src="'.$file.'" alt="QR Code">';

        // Afficher le QR code généré
        echo '
        <section>

            <section class="extra-cards-section">
                <div class="extra-card-1">
                    <h5><span style="color: black;">BON DE COMMANDE N°' . $commande . '</span></h5>
                    <h5 style="color:black">Total: ' . $tot . ' FCFA</h5>
                    <img src="qr/' . $code . '" alt="QR Code" width="150" height="150" style="margin-left: 10px;">
                </div>
            </section>
        </section>';
        }
    }
    // Déplacement du QR code vers le dossier 'qr'
    $source = $file;
    $destination = "qr/$file";

    if (!is_dir("qr")) {
        mkdir("qr", 0777, true); // Crée le dossier si nécessaire
    }

    if (file_exists($source)) {
        if (rename($source, $destination)) {
            exit();
           //echo "QR Code déplacé avec succès.";
        } else {
            echo "Erreur lors du déplacement du QR Code.";
        }
    }

    // Réinitialiser le panier
    $_SESSION["panier"] = array();
}

?>
    <!-- <section>
        <h1 style="text-align:center">Bon de Commande </h1>
        <hr>

        <section class="extra-cards-section">
            <div class="extra-card-1">
                <h5><span style="color: black;text-decoration:none;"><p style="text-decoration:none;">BON DE COMMANDE N°<? //="$commande"?> </span></p></h5>
                 <h5 style="color:black">Total:<?php //echo"$tot FCFA";?> </h5>
                 <img src="qr/<?php // echo"$code";?>" alt="qrcode" width="150" height="150" style=" margin-left: 10px;">
               
            </div>
            

        </section>


    </section> -->

    </section>

    <style>
        .panier{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .panier img{
            width: 40px;
            padding: 8px 0;
        }
        .panier section{
            width: 70%;
            background-color: #F8D1C3;
            padding: 10px;
            border-radius: 6px;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            letter-spacing: 1px;
            font-size: 15px;
        }
        th{
            padding: 10px 0;
            font-weight: 600;
        }
        td{
            border-top: 0.5px solid #999;
            text-align: center;
        }
        tr{
            border-bottom: 0.5px solid #999;
        }
        .total{
            border: 0;
            float: left;
            font-weight: 800;
            letter-spacing: 2px;
            padding: 10px;
            color: blue;
        }

.extra-card-1 {
    background-image:url(../uploads/ooo.jpg) ;
    background-size: 50%;
    background-position: center;
    background-color: #ffe6f0;
    color: #fff;
    padding: 20px;
    width: 500px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.extra-card p {
    color:white ;
    font-size: 60px;
}
.extra-card:hover{
    transform: scale(1.05);
}

.extra-cards-section {
    justify-content: center;
    gap: 150px;
    padding: 20px;
    background-color: #f9f8fd;
    
}


    </style>