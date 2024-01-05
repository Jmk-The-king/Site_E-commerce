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

// variables utilisées dans index.php 

$prod1 = "SELECT * from produits where isvalid = true";

// variables utilisées dans category.php

$cat = "SELECT categories.nomcat AS nom_categorie, SUM(IFNULL(produits.quantite, 0)) AS somme_quantite FROM produits INNER JOIN categories ON produits.category = categories.category GROUP BY categories.category, categories.nomcat";

$prod = "SELECT * FROM produits WHERE isvalid=true";     
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])){                                        
    //$search = ;
    $prod = "SELECT * FROM produits WHERE nompro LIKE '%".$_POST["search"]."%' and isvalid=true";//SELECT * FROM `produits` WHERE `nompro`LIKE '%or%'
}  
$prod2 = "SELECT * from produits WHERE isvalid=true LIMIT 8";

// variable pour sigle-product

$query="SELECT * from articles WHERE idpro=:id";
$query="SELECT produits.nompro AS nom, produits.prix AS prix, produits.quantite AS quantite, produits.description AS 'description', produits.image AS 'image', produits.isvalid AS validity, produits.imagemini AS miniature, categories.nomcat AS categorie FROM `produits` INNER JOIN categories ON produits.category = categories.category WHERE idpro=";