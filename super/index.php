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

      <?php require_once("header.php"); ?>

    <main>
      <?php 
        if (isset($_REQUEST['pg']) && !empty($_REQUEST['pg']))  {
            switch($_REQUEST['pg']){
                case 'form': include('form.php');
                    break;
                case 'histo': include('histo.php');
                    break;
                case 'login': include('login.php');
                    break;
                default: include("form.php");
            }
        }
        else{
            include("form.php");
        }
        ?>
    </main>
    <footer>
        <?php //require_once("footer.php");?>
    </footer>
</body>
</html>
    