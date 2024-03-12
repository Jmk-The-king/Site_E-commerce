<?php
    $machine = "mysql:host=localhost;dbname=vetements";
    $utilisateur = "root";
    $mdp = "";

    $con = new PDO($machine,$utilisateur,$mdp);
    $client = array();
?>