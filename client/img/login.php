<?php
session_start();

//integrer la base de donnée
require_once("model/database.php"); 

// Vérifiez si le formulaire a été soumis
if (isset($_REQUEST["submit"])) {
    $ifu = $_POST['ifu'];
    $current_users = $_POST['current_users'];
    $password = $_POST['password'];

    // Préparez une requête SQL pour récupérer les informations de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM supermarches WHERE ifu = ? AND current_users = ?");
    $stmt->bind_param("ss", $ifu, $current_users);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifiez si l'utilisateur existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérifiez le mot de passe 
        if (password_verify($password, $row['password'])) {
            // Authentification réussie, démarrez la session
            $_SESSION['user_id'] = $row['supermarket_id'];
            $_SESSION['current_users'] = $row['current_users'];
            header("Location: index.php?pg=ajout"); // Rediriger vers la page d'ajout
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }

    $stmt->close();
}

$conn->close();
?>

<section class="principal">
    <div class="boite_principale">
        <div class="diaporama_d_images">
            <img src="../img/shopping-cart-shopping-purchasing-candy.jpg" alt="Image 1">
            <img src="../img/360_F_603641752_KZXQVK9LI6XD4KORIEZvwAUm0F2w8Ydj.jpg" alt="Image 2">
            <img src="../img/delivery-truck-parked-front-grocery-store-sliced-view_943281-34880.jpg" alt="Image 3">
        </div>

        <div class="section_B">
            <form class="formulaire" method="POST" action="index.php?pg=login">
                <h2>Bon retour!</h2>
                <p class="description">replonger tout de suite dans!</p>

                <fieldset class="Produit">
                    <legend>Login</legend>
                    <nav class="bloc1" style="transition:.5s;">
                        <label class="id">
                            Nº IFU <br>
                            <input type="text" name="ifu" id="ifu" required> 
                        </label>
                        <br>
                        <label class="nom">
                            l'ID de l'Utilisateur Actuelle <br>
                            <input type="text" name="current_users" id="current_users" required>
                        </label>
                        <br>
                        <label class="marque">
                            Mot de passe <br>
                            <input type="password" name="password" id="password" required> 
                        </label>
                        <br>
                        <input type="submit" value="✓" name="submit">
                    </nav>
                </fieldset>

                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <div class="svg" style="display: none;">
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

<style>
    *
{
    box-sizing:border-box;
    font-family:sans-serif;
    user-select:none;
    scrollbar-width:.5em;
    scrollbar-color:#895CAF;
}

*::-webkit-scrollbar
{
    width:.5em;
}

*::-webkit-scrollbar-track
{
    background:#FFFFFF;
}

*::-webkit-scrollbar-thumb
{
    background-color:#895CAF;
    border-radius:.5rem;
}

body
{
    /* background-color:red; */
    margin:0;
    padding:0;
    overflow-x:hidden;
    /* border:2px solid black; */
}

body::-webkit-scrollbar
{
    width:0;
}

body header
{
    width:100%;
    height:5em;
    /* border:2px solid black; */
    background-color:#895CAF;
    display:flex;
    justify-content:flex-start;
    align-items:center;
    position:fixed;
    top:0;
    left:0;
}

body header img
{
    margin:0 .5% 0 .5%;
    width:6.5%;
    border-radius:1rem;
    transition:.5s;
}

body header img:hover
{
    width:7%;
}

body header p
{
    margin-right:62.5%;
    color:white;
    font-weight:900;
    height:100%;
    width:13em;
    font-size:.85em;
    /* border:2px solid black; */
    display:flex;
    justify-content:center;
    align-items:center;
}

body header div
{
    height:100%;
    width: 50em;
    /* border:2px solid black; */
    display:flex;
    align-items:center;
    justify-content:center;

}

body header div a
{
    margin-right:15%;
    color:#FFFFFF;
    text-decoration:none;
    border:2px solid #FFFFFF;
    height:60%;
    width:6em;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    border-radius:1.5rem;
    transition:.5s;
}

body header div a:hover
{
    background-color:#FE65B0;
    border:none;
    width:6.5em;
    height:80%;
}



/* ajout.css */

body .principal
{
    width:100vw;
    height:600px;
    margin-top:5em;
    background-image:linear-gradient( rgba(225,225,225,.25),rgba(225,225,225,.25) ) , url("../img/IMG-20241010-WA0000.jpg");
    background-size:contain;
    display:flex;
    justify-content:center;
    overflow-y:scroll;
    scrollbar-width:none;
}

