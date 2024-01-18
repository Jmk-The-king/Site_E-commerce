<?php
    Session_start();

    if(!isset($_SESSION["user"]) ){
        header("Location: ./login.php");
        exit;
    }
    $idpro = $_GET["idpro"];
     
    require_once "../config/backend/backend.php";
    $pdo = new Connect();

?>
<!doctype html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>aranoz</title>
  <link rel="icon" href="../img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/css1/slick.css" />
	<link type="text/css" rel="stylesheet" href="../css/css1/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/css1/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/css1/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/css1/style.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="../css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/lightslider.min.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="../css/all.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="../css/flaticon.css">
  <link rel="stylesheet" href="../css/themify-icons.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="../css/magnific-popup.css">
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

  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Shop Single</h2>
              <p>Home <span>-</span> Shop Single</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->
  <!--================End Home Banner Area =================-->

  <?php
            $query = $query . $idpro;
            $pdostmt=$pdo->prepare($query);
            $pdostmt->bindParam(':code',$idpro);
            $pdostmt->execute();

            $produit=$pdostmt->fetch(PDO::FETCH_ASSOC);

            // $vustmt = $pdo->prepare($views);
            // $vustmt->execute(['code'=>$produit['code'],"view"=>$produit['vues']+1]);

            if($produit){

        ?>

  <!--================Single Product Area =================-->
  <div class="product_image_area section_padding">
    <div class="container">
      <div class="row s_product_inner justify-content-between product product-details clearfix">
        <div class="col-lg-6 col-xl-6">
          <div id="product-main-view">
            <div class="product-view">
              <img src="<?php echo $produit["miniature"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["miniature"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["miniature"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["miniature"]; ?>" alt="">
            </div>
          </div>
          <div id="product-view">
            <div class="product-view">
              <img src="<?php echo $produit["image"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["image"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["image"]; ?>" alt="">
            </div>
            <div class="product-view">
              <img src="<?php echo $produit["image"]; ?>" alt="">
            </div>
          </div>
          </div>
          <div class="col-lg-6 col-xl-5">
            <div class="s_product_text">
              <div class="product-label">
								<span>New</span> | 
								<span class="sale">-20%</span>
							</div>
              <h3><?php echo $produit['nom'];?></h3>
              <h2><?php echo $produit['prix'];?></h2>
              <div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<a href="#review">3 Review(s) / Add Review</a>
							</div>
              <ul class="list">
                <li>
                  <a class="active" href="#">
                    <span>Category</span> : <?php echo $produit['categorie'];?></a>
                </li>
                <li>
                  <a href="#"> <span>Availibility</span> : <?php $valid = ($produit['validity'])? "En stock" : "Stock epuié"; echo $valid;?></a>
                </li>
              </ul>
              <p>
                <?php echo $produit["description"]; ?>
              </p>
              <div class="product-options">
								<ul class="size-option">
									<li><span class="text-uppercase">Size:</span></li>
									<li class="active"><a href="#">S</a></li>
									<li><a href="#">XL</a></li>
									<li><a href="#">SL</a></li>
								</ul>
								<ul class="color-option">
									<li><span class="text-uppercase">Color:</span></li>
									<li class="active"><a href="#" style="background-color:#475984;"></a></li>
									<li><a href="#" style="background-color:#8A2454;"></a></li>
									<li><a href="#" style="background-color:#BF6989;"></a></li>
									<li><a href="#" style="background-color:#9A54D8;"></a></li>
								</ul>
							</div>
              <div class="card_area d-flex justify-content-between align-items-center">
                <div class="product_count">
                  <button class="inumber-decrement btn" name="btnDecrement"> <i class="ti-minus"></i></button>
                  <input class="input-number" type="text" value="1" min="0" max="10">
                  <button class="number-increment btn" name="btnIncrement"> <i class="ti-plus"></i></button>
                </div>
                <a href="../config/backend/back.php?<?php echo ' idpro='.$idpro;?>" class="btn_3">add to cart</a>
                <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->

  <?php }
          else{
            echo 'produit non trouvé !';
          }
        ?>

  <!--================Product Description Area =================-->
  <section class="product_description_area">
    <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Specification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
            aria-selected="false">Comments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
            aria-selected="false">Reviews</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php echo $produit["description"]; ?>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <h5>Width</h5>
                  </td>
                  <td>
                    <h5>128mm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Height</h5>
                  </td>
                  <td>
                    <h5>508mm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Depth</h5>
                  </td>
                  <td>
                    <h5>85mm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Weight</h5>
                  </td>
                  <td>
                    <h5>52gm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Quality checking</h5>
                  </td>
                  <td>
                    <h5>yes</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Freshness Duration</h5>
                  </td>
                  <td>
                    <h5>03days</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>When packeting</h5>
                  </td>
                  <td>
                    <h5>Without touch of hand</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Each Box contains</h5>
                  </td>
                  <td>
                    <h5>60pcs</h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="row">
            <?php
                $comment0 = $comment . $idpro ." LIMIT 3";
                $stmtcom = $pdo -> prepare($comment0);
                $stmtcom -> execute();

                while($com = $stmtcom -> fetch()){
            ?>
            <div class="col-lg-6">
              <div class="comment_list">
                <div class="review_item">
                  <div class="media">
                    <div class="d-flex">
                      <img src="../img/product/single-product/review-1.png" alt="" />
                    </div>
                    <div class="media-body">
                      <h4><?php echo $com["nomcomplet"]; ?></h4>
                      <h5><?php echo $com["time"]; ?></h5>
                      <a class="reply_btn" href="#">Reply</a>
                    </div>
                  </div>
                  <p>
                    <?php echo $com["commentaire"]; ?>
                  </p>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="col-lg-6">
              <div class="review_box">
                <h4>Post a comment</h4>
                <form class="row contact_form" action="../config/backend/backend.php?<?php echo 'idpro='.$idpro;?>" method="post" id="contactForm"
                  novalidate="novalidate">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" id="message" rows="1"
                        placeholder="Message"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 text-right">
                      <input type="submit" class="btn_3" id="submit" name="submit" value="Submit now"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
          <div class="row">
            <div class="col-lg-6">
              <div class="row total_rate">
                <div class="col-6">
                  <div class="box_total">
                    <h5>Overall</h5>
                    <h4>4.0</h4>
                    <h6>(03 Reviews)</h6>
                  </div>
                </div>
                <div class="col-6">
                  <div class="rating_list">
                    <h3>Based on 3 Reviews</h3>
                    <ul class="list">
                      <li>
                        <a href="#">5 Star
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> 01</a>
                      </li>
                      <li>
                        <a href="#">4 Star
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> 01</a>
                      </li>
                      <li>
                        <a href="#">3 Star
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> 01</a>
                      </li>
                      <li>
                        <a href="#">2 Star
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> 01</a>
                      </li>
                      <li>
                        <a href="#">1 Star
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> 01</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="review_list">
              <?php
                $comment1 = $comment . $idpro ." LIMIT 3";
                $stmtc = $pdo -> prepare($comment1);
                $stmtc -> execute();

                while($comm = $stmtc -> fetch()){
              ?>
                <div class="review_item">
                  <div class="media">
                    <div class="d-flex">
                      <img src="../img/product/single-product/review-1.png" alt="" />
                    </div>
                    <div class="media-body">
                      <h4><?php echo $comm["nomcomplet"]; ?></h4>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                  </div>
                  <p>
                    <?php echo $comm["commentaire"]; ?>
                  </p>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="review_box">
                <h4>Add a Review</h4>
                <p>Your Rating:</p>
                <ul class="list">
                  <li>
                    <a href="#">
                      <i class="fa fa-star"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-star"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-star"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-star"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-star"></i>
                    </a>
                  </li>
                </ul>
                <p>Outstanding</p>
                <form class="row contact_form" action="../config/backend/backend.php?<?php echo 'idpro='.$idpro;?>" method="post" novalidate="novalidate">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="name" placeholder="Your Full name" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email Address" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="number" placeholder="Phone Number" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" rows="1" placeholder="Review"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 text-right">
                      <input type="submit" class="btn_3" id="submit" name="submit" value="Submit now"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Product Description Area =================-->

  <!-- product_list part start-->
  <section class="product_list best_seller">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section_tittle text-center">
            <h2>Best Sellers <span>shop</span></h2>
          </div>
        </div>
      </div>
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-12">
          <div class="best_product_slider owl-carousel">
          <?php  
                $pdopro = $pdo->prepare($prod2);
                $pdopro->execute();

                while($produit = $pdopro->fetch()){
            ?>
            <a class="" href="single-product.php?<?php echo 'idpro='.$produit['idpro'];?>">
                <div class="single_product_item">
                    <img src="<?php echo $produit["image"];?>" alt="">
                    <div class="single_product_text">
                        <h4><?php echo $produit["nompro"];?></h4>
                        <h3><?php echo "$ ".$produit["prix"];?></h3>
                    </div>
                </div>
            </a>
          <?php }?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product_list part end-->

  <!--::footer_part start::-->
  <?php 
        require_once "../config/include/footer.php";
    ?>
  <!--::footer_part end::-->

  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="../js/js1/jquery.min.js"></script>
	<script src="../js/js1/slick.min.js"></script>
	<script src="../js/js1/nouislider.min.js"></script>
	<script src="../js/js1/jquery.zoom.min.js"></script>
	<script src="../js/js1/main.js"></script>
  <script src="../js/js1/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="../js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="../js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="../js/lightslider.min.js"></script>
  <!-- swiper js -->
  <script src="../js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="../js/swiper.jquery.js"></script>
  <script src="../js/jquery.counterup.min.js"></script>
  <script src="../js/waypoints.min.js"></script>
  <script src="../js/contact.js"></script>
  <script src="../js/jquery.ajaxchimp.min.js"></script>
  <script src="../js/jquery.form.js"></script>
  <script src="../js/jquery.validate.min.js"></script>
  <script src="../js/mail-script.js"></script>
  <script src="../js/stellar.js"></script>
  <!-- custom js -->
  <script src="../js/theme.js"></script>
  <script src="../js/custom.js"></script>
</body>

</html>