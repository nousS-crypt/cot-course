<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Ma Page Web</title>
</head>
<body>

      <?php require_once("views/header.php"); ?>

    <main>
      <?php 
        if (isset($_REQUEST['pg']) && !empty($_REQUEST['pg']))  {
            switch($_REQUEST['pg']){
                case 'ajout': include('ajout.php');
                    break;
                case 'validation': include('validation.php');
                    break;
                case 'login': include('login.php');
                    break;
                case 'detail': include('savoir.php');
                    break;
                case 'del': include('delete.php');
                    break;
                case 'edition': include('edition.php');
                    break;
                case 'traitement': include('traitement.php');
                    break;
                case 'logout': include('logout.php');
                    break;
                default: include("ajout.php");
            }
        }
        else{
            include("ajout.php");
        }
        ?>
    </main>
    <footer>
        <?php require_once("views/footer.php");?>
    </footer>
</body>
</html>
    