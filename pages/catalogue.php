<?php
    // Session_start();

    /* if(!isset($_SESSION["user"])){
        header("Location: ./login.php");
        exit;
    } */
    if(isset($_GET['ID'])){
        $cats = $_GET["ID"];
    }
    if(isset($_GET["IDsc"])){
        $scats = $_GET["IDsc"];
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
    <title>aranoz</title>
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
                            <h2>Store </h2>
                            <p>Home <span>-</span> Store </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

        <!-- product_list part start-->
        <section class="product_list best_seller mt-5">
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>

                            <div class="widgets_inner">
                                <ul class="list">
                                    <?php
                                        $catstmt = $pdo->prepare($cat);
                                        $catstmt->execute();

                                        while($ctg = $catstmt->fetch()){
                                    ?>
                                    <li>
                                        <a href="catalogue.php?<?php echo 'ID='.$ctg['category'];?>"><?php echo $ctg["nom_categorie"]; ?></a>
                                        <span>(<?php echo $ctg["somme_quantite"]; ?>)</span>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Product filters</h3>
                            </div>
                            <div class="widgets_inner">
                            <ul class="list">
                                    <?php
                                        $catstmt = $pdo->prepare($scat);
                                        $catstmt->execute();

                                        while($sctg = $catstmt->fetch()){
                                    ?>
                                    <li>
                                        <a href="catalogue.php?<?php echo 'IDsc='.$sctg['id_sc'];?>"><?php echo $sctg["sous_nom"]; ?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <!--
                                    <ul class="list">
                                    <li>
                                        <a href="#">Apple</a>
                                    </li>
                                    <li>
                                        <a href="#">Asus</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">Gionee</a>
                                    </li>
                                    <li>
                                        <a href="#">Micromax</a>
                                    </li>
                                    <li>
                                        <a href="#">Samsung</a>
                                    </li>
                                    </ul>
                                -->
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Color Filter</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li>
                                        <a href="#">Black</a>
                                    </li>
                                    <li>
                                        <a href="#">Black Leather</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">Black with red</a>
                                    </li>
                                    <li>
                                        <a href="#">Gold</a>
                                    </li>
                                    <li>
                                        <a href="#">Spacegrey</a>
                                    </li>
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets price_rangs_aside">
                            <div class="l_w_title">
                                <h3>Price Filter</h3>
                            </div>
                            <div class="widgets_inner">
                                <div class="range_item">
                                    <!-- <div id="slider-range"></div> -->
                                    <input type="text" class="js-range-slider" value="" />
                                    <div class="d-flex">
                                        <div class="price_text">
                                            <p>Price :</p>
                                        </div>
                                        <div class="price_value d-flex justify-content-center">
                                            <input type="text" class="js-input-from" id="amount" readonly />
                                            <span>to</span>
                                            <input type="text" class="js-input-to" id="amount" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span><?php if($countprod["COUNT(*)"] != 0){ echo $countprod["COUNT(*)"]; } ?></span> Prodict Found</p>
                                </div>
                                <div class="single_product_menu d-flex">
                                    <h5>short by : </h5>
                                    <select>
                                        <option data-display="Select">name</option>
                                        <option value="1">price</option>
                                        <option value="2">product</option>
                                    </select>
                                </div>
                                <div class="single_product_menu d-flex">
                                    <h5>show :</h5>
                                    <div class="top_pageniation">
                                        <ul>
                                            <li>1</li>
                                            <li>2</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="text" class="form-control" placeholder="search"
                                                aria-describedby="inputGroupPrepend" name="search"> 
                                        </form>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center latest_product_inner">
                        <?php
                        
                            if(isset($cats)){
                                $pdopro = $pdo->prepare($selecat.$cats);
                                $pdopro->execute(); 
                            }
                            elseif(isset($scats)){
                                $pdopro = $pdo-> prepare($prod1.$scats);
                                $pdopro -> execute();
                            }
                            else{
                                $pdopro = $pdo->prepare($prod);
                                $pdopro->execute();
                            }
                            while($produit = $pdopro->fetch()){
                        ?>
                            
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <a class="" href="single-product.php?<?php echo 'idpro='.$produit['idpro'];?>">
                                    <img src="<?php echo $produit["image"];?>" alt="">
                                </a>
                                <div class="single_product_text">
                                    <h4><?php echo $produit["nompro"];?></h4>
                                    <h3><?php echo "$ ".$produit["prix"];?></h3>
                                    <a href="../config/backend/back.php?<?php echo ' idpro='.$produit['idpro'];?>" class="add_cart">+ add to cart<i class="ti-heart"></i></a>
                                </div>
                            </div> 
                        </div>
                        <?php   } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!-- product_list part end-->

    <!--::footer_part start::-->
    <?php 
        require_once "../config/include/footer.php";
    ?>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
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