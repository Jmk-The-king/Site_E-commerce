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

// Fonctionnalité d'inscription 

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])){

    $username = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = $_POST['password'];

    $select = "SELECT mail from user";
    $pdostmt=$pdo->prepare($select);
    $pdostmt->execute();

    $test = true;
    while($users=$pdostmt->fetch()){
        if($mail == $users["mail"]){
            $test = false;
        }   
    }
    if($_POST["password"] === $_POST["passwordConfirm"]){
        
        if($test == true){
            $insert = "INSERT INTO user(username, mail, pass) VALUES (:username,:mail,:pass)";
            $stmt = $pdo->prepare($insert);
            $stmt -> bindParam(":username", $username);
            $stmt -> bindParam(":mail", $mail);
            $stmt -> bindParam(":pass", $pass);
    
            try{
                $stmt -> execute();
                echo 'Enregistrement effectuer avec success ! ';
                header("Location: ../pages/login.php");
                exit;
            }
            catch (PDOException $e){
                echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
            }
        }
        else{
            $message = "This email adress is already in use, please enter a new one !";
            header("Location: ../pages/signup.php?message=" .urlencode($message));
            exit;
        }
    }
    else{
        $alert = "The two passwords are different, please try egain !";
            header("Location: ../pages/signup.php?alert=" .urlencode($alert));
            exit;
    }

    
}

// Fonctionnalité de Connexion

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {

    $email = $_POST['email'];
    $password = $_POST["passwordlog"]; 

    $select = "SELECT * from user";
    $pdostmt=$pdo->prepare($select);
    $pdostmt->execute();

    while($users=$pdostmt->fetch()){
        if($email == $users["mail"] && $password == $users["pass"]){
            header("Location: ../pages/index.html");
            exit;
        }
        $message = "email or password is not correct";
        header("Location: ../pages/login.php?message=" .urlencode($message));
        exit;
    
    }

}