<?php
require_once("model/database.php");
foreach ($_REQUEST['pro'] as $value) {
        $req=sprintf("DELETE FROM produits WHERE produit_id = '%s'",$value);
        $result=mysqli_query($conn,$req);
    }
    header("Location:index.php?pg=ajout");
