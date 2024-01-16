<?php

Session_start();

class Connect extends PDO{
    const HOST='localhost';
    const DB='Test01';
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

    //echo $prod['prix']. $idu . $idpro;

    $prodverif = "SELECT * FROM panier";
    $verif = $pdo -> prepare($prodverif);
    $verif -> execute();

    $verification = false;
    while($pan = $verif -> fetch()){
        if($pan["id"] === $idu && $pan["idpro"] === $idpro){
            return $verification = true;
            break;
        }
    }
    if ($verification == true){
        echo 'Le produit est déjà dans le panier ! ';
        header("Location: ../../pages/category.php");
        exit;
    }
    else {
        $card = "SELECT `prix` FROM `produits` WHERE idpro =".$idpro;
        $pdostmt=$pdo -> prepare($card);
        $pdostmt->bindParam(':code',$idpro);
        $pdostmt->execute();

        $prod=$pdostmt->fetch(PDO::FETCH_ASSOC);

        $insertcard = "INSERT INTO `panier`(`id`, `idpro`, `prixunitaire`) VALUES (:id,:idpro,:prix)";
        $cardstmt = $pdo->prepare($insertcard);
        $cardstmt -> bindParam(':id', $idu);
        $cardstmt -> bindParam(':idpro', $idpro);
        $cardstmt -> bindParam(':prix', $prod['prix']);

        try{ 
            $cardstmt -> execute();
            echo 'Enregistrement effectués avec success ! ';
            header("Location: ../../pages/category.php");
            exit;
        } catch (PDOException $e){
            echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
 
}