body .principal .boite_principale
{
    width:75%;
    height:32em;
    background-color:#FFFFFF;
    border-radius:1em;
    box-shadow:2px 2px 10px 3px rgba(0,0,0,.075);
    display:flex;
    justify-content:flex-start;
    margin-top:5%; /*i'll comment this out soon! */
}

body .principal .boite_principale .diaporama_d_images
{
    width:40%;
    height:90%;
    overflow-x:scroll;
    overflow-y:hidden;
    scrollbar-width:none;
    display:flex;
    margin:2.5% 0 0 2.5%;
    /* border-radius:7.5%; */
}

body .principal .boite_principale .diaporama_d_images img
{
    transition:1s;
}

body .principal .boite_principale .section_B
{
    width:52.5%;
    height:90%;
    margin:2.5% 0 0 2.5%;
    background:rgba(0,0,0,.025);
    border-radius:1em;
}

body .principal .boite_principale .section_B .formulaire
{
   opacity:1;
}

body .principal .boite_principale .section_B .formulaire h2
{
    width:100%;
    text-align:center;
    margin-bottom:-1%;
}

body .principal .boite_principale .section_B .formulaire >p
{
    width:100%;
    text-align:center;
    font-size:.65em;
    color:rgba(0,0,0,.5);
    font-weight:bold;
    margin-bottom:5%;
}

body .principal .boite_principale .section_B .formulaire .Produit
{
    text-align:center;
    border:none;
    background:#FFFFFF;
    width:90%;
    margin-left:5%;
    border-radius:1em;
    padding-bottom:2em;
    max-height:18em;

}


body .principal .boite_principale .section_B .formulaire  .Produit legend
{
    color:#895CAF;
    font-weight:bold;
    font-size:1.2em;
    background:#895CAF;
    color:#FFFFFF;
    padding:1% 1% 1% 1%;
    border-radius:.5em;
}

body .principal .boite_principale .section_B .formulaire .Produit  label
{
    font-size:.8em;
    color:rgba(0,0,0,.5);
    font-weight:bold;
    width:100%;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    text-align:left;
}

body .principal .boite_principale .section_B .formulaire  .Produit  label input
{
    width:40%;
    height:2em;
    padding-left:5%;
    padding-right:5%;
    background:rgba(0,0,0,.025);
    border-top-left-radius:.5rem;
    border-top-right-radius:.5rem;
    border:none;
    transition:.5s;
    color:#895CAF;
    outline:none;
    font-weight:bold;
}

body .principal .boite_principale .section_B .formulaire .Produit  label input:hover
{
    border-bottom:2px solid #FE65B0;
    background:rgba(0,0,0,0);
    color:black;
}

body .principal .boite_principale .section_B .formulaire .Produit  label textarea
{
    width:65%;
    height:6em;
    padding-left:5%;
    padding-right:5%;
    background:rgba(0,0,0,.025);
    border-top-left-radius:.5rem;
    border-top-right-radius:.5rem;
    border:none;
    transition:.5s;
    color:#895CAF;
    outline:none;
    transition:1s;
    font-weight:bold;
    resize:none;
}

body .principal .boite_principale .section_B .formulaire .Produit  label textarea:hover
{
    border-bottom:2px solid #FE65B0;
    background:rgba(0,0,0,0);
    color:black;
}

body .principal .boite_principale .section_B .formulaire .Produit  input[type=submit]
{
    width:1.5em;
    height:1.5em;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    outline:none;
    border:none;
    color:#FFFFFF;
    background-color:#FE65B0;
    font-size:1.5em;
    font-weight:900;
    transition:.5s;
}


body .principal .boite_principale .section_B .formulaire .Produit  input[type=submit]:hover
{
    width:2em;
    height:2em;
}

body .principal .boite_principale .section_B .svg
{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-top:2.5%;
}

body .principal .boite_principale .section_B .svg svg
{
    width:2.5em;
    height:2.5em;
    color:#FFFFFF;
    background:#FE65B0;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    transition:.5s;
}

body .principal .boite_principale .section_B .svg svg:hover
{
    width:2.75em;
    height:2.75em;
}

/*Fin de ajout.css*/



/*validation.css*/

body .v_principale
{
    width:100%;
    height:2000px;
    /* border:2px solid black; */
    scrollbar-width:none;
    margin-top:5em;
    background-color:rgba(0,0,0,.075);
}

