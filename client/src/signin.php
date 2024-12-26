<?php
// Inclure le fichier de connexion à la base de données
require_once("model/database.php");

// Vérifier si le formulaire a été soumis
if (isset($_REQUEST["submit"])) {
    // Récupérer les données envoyées via le formulaire
    $email = isset($_POST['mail']) ? $_POST['mail'] : '';
    $username = isset($_POST['nom']) ? $_POST['nom'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['passwd']) ? $_POST['passwd'] : '';
    $acceptTerms = isset($_POST['client']) ? $_POST['client'] : '';

    // Vérifier si les champs sont remplis et valides
    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword) || empty($acceptTerms)) {
        echo "Tous les champs sont obligatoires.";
    } elseif ($password !== $confirmPassword) {
        // Vérifier si le mot de passe et sa confirmation sont identiques
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'email est déjà pris
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->bind_param("s", $email); // 's' pour string (email)
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close(); 
        if ($count > 0) {
            echo "L'email est déjà utilisé.";
        } else {
            // Hacher le mot de passe avant de l'enregistrer
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Définir le rôle de l'utilisateur (par défaut, 'client' si ce n'est pas spécifié)
            $role = 'client';  // Vous pouvez ajouter un champ supplémentaire pour sélectionner le rôle si nécessaire

            // Préparer la requête d'insertion
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashedPassword, $email, $role); // 'ssss' pour 4 chaînes de caractères

            // Exécuter la requête
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = "client";
                // header("Location:index.php?pg=home");
            } else {
                echo "Une erreur est survenue lors de l'ajout de l'utilisateur.";
            }
        }

        // Fermer le statement
        $stmt->close();
    }
}

// Fermer la connexion à la base de données
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
            <form class="formulaire" method="POST" action="index.php?pg=signin" enctype="multipart/form-data">
                <h2>Commençons!</h2>
                <p class="description">Vous n'êtes qu'à quelques pas du marché!</p>
                <fieldset class="Produit">
                    <legend>S'inscrire</legend>
                    <nav class="bloc1" style="transition:.5s;">
                        <label class="id" style="display:none;">
                            Id de produit <br>
                            <input type="text">
                        </label>
                        <br>
                        <label class="nom" required="">
                            Email : <br>
                            <input type="email" name="mail" id="mail" required>
                        </label>
                        <br>
                        <label class="marque">
                            Nom d'Utilisateur :<br>
                            <input type="text" name="nom" id="nom" required="">
                        </label>
                        <br>
                        <label class="description">
                            Mot de Passe :<br>
                            <input type="password" name="password" id="password" required="">
                        </label>
                        <br>
                    </nav>

                    <nav class="bloc2" style="display:none; transition:.5s; opacity:0;">
                        <br>
                        <br>
                        <br>
                        <label> Confirmez le mot de passe
                            <input type="password" name="passwd" id="passwd" required="">
                        </label>
                        <br>

                        <div >
                            <label>
                                <div>
                                    <input type="checkbox" name="client" id="client" style=" width: 30px; color: #FE65B0;" required>
                                    <p style="font-size: large; color: #895CAF;">J'accepte les conditons d'inscriptions</p>
                                </div>
                            </label>
                            
                        </div>
                        <br>
                        <div style="display:flex;">
                            <div style="width: 45%;"></div>
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

    /* ajout.css */

    body .principal
    {
        width:100vw;
        height:600px;
        /* margin-top:5em; */
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
        width:80%;
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


</style>