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

