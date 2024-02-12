<?php

Session_start();

class Connect extends PDO{
    const HOST='localhost';
    const DB='olasalama';
    const USER='root';
    const PSW='';

    public function __construct(){
        try{
            parent:: __construct("mysql:dbname=".self::DB.";host=".self::HOST,self::USER,self::PSW);
            // echo 'ok';
        }
        catch(PDOException $e){
            echo $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
}

$pdo = new Connect();

// Ajout au panier  

if(isset($_SESSION['user']) && isset($_GET['idpro'])){
    $idu = $_SESSION['user'];
    $idpro = $_GET['idpro'];
    $qte = 1;

    //echo $prod['prix']. $idu . $idpro;

    $prodverif = "SELECT * FROM panier";
    $verif = $pdo -> prepare($prodverif);
    $verif -> execute();

    $verification = false;
    while($pan = $verif -> fetch()){
        if($pan["id"] === $idu && $pan["idpro"] === $idpro){
            $verification = true;
            break;
        }
    }
    if ($verification == true){
        $qteupdate = "UPDATE `panier` SET `qte`=:qte WHERE idpro = :idpro";
        $vustmt = $pdo->prepare($qteupdate);

        try{
            $vustmt->execute(['idpro'=>$pan['idpro'],"qte"=>$pan['qte']+1]);
            echo 'Produit ajouté au panier avec succès ! ';
            header("Location: ../../pages/catalogue.php");
            exit;
        } catch (PDOException $e){
            echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
    else {
        $card = "SELECT `prix` FROM `produits` WHERE idpro =".$idpro;
        $pdostmt=$pdo -> prepare($card);
        $pdostmt->bindParam(':code',$idpro);
        $pdostmt->execute();

        $prod=$pdostmt->fetch(PDO::FETCH_ASSOC);

        $insertcard = "INSERT INTO `panier`(`id`, `idpro`, `prixunitaire`, qte) VALUES (:id,:idpro,:prix,:qte)";
        $cardstmt = $pdo->prepare($insertcard);
        $cardstmt -> bindParam(':id', $idu);
        $cardstmt -> bindParam(':idpro', $idpro);
        $cardstmt -> bindParam(':prix', $prod['prix']);
        $cardstmt -> bindParam(':qte', $qte);

        try{ 
            $cardstmt -> execute();
            echo 'Produit ajouté au panier avec succès ! ';
            header("Location: ../../pages/catalogue.php");
            exit;
        } catch (PDOException $e){
            echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
 
}
