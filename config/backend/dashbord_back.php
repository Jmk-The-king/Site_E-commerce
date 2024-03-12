<?php
class Connexion extends PDO{
    const HOST = "localhost";
    const DB = "olasalama";
    const USER = "root";
    const PWD ="";

    public function __construct(){
        try{
            parent:: __construct("mysql:dbname=".self::DB.";host=".self::HOST,self::USER,self::PWD);
        }
        catch(PDOException $e){
            echo $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
}

$con = new Connexion();

// Selection des Produits pour Le dashbord

$dashProd = "SELECT * FROM produits JOIN sous_categorie ON produits.id_sc = sous_categorie.id_sc ORDER BY idpro ASC";

// Suppression des produits 

/* if($_SERVER['REQUEST'] & isset($_POST["delete"])){

} */