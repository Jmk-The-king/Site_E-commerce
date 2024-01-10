<?php

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

if(isset($_GET['id']) && isset($_GET['idpro'])){
    $idu = $_GET['id'];
    $idpro = $_GET['idpro'];

    $card = "SELECT  `nompro`, `prix`, `imagemini` FROM `produits` WHERE idpro =".$idpro;
    $pdostmt=$pdo->prepare($card);
    $pdostmt->bindParam(':code',$idpro);
    $pdostmt->execute();

    $produit=$pdostmt->fetch(PDO::FETCH_ASSOC);

    $insertcard = "INSERT INTO `panier`(`id`, `idpro`, `prixunitaire`) VALUES (:id,:idpro,:prix)";
    $cardstmt = $pdo -> prepare($insertcard);
    $cardstmt -> bindParam(':id', $idu);
    $cardstmt -> bindParam(':idpro', $idpro);
    $cardstmt -> bindParam(':prix', $produit['prix']);

    $cardstmt -> execute();
    echo 'Enregistrement effectués avec success ! ';
    header("Location: ../../pages/index.php");
    exit;
    
}

// Requetes utilisées dans index.php 

$prod1 = "SELECT * from produits where isvalid = true";

// Requetes utilisées dans category.php

$cat = "SELECT categories.nomcat AS nom_categorie, SUM(IFNULL(produits.quantite, 0)) AS somme_quantite FROM produits INNER JOIN categories ON produits.category = categories.category GROUP BY categories.category, categories.nomcat";

$prod = "SELECT * FROM produits WHERE isvalid=true";     
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])){                                        
    //$search = ;
    $prod = "SELECT * FROM produits WHERE nompro LIKE '%".$_POST["search"]."%' and isvalid=true";//SELECT * FROM `produits` WHERE `nompro`LIKE '%or%'
}  
$prod2 = "SELECT * from produits WHERE isvalid=true LIMIT 8";

// Requete pour sigle-product

$query="SELECT * from produits WHERE idpro=:id";
$query="SELECT produits.nompro AS nom, produits.prix AS prix, produits.quantite AS quantite, produits.description AS 'description', produits.image AS 'image', produits.isvalid AS validity, produits.imagemini AS miniature, categories.nomcat AS categorie FROM `produits` INNER JOIN categories ON produits.category = categories.category WHERE idpro=";
// $views="update articles set vues=:view where code=:code";


// Commentaire sur les produits 

if($_SERVER["REQUEST"] = "POST" && isset($_POST["submit"])){
    $idprod = $_GET["idpro"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $message = $_POST["message"];

    $insertcom = "INSERT INTO `commentaire`(`idpro`, `nomcomplet`, `adressmail`, `phone`, `commentaire`) VALUES (:idpro,:nomcomplet,:email,:phone,:commentaire)";
    $stmt = $pdo->prepare($insertcom);
    $stmt -> bindParam(":idpro", $idprod);
    $stmt -> bindParam(":nomcomplet", $name);
    $stmt -> bindParam(":email", $email);
    $stmt -> bindParam(":phone", $number);
    $stmt -> bindParam(":commentaire", $message);

    try{
        $stmt -> execute();
        echo 'Enregistrement effectuer avec success ! ';
        header("Location: ../../pages/single-product.php?idpro=".urlencode($_GET["idpro"]));
        exit;
    }
    catch (PDOException $e){
        echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
    }
    
}

// requete utilisées pour afficher les commentaires 

$comment = "SELECT `comid`, `idpro`, `nomcomplet`, `adressmail`, `phone`, `commentaire`, `time` FROM `commentaire` WHERE idpro = "; 


  

//$panier = "SELECT `idpro`, `nompro`, `prix`,`image`, `isvalid`, `imagemini` FROM `produits` WHERE isvalid=true AND id";