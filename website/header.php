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
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $set['url']; ?>css/dataTables.bootstrap4.css">
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
                        <a href="<?php echo $set['url']; ?>member" class="flex-c-m trans-04 p-lr-25">
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
                        <img src="<?php echo $set['url']; ?>images/icons/sb-logo.jpg" alt="Logo">
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

                            <li <?php if ($content == "konfirmasi-pembayaran") {
                                    echo 'class="active-menu"';
                                } else { } ?>>
                                <a href="<?php echo $set['url']; ?>konfirmasi-pembayaran">Konfirmasi Pembayaran</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                        <?php
                        // $dncart = $mysqli->query("SELECT COUNT(*) as total FROM temp_cart WHERE id_session='$sesi'");
                        // $dn = mysqli_fetch_assoc($dncart);
                        ?>
                        <div id="count_cart" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="">
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
                <a href="<?php echo $set['url']; ?>"><img src="<?php echo $set['url']; ?>images/icons/sb-logo.jpg" alt="Logo"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div id="count_cart_mobile" class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="0">
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
                        <a href="<?php echo $set['url']; ?>member" class="flex-c-m p-lr-10 trans-04">
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
                <li>
                    <a href="<?php echo $set['url']; ?>konfirmasi-pembayaran">Konfirmasi Pembayaran</a>
                </li>
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

            <div id="cart" class="header-cart-content flex-w js-pscroll">
            </div>
        </div>
    </div>