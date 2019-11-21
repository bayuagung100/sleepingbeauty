<!DOCTYPE html>
<html lang="en">
<?php $sesi = session_id(); ?>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo $set['url']; ?>images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $set['url']; ?>css/main.css">
    <!--===============================================================================================-->
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style>
        .carousel {
            background: #EEE;
        }

        .carousel img {
            display: block;
            height: 200px;
            margin-right: 10px;
        }

        @media screen and (min-width: 768px) {
            .carousel img {
                height: 400px;
            }
        }
    </style>
</head>

<body class="animsition">
    <!-- Header -->

    <header <?php if ($content == "home") { } else {
                echo 'class="header-v4"';
            } ?>>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        #SleepingBeauty
                    </div>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            My Account
                        </a>
                    </div>
                </div>
            </div>

            <div <?php if ($content == "home") {
                        echo 'class="wrap-menu-desktop"';
                    } else {
                        echo 'class="wrap-menu-desktop how-shadow1"';
                    } ?>>
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="<?php echo $set['url']; ?>" class="logo">
                        <img src="" alt="Logo">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">

                            <li <?php if ($content == "home") {
                                    echo 'class="active-menu"';
                                } else { } ?>>
                                <a href="<?php echo $set['url']; ?>">Home</a>
                            </li>

                            <li <?php if ($content == "product") {
                                    echo 'class="active-menu"';
                                } else { } ?>>
                                <a href="<?php echo $set['url']; ?>product">Shop <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="sub-menu">
                                    <?php
                                    $Category = $mysqli->query("SELECT * FROM category_product");
                                    while ($data = $Category->fetch_array()) {
                                        $id = $data['id'];
                                        $url = $data['category_url'];
                                        $name = $data['category_name'];
                                        $icon = $data['category_icon'];

                                        echo '
                                    
                                        <li><a href="' . $set['url'] . 'category/' . $url . '">' . $name . '</a></li>
                                    
                                    ';
                                    }
                                    ?>
                                </ul>
                            </li>

                            <!-- <li <?php if ($content == "best-seller") {
                                            echo 'class="active-menu label1"';
                                        } else {
                                            echo 'class="label1"';
                                        } ?> data-label1="hot">
                                <a href="<?php echo $set['url']; ?>best-seller">Best Seller</a>
                            </li>

                            <li <?php if ($content == "contact") {
                                    echo 'class="active-menu"';
                                } else { } ?>>
                                <a href="<?php echo $set['url']; ?>contact">Contact</a>
                            </li> -->
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                        <?php
                        $dncart = $mysqli->query("SELECT COUNT(*) as total FROM temp_cart WHERE id_session='$sesi'");
                        $dn = mysqli_fetch_assoc($dncart);
                        ?>
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $dn['total']; ?>">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <!-- <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a> -->
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="<?php echo $set['url']; ?>"><img src="" alt="Logo"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="0">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <!-- <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a> -->
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        #SleepingBeauty
                    </div>
                </li>
                <li>
                    <div class="right-top-bar flex-w h-full">
                        <!-- <a href="#" class="flex-c-m p-lr-10 trans-04">
                            Help & FAQs
                        </a> -->
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            My Account
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="<?php echo $set['url']; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo $set['url']; ?>product">Shop</a>
                    <ul class="sub-menu-m">
                        <?php
                        $Category = $mysqli->query("SELECT * FROM category_product");
                        while ($data = $Category->fetch_array()) {
                            $id = $data['id'];
                            $url = $data['category_url'];
                            $name = $data['category_name'];
                            $icon = $data['category_icon'];

                            echo '
                            <li><a href="#">' . $name . '</a></li>
                            ';
                        }
                        ?>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                <!-- <li>
                    <a href="<?php echo $set['url']; ?>best-seller" class="label1 rs1" data-label1="hot">Best Seller</a>
                </li>
                <li>
                    <a href="<?php echo $set['url']; ?>contact">Contact</a>
                </li> -->
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <?php
                $total = 0;
                $yourcartquery = $mysqli->query("SELECT * FROM temp_cart WHERE id_session='$sesi' ");
                $ceking = mysqli_num_rows($yourcartquery);

                if ($ceking > 0) {
                    echo '<ul class="header-cart-wrapitem w-full">';
                    while ($yourcart = $yourcartquery->fetch_array()) {
                        $idcart = $yourcart['id'];
                        $idproductcart = $yourcart['id_product'];
                        $sesicart = $yourcart['id_session'];
                        $sizecart = $yourcart['size'];
                        $colorcart = $yourcart['color'];
                        $qtycart = $yourcart['qty'];
                        $datecart = $yourcart['date'];

                        $productquery = $mysqli->query("SELECT * FROM product WHERE id='$idproductcart' ");
                        while ($data = $productquery->fetch_array()) {
                            $id = $data['id'];
                            $url = $data['product_url'];
                            $nama = $data['product_name'];
                            $harga = $data['product_price'];
                            $ukuran = $data['product_size'];
                            $warna = $data['product_color'];
                            $pic1 = $data['product_image1'];
                            if ($pic1 != "") {
                                $gambar1 = $set['url'] . "images/source/" . $pic1;
                            } else {
                                $gambar1 = $set['url'] . "images/icons/no-image.png";
                            }

                            $it = $qtycart * $harga;
                            $total += $it;

                            echo '
                                <li class="header-cart-item flex-w flex-t m-b-12">
                                    <div class="header-cart-item-img">
                                        <img src="' . $gambar1 . '" alt="' . $nama . '">
                                    </div>
    
                                    <div class="header-cart-item-txt p-t-8">
                                        <a href="' . $set['url'] . 'product/' . $url . '" class="header-cart-item-name hov-cl1 trans-04">
                                            ' . $nama . '
                                        </a>
    
                                        <span class="header-cart-item-info">
                                            Size: ' . $sizecart . '
                                        </span>
                                        <span class="header-cart-item-info">
                                            Color: ' . $colorcart . '
                                        </span>
                                        <span class="header-cart-item-info">
                                            Qty: ' . $qtycart . ' x ' . rupiah($harga) . '
                                        </span>
                                    </div>
                                </li>
                                ';
                        }
                    }
                    echo '</ul>';

                    echo '
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: ' . rupiah($total) . '
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="' . $set['url'] . 'cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                View Cart / CheckOut
                            </a>
                        </div>
                    </div>
                    ';
                } else {
                    echo '
                    <p>Your cart is empty :(</p>
                    ';
                }
                ?>



            </div>
        </div>
    </div>