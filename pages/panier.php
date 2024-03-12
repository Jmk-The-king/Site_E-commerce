<?php require_once "../config/backend/traitement.php"; ?>
<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Commande</title>
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
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/modal1.css">

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
  <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $somme = 0;
                $seReq = $pdo->query($paniers);
                while($r=$seReq->fetch()){
                  $prodstmt = $pdo -> prepare($panier.$r['idpan']);
                  $prodstmt -> execute ();
                  
                  $prodpan = $prodstmt -> fetch(PDO::FETCH_ASSOC);
                  $client[] = $prodpan;
                }
                $i = 0;
                foreach($client as $c):?>
              <?php 
                $i += 1;
                $_SESSION['idModif'] = $c['idpro']; 
              ?>
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="<?php echo $c['image'];?>" alt="" width="100px">
                    </div>
                    <div class="media-body">
                      <p><?php echo $c['nompro'];?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5><?php echo $c['prix'];?></h5>
                </td>
                <td>
                  <h5 style="margin-left:25px;"><?php echo $c['qte']; ?></h5>
                </td>
                <td>
                  <h5>
                    <?php 
                      $total = ($c['prix'] * $c['qte']);
                      $somme += $total; 
                      echo $total;
                    ?>
                  </h5>
                </td>
                <td>
                  <div class="product_count">
                    <form method="post">
                      <button type = "submit" button onclick="window.location.href = '#demo1';" name="idProduit" value="<?php echo $c['idpan']; ?>"
                      style="border:none; background-color:#fff; color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                        </svg>
                      </button>
                    </form>
                  </div>
                  <div class="product_count">
                    <form method="post" action="../config/backend/traitement.php">
                      <button type = "submit" name="supprimer" value="<?php echo $c['idpro']; ?>"
                        style="border:none; background-color:#fff; margin-left:20px; color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
                <?php endforeach; ?>
              </tr>                     
            </tbody>
          </table>
          <p style="margin-left:76%; font-weight: bold;color: gray; font-size:14px;"><span style="color:red;">Total : </span><?php echo $somme;?>$</p>
        </div>
      </div>
      <div class="valider" style="margin-left:40%;">
        <a  href="#demo" class="my-button" id="openModal"
        style = "display: inline-block;
        padding: 10px 20px;
        background-color: white;
        color: #3498db;
        text-align: center;
        text-decoration: none;
        border: 2px #3498db solid;
        border-radius: 5px;
        font-size:16px;
        font-weight:bold;
        transition: background-color 0.3s;"
        onmouseover="this.style.backgroundColor='#3498db', this.style.color='white'" 
        onmouseout="this.style.backgroundColor='white', this.style.color='#3498db'">
          Passer Commande
        </a>
      </div>

      <!--================Fenetre modale de compte=================-->
      <div id="demo" class="modal">
        <div class="modal_content" style="margin:16% auto 0 auto; height: 325px;">
          <div class="title_modal">
            <h1 style="text-align:center; color: #3498db; font-size: 36px; margin-top: 2px; margin-bottom: 25px; font-family:'Courier New', Courier, monospace;">O'LA SALAMA</h1>
          </div>
          <div class="content_cont" style="text-align:center; margin-bottom:20px;">
            <p>Voulez-vous qu'on se souvienne de vous à vos prochains achats ?</p>
            <p>Il y aura des reductions</p>
            <p>Et autres avantages</p>
          </div>
          
          <div class="links" style="margin-top:20px; display:flex; justify-content:center;align-item:center;">
            <ul>
              <li><a href="login.php"
              style = "display: inline-block;
              padding: 5px 20px;
              background-color: white;
              color: #3498db;
              text-align: center;
              text-decoration: none;
              border: 2px #3498db solid;
              border-radius: 5px;
              font-size:16px;
              font-weight:bold;
              transition: background-color 0.3s;
              margin-bottom:5px;"
              onmouseover="this.style.backgroundColor='#3498db', this.style.color='white'" 
              onmouseout="this.style.backgroundColor='white', this.style.color='#3498db'"
              >
                SE CONNECTER
              </a></li>
            </ul>                
          </div>
          <div class="Contenaire-createCount" style="display:flex; justify-content:center;align-item:center;">
            <a href="signup" class="createCount"
            style = "display: inline-block;
              color: gray;
              text-decoration: none;
              font-size:16px;
              font-weight:bold;
              transition: color 0.3s;"
              onmouseover="this.style.color='#3498db'" 
              onmouseout="this.style.color='gray'"
            >
              Créer compte
            </a>
          </div>
          <a href="./formulaire.php" class="modal_close"
            style = "position: absolute;
            top: 5px;
            right: 10px;
            font-size: 20px;
            color: black;
            text-decoration: none;
            font-size:26px;
            font-weight:bold;"
          >
            &times;
          </a>
        </div>
      </div>

      <!-- Fenetre modale modif -->
    <?php
      if (isset($_POST['idProduit'])) {
        $idProduit = $_POST['idProduit']; 
    echo'<div id="demo1" class="modal1" style="position:fixed; z-index:9999;">
        <div class="modal_content1" style="margin:10% auto 0 auto; height: 430px;">
        <form action="../config/backend/traitement.php" method="POST">
          <div class="content_cont">        
            <div class="container">
              <div class="cart_inner">
                <div class="table-responsive" style="margin-top:15px;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>';
                      $somme = 0;
                      //$Req = $pdo->query($paniers);
                      //$r1=$Req->fetch(PDO::FETCH_ASSOC);
                        $prstmt = $pdo -> prepare($panier.$idProduit);
                        $prstmt -> execute ();
      
                        $com = $prstmt -> fetch(PDO::FETCH_ASSOC);
                        $client1[] = $com;
                      
                      $i = 0;
                      foreach($client1 as $c1):?>
                      <?php 
                        $i += 1;
                      ?>
                      <tr>
                        <td>
                          <div class="media">
                            <div class="d-flex">
                              <img src="<?php echo $c1['image'];?>" alt="" width="150px">
                            </div>
                            <div class="media-body">
                              <p><?php echo $c1['nompro'];?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <h5><?php echo $c1['prix'];?></h5>
                        </td>
                        <td>
                          <input type="text" name="quantite" id="quantite" style="font-size:16px; font-weight: bold; text-align:center; border-radius:10px; border:1px solid gray; width: 45px; height: 45px;" 
                            value ="<?php echo $c1["qte"];?>" 
                          >
                        </td>
                        <td>
                          <h5>
                            <?php 
                              $total1 = ($c1['prix'] * $c1["qte"]);
                              echo $total1;
                              $somme += $total1; 
                            ?>
                          </h5>
                        </td>
                        <?php endforeach; ?>
                      </tr>                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="valider" style="margin-left:40%;">
              <button type="submit" class="modifier" name="modifier" value="<?php echo $idProduit; ?>"
              style = "display: inline-block;
              padding: 10px 20px;
              background-color: white;
              color: #3498db;
              text-align: center;
              text-decoration: none;
              border: 2px #3498db solid;
              border-radius: 5px;
              font-size:16px;
              font-weight:bold;
              transition: background-color 0.3s;"
              onmouseover="this.style.backgroundColor='#3498db', this.style.color='white'" 
              onmouseout="this.style.backgroundColor='white', this.style.color='#3498db'"
              >MODIFIER
              </button>
              </form>
              <a href="" class="modal_close"
                style = "position: absolute;
                top: 5px;
                right: 20px;
                font-size: 20px;
                color: black;
                text-decoration: none;
                font-size:26px;
                font-weight:bold;"
                >
                &times;
              </a>
            </div>
          
        
        </div>
        </form>
        </div>
    </div>
      <?php } ?>
      <script>
        // JavaScript pour ouvrir/fermer la fenêtre modale
        const openModalButton = document.getElementById('openModal');
        const modal = document.getElementById('demo');
        const closeModalButton = modal.querySelector('.modal_close');

        openModalButton.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModalButton.addEventListener('click', () => {
            modal.style.display = 'none';
            window.location.href = "./formulaire.php";
        });
      </script>
    
      <script>
        // JavaScript pour ouvrir/fermer la fenêtre modale
        const openModalButton1 = document.getElementById('openModal1');
        const modal1 = document.querySelector('.modal1');
        const closeModalButton = modal.querySelector('.modal_close');
        
        openModalButton1.addEventListener('click', () => {
          modal1.style.display = 'block';
          body.style.backgroundColor= 'black';
        });

        closeModalButton.addEventListener('click', () => {
          modal.style.display = 'none';
          window.location.href = "./formulaire.html";
        });
      </script>
  </section>


  

      
    
  
  <!--================End Cart Area =================-->

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