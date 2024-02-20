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

$dashbordProd = "SELECT * FROM produits JOIN produits.id_sc = sous_categorie.id_sc WHERE isvalid = 1";