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
            header("Location: ../../pages/index.php");
            exit;
        } catch (PDOException $e){
            echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
    else {
        $card = "SELECT `prix` FROM `produits` WHERE idpro =".$idpro;
        $pdostmt=$pdo -> prepare($card);
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
            header("Location: ../../pages/index.php");
            exit;
        } catch (PDOException $e){
            echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
        }
    }
 
}

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
                header("Location: ../../pages/login.php");
                exit;
            }
            catch (PDOException $e){
                echo "Erreur lors de l'enrgistrement : " . $e->getMessage().' '.$e->getFiles().' '.$e->getLine();
            }
        }
        else{
            $message = "This email adress is already in use, please enter a new one !";
            header("Location: ../../pages/signup.php?message=" .urlencode($message));
            exit;
        }
    }
    else{
        $alert = "The two passwords are different, please try egain !";
        header("Location: ../../pages/signup.php?alert=" .urlencode($alert));
        exit;
    }    
}

// Fonctionnalité de Connexion

Session_start();

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {

    $email = $_POST['email'];
    $password = $_POST["passwordlog"]; 

    $select = "SELECT * from user";
    $pdostmt=$pdo->prepare($select);
    $pdostmt->execute();

    while($users=$pdostmt->fetch()){
        if($email == $users["mail"] && $password == $users["pass"]){
            $_SESSION["user"] = $users["id"];
            header("Location: ../../pages/index.php");
            exit;
        }
    }
    $message = "email or password is not correct";
    header("Location: ../../pages/login.php?message=" .urlencode($message));
    exit;
}
