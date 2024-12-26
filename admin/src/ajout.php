<?php
// Démarrer la session
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location:index.php?pg=login");
    exit;
}

// Intégrer la base de données
require_once("model/database.php");

// Vérifiez si le formulaire est soumis
if (isset($_REQUEST['submit'])) {
    // Sanitize et récupérez les valeurs d'entrée
    $refPro = $conn->real_escape_string($_POST['refPro']);
    $marque = $conn->real_escape_string($_POST['marque']);
    $desPro = $conn->real_escape_string($_POST['desPro']);
    $categorie = $conn->real_escape_string($_POST['categorie']);
    $qteStock = (int)$_POST['qteStock'];
    $prix = (float)$_POST['prix'];
    $expiration = $conn->real_escape_string($_POST['expiration']);


    //verification du télécharement de l'image
    if(empty($_FILES["photo"]["tmp_name"])){
        echo"<script>alert('Aucune image n'a été ajouté')</script>";
    }
    //récupération de l'image sans son extension
    $file_name=pathinfo($_FILES["photo"]["name"],PATHINFO_FILENAME);
    //recuperer l'extension de l'image
    $file_extension=pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);
    //Renommer les images
    $new_name_image=$file_name.'_'.date("ymd_His").'.'.$file_extension;

    $photo = $new_name_image;





    $poids = $conn->real_escape_string($_POST['poids']);

    // Récupérer l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['user_id'];
    $supermarket_id = $user_id;


    // Préparer et lier l'instruction SQL
    $stmt = $conn->prepare("INSERT INTO produits (produit_id, supermarket_id, nom, description, categorie, quantite_en_stock, prix_unitaire, date_expiration, poids_volume, photo, date_ajout) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sisssdisss", $refPro, $supermarket_id, $marque, $desPro, $categorie, $qteStock, $prix, $expiration, $poids, $photo);
    
    // Exécuter l'instruction
    if ($stmt->execute()) {
        echo "Produit ajouté avec succès.";
            //Déplacer l'image vers le dossier image
            $dossier="photo_pro/";
            $chemin=$dossier. $new_name_image;
            if(move_uploaded_file($_FILES["photo"]["tmp_name"],$chemin)){
                echo"<script>alert('Ajout effectif')</script>";
            }
      
    } else {
        echo "Erreur lors de l'ajout du produit: " . $stmt->error;
    }

    // Fermer l'instruction et la connexion
    $stmt->close();
}

// $conn->close();
?>

<section class="principal">
    <div class="boite_principale">
        <div class="diaporama_d_images">
            <img src="../img/shopping-cart-shopping-purchasing-candy.jpg" alt="Image 1">
            <img src="../img/360_F_603641752_KZXQVK9LI6XD4KORIEZvwAUm0F2w8Ydj.jpg" alt="Image 2">
            <img src="../img/delivery-truck-parked-front-grocery-store-sliced-view_943281-34880.jpg" alt="Image 3">
        </div>

        <div class="section_B">
            <form class="formulaire" method="POST" action="index.php?pg=ajout" enctype="multipart/form-data">
                <h2>Commençons!</h2>
                <?php
                // Affichez le contenu de la session pour le débogage
                //echo "<pre>" . print_r($_SESSION, true) . "</pre>";
                ?>
                <p class="description">Vous n'êtes qu'à quelques pas du marché!</p>
                <fieldset class="Produit">
                    <legend>Produit</legend>
                    <nav class="bloc1" style="transition:.5s;">
                        <label class="id" style="display:none;">
                            Id de produit <br>
                            <input type="text">
                        </label>
                        <br>
                        <label class="nom" required="">
                            Référence du produit <br>
                            <input type="text" name="refPro" id="refPro" required>
                        </label>
                        <br>
                        <label class="marque">
                            Nom du produit <br>
                            <input type="text" name="marque" id="marque" required="">
                        </label>
                        <br>
                        <label class="description">
                            Description brève de produit<br>
                            <textarea name="desPro" id="desPro"></textarea>
                        </label>
                        <br>
                    </nav>

                    <nav class="bloc2" style="display:none; transition:.5s; opacity:0;">
                        <br>
                        <label> Catégorie
                            <select name="categorie" required="">
                                <option value="fruits">fruits</option>
                                <option value="produits_laitiers">produits laitiers</option>
                                <option value="boissons">boissons</option>
                            </select>
                        </label>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Quantité en stock <br>
                                <input type="number" name="qteStock" id="qteStock" required="">
                            </label>
                            <label>
                                Prix Unitaire <br>
                                <input type="number" name="prix" id="prix" required="">
                            </label>
                        </div>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Date d'expiration
                                <input type="date" name="expiration" id="expiration" required=""> <br>
                            </label>
                            <label>
                                Photo
                                <input type="file" name="photo" id="photo" required>
                            </label>
                        </div>
                        <br>

                        <div style="display:flex;">
                            <label>
                                Poids/Volume
                                <input type="text" name="poids" id="poids" required=""> <br>
                            </label>
                            <input type="submit" value="✓" name="submit">
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

<!-- <section class="produits-section">
        <h2>Articles Ajoutés</h2>
        <div class="produits-container">
            
            <div class="produit-card">
                
                <img src="https://via.placeholder.com/150" alt="Produit 100">
                <h3>Produit 1</h3>
                <p>50,000 FCFA</p>
                <a href="index.php?pg=detail" style="text-decoration:none; color:#ff4da6; margin-left:2%;">En savoir plus > </a>
                <button>Ajouter au panier</button>
            </div>
                         
            <div class="produit-card"  width: 250px;  height: 180px>
                <span style="text-align: center;"><h3>Découvrir plus d'offres</h3></span>
                <button>Voir plus</button>
            </div>    
           
        </div>
    </section> -->

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
    $user_id = $_SESSION['user_id'];
    $supermarket_id = $user_id;
  //ecriture requete
  $req = "SELECT * FROM produits WHERE supermarket_id =  $supermarket_id";
  //execution de la requete
  $result=mysqli_query($conn,$req);

  echo"<form method='post' action='index.php?pg=del'>
        <section class='produits-section'>
        <h2> ARTICLES  AJOUTES</h2>
        <div class='produits-container'>
            
            ";
  //Tant qu'on peut mettre dans $row un enregistremnt faire
  while($row=mysqli_fetch_assoc($result)){
    $pro=$row["produit_id"];
    $nom=$row["nom"];
    $photo=$row["photo"];
    $prix=$row["prix_unitaire"];

    echo"<div class='produit-card'><input type='checkbox' name='pro[]' value='$pro'>
        <img src='photo_pro/$photo' alt='$nom'>
                <h3>$nom</h3>
                <p>$prix FCFA</p>
                <a href='index.php?pg=detail&refPro=$pro&super=$supermarket_id' style='text-decoration:none; color:#ff4da6; margin-left:2%;'>En savoir plus -->> </a>
                <button>Ajouter au panier</button>
           </div>"; 
  }
    echo"  </div> <input type='submit' class='btn supp btn-danger' value='Delete' name='delete'></form>";