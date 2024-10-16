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

<header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img src="../img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link " href="catalogue.php">
                                        Shop
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Catégories
                                    </a>
                                    <div class="row">
                                    <div class="dropdown-menu row" aria-labelledby="navbarDropdown_2">
                                        <?php $menustmt = $pdo -> prepare($smenu);
                                              $menustmt -> execute(); 
                                              
                                              while($menu = $menustmt -> fetch()){
                                              ?>
                                        <a class="dropdown-item" href="catalogue.php?<?php echo 'ID='.$menu['category'];?>"> <?php echo $menu['nomcat'];?> </a>
                                        <?php } ?>
                                    </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_2"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="blog.html"> blog</a>
                                        <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                    </div>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            <a id="search_1" href="javascript:void(0)"><i class="fas fa-search"></i></a>
                            <a href=""><i class="ti-heart"></i></a>
                            <div class="<?php if($counter["COUNT(*)"] != 0){ echo "cart"; }?>">
                                <a href="panier.php">
                                    <i class="fas fa-cart-plus"></i>
                                </a>
                                <!-- 
                                    <a class="dropdown-toggle" href="cart.php" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cart-plus"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <div class="single_product">
        
                                        </div>
                                    </div> 
                                -->
                            </div>
                            <a href="#">
                                <?php
                                    if(isset($_SESSION["user"])){
                                        echo '<i class="fas fa-user"></i>';
                                    }
                                ?>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>