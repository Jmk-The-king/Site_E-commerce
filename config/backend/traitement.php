<?php

    include("backend.php");
    session_start();
    if(isset($_POST['supprimer'])){
        $idProduit = $_POST['supprimer'];

        $delete = "DELETE from panier where idpro = $idProduit";
        $pdo->exec($delete);
        header("Location:../../pages/panier.php");   
    }
  if(isset($_POST['modifier'])){
        $idP = $_POST['modifier'];
        $qte = $_POST['quantite'];
                  
        $modif = "UPDATE panier set qte = $qte WHERE idpan = $idP";
        $pdo->exec($modif);
        header("Location:../../pages/panier.php");                           
    }
?>
