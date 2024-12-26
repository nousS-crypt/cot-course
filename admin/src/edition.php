<?php

// Démarrer la session*
session_start();

ini_set('display_errors', 1);  // Affiche les erreurs
error_reporting(E_ALL);

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: index.php?pg=login");
    exit;
}
if (isset($_REQUEST['update'])) {
    # code...

// Intégrer la base de données
require_once("model/database.php");
$id = $_REQUEST["pro"];
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

<section class="principal">
    <div class="boite_principale">
        <div class="diaporama_d_images">
            <img src="../img/shopping-cart-shopping-purchasing-candy.jpg" alt="Image 1">
            <img src="../img/360_F_603641752_KZXQVK9LI6XD4KORIEZvwAUm0F2w8Ydj.jpg" alt="Image 2">
            <img src="../img/delivery-truck-parked-front-grocery-store-sliced-view_943281-34880.jpg" alt="Image 3">
        </div>

        <div class="section_B">
            <form class="formulaire" method="POST" action="index.php?pg=traitement" enctype="multipart/form-data">
                <h2>Mise à jour de cet article!</h2> <br>
                <p class="description">Apportez vos Corrections et <span style="color:red"> surtout réinserez la photo</span></p>
                <fieldset class="Produit">
                    <!-- <legend>Produit</legend> -->
                    <nav class="bloc1" style="transition:.5s;">
                        <label class="id" style="display:none;">
                            Id de produit <br>
                            <input type="text" value="">
                        </label>
                        <br>
                        <label class="nom" required="">
                            Référence du produit <br>
                            <input type="text" name="refPro" id="refPro" <?php if(isset($_REQUEST['update'])) echo"value='$pro'"; ?> required>
                        </label>
                        <br>
                        <label class="marque">
                            Nom du produit <br>
                            <input type="text" name="marque" id="marque" <?php if(isset($_REQUEST['update'])) echo"value='$nom'"; ?> required>
                        </label>
                        <br>
                        <label class="description">
                            Description brève de produit<br>
                            <textarea name="desPro" id="desPro" ><?php if(isset($_REQUEST['update'])) echo"$des"; ?></textarea>
                        </label>
                        <br>
                    </nav>

                    <nav class="bloc2" style="display:none; transition:.5s; opacity:0;">
                        <br>
                        <label> Catégorie
                            <select name="categorie" required="">
                                <option value="fruits" <?php if(isset($_REQUEST['update'])&& $categorie=='fruits') echo"selected" ?>>fruits</option>
                                <option value="produits_laitiers" <?php if(isset($_REQUEST['update'])&& $categorie=='produits_laitiers') echo"selected" ?>>produits laitiers</option>
                                <option value="boissons" <?php if(isset($_REQUEST['update'])&& $categorie=='boissons') echo"selected" ?>>boissons</option>
                            </select>
                        </label>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Quantité en stock <br>
                                <input type="number" name="qteStock" id="qteStock" <?php if(isset($_REQUEST['update'])) echo"value='$qteStock'"; ?> required>
                            </label>
                            <label>
                                Prix Unitaire <br>
                                <input type="number" name="prix" id="prix" <?php if(isset($_REQUEST['update'])) echo"value='$prix'"; ?> required>
                            </label>
                        </div>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Date d'expiration
                                <input type="date" name="expiration" id="expiration" <?php if(isset($_REQUEST['update'])) echo"value='$exp'"; ?> required> <br>
                            </label>
                            <label>
                                Photo
                                <input type="file" name="photo" id="photo" <?php if(isset($_REQUEST['update'])) echo"value='$photo'";?> required>
                            </label>
                        </div>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Poids/Volume
                                <input type="text" name="poids" id="poids" <?php if(isset($_REQUEST['update'])) echo"value='$vol'"; ?> required> <br>
                            </label>
                            <input type="submit" value="✓" name="modif">
                        </div>
                        <br>
                    </nav>
                </fieldset>

                <div class="svg">
                    <svg fill="#FFFFFF" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 55.752 55.752" xml:space="preserve" class="icon">
                        <style>
                            .icon {
                                padding: 5px;
                            }
                        </style>
                        <g>
                            <path d="M43.006,23.916c-0.28-0.282-0.59-0.52-0.912-0.727L20.485,1.581c-2.109-2.107-5.527-2.108-7.637,0.001
                                c-2.109,2.108-2.109,5.527,0,7.637l18.611,18.609L12.754,46.535c-2.11,2.107-2.11,5.527,0,7.637c1.055,1.053,2.436,1.58,3.817,1.58
                                s2.765-0.527,3.817-1.582l21.706-21.703c0.322-0.207,0.631-0.444,0.912-0.727c1.08-1.08,1.598-2.498,1.574-3.912
                                C44.605,26.413,44.086,24.993,43.006,23.916z"></path>
                        </g>
                    </svg>
                </div>
            </form>
        </div>
    </div>
    
</section>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const svgIcon = document.querySelector(".svg");
        const bloc1 = document.querySelector(".bloc1");
        const bloc2 = document.querySelector(".bloc2");

        // Ajoutez un gestionnaire d'événements au clic sur l'icône SVG
        svgIcon.addEventListener("click", () => {
            // Vérifiez la visibilité actuelle de bloc2 et basculez
            if (bloc2.style.display === "none" || bloc2.style.display === "") {
                bloc1.style.display = "none"; // Masquez le bloc1
                bloc2.style.display = "block"; // Affichez le bloc2
                bloc2.style.opacity = 1; // Assurez-vous que l'opacité est 1
            } else {
                bloc1.style.display = "block"; // Affichez le bloc1
                bloc2.style.display = "none"; // Masquez le bloc2
            }
        });
    });
</script>


<?php
}
}

?>