<?php
// Intégrer la base de données
require_once("model/database.php");

if (isset($_POST["submit"])) {
    $current_users = $_POST['current_users'];
    $ifu = $_POST['ifu'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];

    // Vérification que l'IFU contient exactement 13 chiffres
    if (!preg_match('/^\d{13}$/', $ifu)) {
        echo "L'IFU doit contenir exactement 13 chiffres.";
    } else {
        // Hashage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Vérification et gestion du fichier photo (logo)
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo_tmp = $_FILES['photo']['tmp_name'];
            $photo_name = $_FILES['photo']['name'];
            $photo_size = $_FILES['photo']['size'];
            $photo_type = $_FILES['photo']['type'];

            // Vérification de l'extension de l'image
            $allowed_extensions = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($photo_type, $allowed_extensions)) {
                echo "L'image doit être au format JPEG ou PNG.";
            } else {
                // Créer un nom unique pour le fichier image
                $photo_new_name = uniqid('logo_', true) . '.' . pathinfo($photo_name, PATHINFO_EXTENSION);
                $photo_destination = 'logo/' . $photo_new_name;

                // Déplacer le fichier dans le dossier 'logo'
                if (move_uploaded_file($photo_tmp, $photo_destination)) {
                    // Préparation et exécution de la requête SQL pour insérer les données
                    $stmt = $conn->prepare("INSERT INTO supermarches (current_users, ifu, password, nom, adresse, photo) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $current_users, $ifu, $hashed_password, $nom, $adresse, $photo_new_name);

                    if ($stmt->execute()) {
                        echo "Utilisateur ajouté avec succès!";
                    } else {
                        echo "Erreur: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Erreur lors de l'upload de l'image.";
                }
            }
        } else {
            echo "Veuillez télécharger une image de logo valide.";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Insertion d'un Nouveau Supermarché</title>
    <style>
        /* Mise en page générale */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100vh; /* Remplir toute la hauteur de la fenêtre */
        }
        section{
            display: flex;
            justify-content: center;
        }
        
        /* Conteneur du formulaire */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            color: #8b5eb2;
            margin-bottom: 20px;
        }

        /* Styles du formulaire */
        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            text-align: left;
            margin-bottom: 8px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Style pour le bouton de soumission */
        input[type="submit"] {
            background: #8b5eb2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background: #ff66b2;
        }

        /* Style pour le texte d'information */
        .info {
            color: #ff66b2;
            font-size: 14px;
            margin-top: 10px;
        }

    </style>
</head>
<body>
<section>
<div class="form-container">
    <h2>Ajouter un Utilisateur</h2>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <!-- Champ pour l'ID de l'utilisateur actuel -->
        <label for="current_users">ID de l'utilisateur actuel:</label>
        <input type="text" id="current_users" name="current_users" required>

        <!-- Champ pour l'IFU -->
        <label for="ifu">IFU:</label>
        <input type="text" id="ifu" name="ifu" required>

        <!-- Champ pour le mot de passe -->
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <!-- Champ pour le nom du supermarché -->
        <label for="nom">Nom du supermarché:</label>
        <input type="text" id="nom" name="nom" required>

        <!-- Champ pour l'adresse du supermarché -->
        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse">

        <!-- Champ pour télécharger un logo de supermarché -->
        <label for="logo">Logo du supermarché:</label>
        <input type="file" id="logo" name="logo" accept="image/*" required>

        <!-- Bouton de soumission -->
        <input type="submit" value="Ajouter" name="submit">
    </form>

    <p class="info">* Veuillez télécharger une image de logo valide pour le supermarché.</p>
</div>
</section>
</body>
</html>
