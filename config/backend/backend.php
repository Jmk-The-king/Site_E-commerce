<?php

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

// Requetes utilisées dans index.php 

$prods1 = "SELECT * from produits where isvalid = true LIMIT 8";
$prods2 = "SELECT * from produits where isvalid = true AND idpro>8 LIMIT 8";

// Requetes utilisées dans catalogue.php

$selecat = "SELECT * FROM produits JOIN sous_categorie ON produits.id_sc = sous_categorie.id_sc JOIN categories ON sous_categorie.category = categories.category WHERE categories.category =";

$cat = "SELECT categories.category, categories.nomcat AS nom_categorie, SUM(IFNULL(produits.quantite, 0)) AS somme_quantite FROM produits INNER JOIN sous_categorie ON produits.id_sc = sous_categorie.id_sc JOIN categories ON sous_categorie.category = categories.category GROUP BY categories.category";
$scat = "SELECT sous_categorie.id_sc, sous_categorie.nom_sc AS sous_nom FROM produits INNER JOIN sous_categorie ON produits.id_sc = sous_categorie.id_sc GROUP BY sous_categorie.id_sc, sous_categorie.nom_sc";

$prod = "SELECT * FROM produits WHERE isvalid=true LIMIT 25"; 
$prod1 = "SELECT * FROM produits WHERE isvalid=true AND id_sc = "; 

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])){                                        
    //$search = ;
    $prod = "SELECT * FROM produits WHERE nompro LIKE '%".$_POST["search"]."%' and isvalid=true";//SELECT * FROM `produits` WHERE `nompro`LIKE '%or%'
}  

$prod2 = "SELECT * from produits WHERE isvalid=true LIMIT 8";

// Requete pour sigle-product

$query="SELECT * from produits WHERE idpro=:id";
$query="SELECT produits.nompro AS nom, produits.prix AS prix, produits.quantite AS quantite, produits.description AS 'description', produits.image AS 'image', produits.isvalid AS validity, produits.imagemini AS miniature, sous_categorie.nom_sc AS categorie FROM `produits` INNER JOIN sous_categorie ON produits.id_sc = sous_categorie.id_sc WHERE idpro=";
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

// Requète pour le panier 

$panier = "SELECT panier.idpan, panier.qte,produits.prix, produits.idpro, produits.image, produits.nompro FROM `panier` INNER JOIN produits ON panier.idpro = produits.idpro WHERE isvalid = true AND idpan = ";

$paniers = "SELECT * FROM panier";

$countPan = "SELECT COUNT(*) FROM `panier` WHERE 1";

$stmt = $pdo->prepare($countPan);
$stmt -> execute();
$counter = $stmt -> fetch(PDO::FETCH_ASSOC);

$countProds = "SELECT COUNT(*) FROM `produits` WHERE isvalid = 1";

$stmtprod = $pdo->prepare($countProds);
$stmtprod -> execute();
$countprod = $stmtprod -> fetch(PDO::FETCH_ASSOC);

// selection des categories 

$smenu = "SELECT category, nomcat FROM categories";