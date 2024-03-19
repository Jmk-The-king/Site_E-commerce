<?php
  Session_start();

  if(!isset($_SESSION["user"]) ){
      header("Location: ./login.php");
      exit;
  }
  require_once "../config/backend/backend.php";
  $pdo = new Connect();

?>

<!doctype html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>aranaz</title>
  <link rel="icon" href="../img/favicon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="../css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <!-- nice select CSS -->
  <link rel="stylesheet" href="../css/nice-select.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="../css/all.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="../css/flaticon.css">
  <link rel="stylesheet" href="../css/themify-icons.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="../css/magnific-popup.css">
  <!-- swiper CSS -->
  <link rel="stylesheet" href="../css/slick.css">
  <link rel="stylesheet" href="../css/price_rangs.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="../css/style.css">
  
  <style>
        .main_menu .cart i:after {
            position: absolute;
            border-radius: 50%;
            background-color: #f13d80;
            width: 14px;
            height: 14px;
            right: -8px;
            top: -8px;
            content: "<?php if($counter["COUNT(*)"] != 0){ echo $counter["COUNT(*)"]; } ?>";
            text-align: center;
            line-height: 15px;
            font-size: 10px;
            color: #fff;
            }
    </style>
</head>

<body>
  <!--::header part start::-->
  <?php 
    require_once "../config/include/header.php";
  ?>
  <!-- Header part end-->
      
  <!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Cart Products</h2>
              <p>Home <span>-</span>Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  
  <!--================Ajout produit =================-->
     
  
  <!-- Formulaire d'insertion des produits -->
  <div class="container">  
    <div class="row justify-content-center"> 
      <div class="col-lg-12">
          <form class="form-contact contact_form" action="Creation.php" method="POST"  style="margin-top: 3cm;">

            <h2  style="  display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom:1cm;">Ajouter un nouveau produit</h2>
            <div class="row">
              
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="nompro" id="nompro" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Entrez le nom du produit'" placeholder='Entrez le nom du produit'>
                </div>
              </div>

              
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="prix" id="prix" type="number" min="0" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Entrez le prix'" placeholder='Entrez le prix'>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="quantite" id="quantite" type="number"  min="0"  onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Entrez la quantité'" placeholder='Entrez la quantité'>
                </div>
              </div>

             <div class="col-sm-6">
                <div class="form-group">
                    <select class="form-select" name="categorie" id="categorie-select">
                      <option value="" disabled selected hidden>      Choisissez une catégorie    </option>
                      <option value="1">Habillement</option>
                      <option value="2">Style Africain</option>
                      <option value="3">Mode Italien</option>
                      <option value="4">Maison et electroménager</option>

                  
                      </select>
                  </div>
              </div>


              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="image" id="image" type="file" accept=".png, .jpg, .jpeg" onchange="validateFile(this)" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Choisir l image du produit '" placeholder='image du produit'>

                </div>          
              </div>


              <div class="col-sm-6">
                <div class="form-group">
                    
                          <select name="sous_categorie" class="form-select">

                              <option value="" disabled selected hidden>Sélectionnez une sous-catégorie</option> 
                          
                                        <option value="1">Pagne</option>
                                        <option value="2">Robe en Dentelle</option>
                                        <option value="3">Robe en Brodérie</option>
                                        <option value="4">Robe en Soie</option>
                                        <option value="5">Chemise Lin et en Pagne</option>
                                        <option value="6">Tenue en soie</option>
                                    
                                         <option value="7">Babouche</option>
                                         <option value="8">Polo</option>
                                         <option value="9">Fantaisie</option>
                                         <option value="10">Chaînette</option>
                                         <option value="11">Boucle d Oreille</option>
                                         <option value="12">Sacs</option>
                                                                
                                  
                                         <option value="13">Chaussure Homme</option>
                                         <option value="14">Perpette Homme</option>
                                         <option value="15">Chemise</option>
                                         <option value="16">Ceinture</option>
                                         <option value="17">Cravate</option>
                                         <option value="18">Noeud</option>
                                         <option value="19">Chaussure Dame</option>
                                         <option value="20">Sacs</option>

                                        <option value="21">Sandale Jour et Soirée</option>
                                                                
                                
                                      
                                        <option value="22">Draps</option>
                                        <option value="23">Rideau</option>
                                        <option value="24">Couvre lit</option>
                                        <option value="25">Essuie Corps</option>
                                        <option value="26">Electroménager</option>

                        </select>

                      </div>
                    </div>
          


              <div class="col-6">
                <div class="form-group">
                  <input class="form-control" name="imagemini" id="imagemini" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Entrez l URL ou le nom de mini-image'" placeholder='Entrez l URL ou le nom de mini-image'>
                </div>
              </div>



              <div class="col-sm-6">
                <div class="form-group">
                    <select class="form-select" name="isvalid">
                      <option value="" disabled selected hidden>      Produit disponible en stock    </option>
                      <option value="1">Oui</option>
                      <option value="0">Non</option>
                
                    </select>
                  </div>
              </div>
              
              <div class="col-12">
                <div class="form-group">

                  <textarea class="form-control w-100" name="description" id="description" cols="30" rows="9"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'La description du produit'"
                    placeholder='La description du produit'></textarea>
                </div>
              </div>

            </div>
            <div class="form-group mt-3">
              <!-- <a href="#" class="btn_3 button-contactForm">Ajouter nouveau produit</a> -->
                <div class="d-flex justify-content-end mt-3">
                  <input class="btn_3 button-contactForm" type="submit" name="btn_ajouter" value="Ajouter nouveau produit">
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>


                <!-- ================== Code php d'insertion dans la bd =======================-->



                <?php

                      
                      
                        if($_SERVER["REQUEST"] === "POST" && isset($_POST['btn_ajouter'])){
                          try {

                            // Récupération des données du formulaire
                            $nompro = $_POST['nompro'];
                            $prix = $_POST['prix'];
                            $quantite = $_POST['quantite'];
                            $categorie = $_POST['categorie']; 

                            //On récupère ici la valeur à insérer à comme clé étrangère de catégorie 
                              $valcategorie = 0; 
                            if($categorie == "1"){
                              $valcategorie = 1; 
                            } else if($categorie == "2"){
                              $valcategorie = 2; 
                            }else if($categorie == "3"){
                              $valcategorie = 3; 
                            }else if($categorie == "4"){
                              $valcategorie = 4; 
                            }


                            $image = $_POST['image'];
                            $image = "../img/product/".$image; 

                            $val_sous_categorie = 0;
                            $sous_categorie = $_POST['sous_categorie']; 
                            $val_sous_categorie = intval($sous_categorie); 

                            $imagemini = $_POST['imagemini']; 
                            $isvalid = $_POST['isvalid']; 
                            $isvalid = intval($isvalid); 
                            $description = $_POST['description'];

                            // Insertion du produit dans la table "produit"
                             // Préparation de la requête d'insertion
                            $stmt = $pdo->prepare("INSERT INTO produits(nompro, prix, quantite, description, id_sc, image, isvalid, imagemini) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                            // Exécution de la requête avec les valeurs
                            $stmt->execute([$nompro, $prix, $quantite, $description, $val_sous_categorie, $image, $isvalid, $imagemini]);
                            echo "Le produit a été créé avec succès !";
                          } catch (PDOException $e) {
                            die('Erreur de connexion à la base de données : ' . $e->getMessage());
                          }
                        
                          // Fermeture de la connexion à la base de données
                          $pdo = null;
                        } 
                        else{
                          echo "non non!";
                        }

  ?>








  <!--::footer_part start::-->
  <?php
    require_once "../config/include/footer.php";
  ?>



  <!--::footer_part end::-->

  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="../js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="../js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="../js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="../js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="../js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="../js/slick.min.js"></script>
  <script src="../js/jquery.counterup.min.js"></script>
  <script src="../js/waypoints.min.js"></script>
  <script src="../js/contact.js"></script>
  <script src="../js/jquery.ajaxchimp.min.js"></script>
  <script src="../js/jquery.form.js"></script>
  <script src="../js/jquery.validate.min.js"></script>
  <script src="../js/mail-script.js"></script>
  <script src="../js/stellar.js"></script>
  <script src="../js/price_rangs.js"></script>
  <!-- custom js -->
  <script src="../js/custom.js"></script>
</body>

</html>