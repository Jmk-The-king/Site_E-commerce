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
  <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>

            <?php 
              
            ?>

            <tbody>
            <?php
              $panstmt = $pdo -> prepare($paniers);
              $panstmt -> execute();
              $subtotal = 0;

              while($prodpanier = $panstmt -> fetch()){
                $prodstmt = $pdo -> prepare($panier.$prodpanier['idpro']);
                $prodstmt -> execute ();

                $prodpan = $prodstmt -> fetch(PDO::FETCH_ASSOC);
            ?>
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img style="width: 100px;" src="<?php echo $prodpan["image"]; ?>" alt="" />
                    </div>
                    <div class="media-body">
                      <p><?php echo $prodpan["nompro"]; ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5><?php echo $prodpan["prix"]; ?></h5>
                </td>
                <td>
                  <div class="product_count">
                    <form method="post" action="">
                      <button class="input-number-decrement btn" name="btnDecrement"> <i class="ti-angle-down"></i></button>
                      <input class="input-number" type="text" value="<?php echo $prodpanier["qte"]; ?>" min="0" max="100" name="qte" id="qte">
                      <button class="input-number-increment btn" name="btnIncrement"> <i class="ti-angle-up"></i></button>
                    </form>
                  </div>
                </td>
                <td>
                  <h5><?php 
                    $total = $prodpan["prix"] * $prodpanier["qte"];
                    echo $total;
                    $subtotal = $subtotal + $total;
                  ?></h5>
                </td>
              </tr>
              <?php } ?>
         
              <tr class="bottom_button">
                <td>
                  <a class="btn_1" href="../config/backend/back.php">Update Cart</a>
                </td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5>$<?php echo $subtotal; ?></h5>
                </td>
              </tr>
              <tr class="shipping_area">
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
                <td>
                  <div class="shipping_box">
                    <ul class="list">
                      <li>
                        <a href="#">Flat Rate: $5.00</a>
                      </li>
                      <li>
                        <a href="#">Free Shipping</a>
                      </li>
                      <li>
                        <a href="#">Flat Rate: $10.00</a>
                      </li>
                      <li class="active">
                        <a href="#">Local Delivery: $2.00</a>
                      </li>
                    </ul>
                    <h6>
                      Calculate Shipping
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </h6>
                    <select class="shipping_select">
                      <option value="1">Bangladesh</option>
                      <option value="2">India</option>
                      <option value="4">Pakistan</option>
                    </select>
                    <select class="shipping_select section_bg">
                      <option value="1">Select a State</option>
                      <option value="2">Select a State</option>
                      <option value="4">Select a State</option>
                    </select>
                    <input type="text" placeholder="Postcode/Zipcode" />
                    <a class="btn_1" href="#">Update Details</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="category.php">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="#">Proceed to checkout</a>
          </div>
        </div>
      </div>
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