body .v_principale section
{
    width:100%;
    display:flex;
    justify-content:flex-start;
    align-items:flex-start; 
} 

body .v_principale section .aside_1, body .v_principale section .aside_2
{
    /* border:2px solid black; */
    background-color:#FFFFFF;
    height:calc(100vh - 5em - 3vh);
    border-radius:1rem;

}

body .v_principale section .aside_1
{
    width:34%;
    margin:.5% 0 0 .5%;
    display:flex;
    flex-direction:column;
}

body .v_principale section .aside_2
{
    width:64%;
    margin:.5% 0 0 .5%;
    display:flex;
    flex-direction:column;
}

body .v_principale section .aside_1  p
{
    width:95%;
    text-align:center;
    margin:5% 0 0 2.5%;
    font-size:1.8em;
    padding:2%;
    color:#895CAF;
    background-color:#FFE6F1;
    border-radius:.5rem;

}

/* A modifier */
body .v_principale section .aside_1 .liste
{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    /* border:2px solid black; */
    opacity:.3;
    flex-grow:1;
}

body .v_principale section .aside_2 .boite_recherche
{
    display:flex;
    justify-content:center;
    align-items:center;
    width:95%;
    margin:2.5% 0 2.5% 2.5%;
    height:5em;
    border-radius:.5rem;
    background-color:#FFE6F1;
}

body .v_principale section .aside_2 .boite_recherche input[type=search]
{
    width:40%;
    height:2.5em;
    border:none;
    border-bottom:2px solid #FFFFFF;
    border-top-left-radius:.5rem;
    background-color:#FFFFFF;
    margin-right:1%; 
}

body .v_principale section .aside_2 .boite_recherche input[type=search]:focus
{
    outline:none;
}

body .v_principale section .aside_2 .boite_recherche input[type=search]::placeholder
{
    text-align:center;
}

body .v_principale section .aside_2 .boite_recherche input[type=submit]
{
    width:10%;
    height:2.5em;
    border:none;
    border-top-right-radius:.5rem;
    transition:.5s;
    display:flex;
    justify-content:center;
    align-items:center;
    border:2px solid #FE65B0;
    background-color:#FFFFFF;
    color:#FE65B0;
}

body .v_principale section .aside_2 .boite_recherche input[type=submit]:hover
{
    border:none;
    background-color:#FE65B0;
    color:#FFFFFF;
    
}


body .v_principale section .aside_2  .labelle_produits
{
    width:95%;
    height:2em;
    margin-left:2.5%;
}


body .v_principale section .aside_2  .labelle_produits tr td
{
    color:#FFFFFF;
    font-weight:900;
    background-color:#FE65B0;
}

body .v_principale section .aside_2  .liste
{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    /* border:2px solid black; */
    opacity:.3;
    flex-grow:1;
} 

.produits-section {
    width: 100%;
    padding: 20px;
    text-align: center;
    background-color: #f9f8fd;
}

.produits-section h2 {
    color: #333;
    font-size: 2rem;
    margin-bottom: 20px;
}

.produits-container {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap; 
}

.produit-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    width: 240px; 
    text-align: left; 
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.produit-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.produit-card img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 10px;
}

.produit-card h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.produit-card .original-price {
    font-size: 14px;
    color: #888;
    text-decoration: line-through;
}

.produit-card .discounted-price {
    font-size: 18px;
    color: #e60023;
    font-weight: bold;
}

.produit-card .expiry-date {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

.produit-card .discount-badge {
    display: inline-block;
    background-color: #c8f7c5; 
    color: #ff4da6;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    margin-top: 10px;
}

.produit-card button {
    background-color: #ff4da6;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.produit-card button:hover {
    background-color: #ff4da6;
}

.produits-container::-webkit-scrollbar {
    height: 8px;
}

.produits-container::-webkit-scrollbar-thumb {
    background-color: #8a2be2;
    border-radius: 10px;
}

.supp{
    width: 100px;
    height: 50px;
    position: fixed;
    bottom: 20px;
    z-index: 1;
}

.logout{
    position: fixed;
    top: 100px;
    right: 30px;
    text-decoration: none;
    color: rgb(0, 0, 0);
    transition:.5s;
}
.logout:hover{
    background-color: #eb024055;
    border-radius: 10px;
    padding: 5px;
}
</style>