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


