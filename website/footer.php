<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <?php
                    $Category = $mysqli->query("SELECT * FROM category_product");
                    while ($data = $Category->fetch_array()) {
                        $id = $data['id'];
                        $url = $data['category_url'];
                        $name = $data['category_name'];
                        $icon = $data['category_icon'];

                        echo '
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            ' . $name . '
                            </a>
                        </li>
                        ';
                    }
                    ?>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Track Order
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Returns
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shipping
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at ...
                    or call us on (+62) 812xxxxxxxx
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <!-- <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
                </a>
            </div> -->

            <p class="stext-107 cl6 txt-center">
                <?php echo $set['title']; ?>
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved

            </p>
        </div>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Modal -->
<?php
$modal_query = $mysqli->query("SELECT * FROM product");
while ($mdata = $modal_query->fetch_array()) {
    $id = $mdata['id'];
    $url = $mdata['product_url'];
    $nama = $mdata['product_name'];
    $desc = $mdata['product_description'];
    $stok = $mdata['product_stock'];
    $harga = $mdata['product_price'];
    $berat = $mdata['product_weight'];
    $ukuran = $mdata['product_size'];
    $warna = $mdata['product_color'];
    $bahan = $mdata['product_material'];
    $kategori = $mdata['product_category'];
    $gambar1 = $mdata['product_image1'];
    $gambar2 = $mdata['product_image2'];
    $gambar3 = $mdata['product_image3'];
    $pic1 = $mdata['product_image1'];
    $pic2 = $mdata['product_image2'];
    $pic3 = $mdata['product_image3'];
    $pic4 = $mdata['product_image4'];
    $pic5 = $mdata['product_image5'];
    $pic6 = $mdata['product_image6'];
    if ($pic1 != "") {
        $gambar1 = $set['url'] . "images/source/" . $pic1;
    } else {
        $gambar1 = $set['url'] . "images/icons/no-image.png";
    }
    if ($pic2 != "") {
        $gambar2 = $set['url'] . "images/source/" . $pic2;
    } else {
        $gambar2 = $set['url'] . "images/icons/no-image.png";
    }
    if ($pic3 != "") {
        $gambar3 = $set['url'] . "images/source/" . $pic3;
    } else {
        $gambar3 = $set['url'] . "images/icons/no-image.png";
    }
    if ($pic4 != "") {
        $gambar4 = $set['url'] . "images/source/" . $pic4;
    } else {
        $gambar4 = $set['url'] . "images/icons/no-image.png";
    }
    if ($pic5 != "") {
        $gambar5 = $set['url'] . "images/source/" . $pic5;
    } else {
        $gambar5 = $set['url'] . "images/icons/no-image.png";
    }
    if ($pic6 != "") {
        $gambar6 = $set['url'] . "images/source/" . $pic6;
    } else {
        $gambar6 = $set['url'] . "images/icons/no-image.png";
    }

    echo '
    <div class="wrap-modal js-modal' . $id . ' p-t-60 p-b-20">
        <div class="overlay-modal js-hide-modal' . $id . '"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal' . $id . '">
                    <img src="images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3" data-thumb="' . $gambar1 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar1 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar1 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="' . $gambar2 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar2 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar2 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="' . $gambar3 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar3 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar3 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="' . $gambar4 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar4 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar4 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="' . $gambar5 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar5 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar5 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="' . $gambar6 . '">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="' . $gambar6 . '" alt="' . $nama . '">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' . $gambar6 . '">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                <span id="product' . $id . '">' . $nama . '</span>
                            </h4>

                            <span class="mtext-106 cl2">
                                ' . rupiah($harga) . '
                            </span>';

    if ($stok > 5) {
        echo '
                                <p class="stext-102 clgreen p-t-23">
                                    ' . $stok . ' stocks available
                                </p>
                                ';
    } elseif ($stok > 0 && $stok <= 5) {
        echo '
                                <p class="stext-102 clwarning p-t-23">
                                    ' . $stok . ' stocks available
                                </p>
                                ';
    } elseif ($stok == 0) {
        echo '
                                <p class="stext-102 cldanger p-t-23">
                                    Out of stocks
                                </p>
                                ';
    }
    echo '
                            <p class="stext-102 cl3 p-t-23">
                                ' . $desc . '
                            </p>

                            <!--  -->
                            <input id="ip' . $id . '" type="hidden" name="id" value="' . $id . '">
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select id="size' . $id . '" class="js-select2" name="size">
                                                <option value="">Pilih ukuran</option>
                                                ';
    $sizeid_query = $mysqli->query("SELECT * FROM product WHERE id='$id' ");
    while ($siddata = $sizeid_query->fetch_array()) {
        $product_size = $siddata['product_size'];
        $ex = explode(",", $product_size);
        $count = count($ex);
        for ($i = 0; $i < $count; $i++) {
            $idsize = $ex[$i];
            $query = $mysqli->query("SELECT * FROM size_product WHERE id='$idsize' ");
            $data = $query->fetch_array();
            $size_name = $data['size_name'];

            echo '
                                                        <option value="' . $size_name . '">' . $size_name . '</option>
                                                        ';
        }
    }
    echo '
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select id="color' . $id . '" class="js-select2" name="color">
                                                <option value="">Pilih warna</option>
                                                ';
    $colorid_query = $mysqli->query("SELECT * FROM product WHERE id='$id' ");
    while ($ciddata = $colorid_query->fetch_array()) {
        $product_color = $ciddata['product_color'];
        $ex = explode(",", $product_color);
        $count = count($ex);
        for ($i = 0; $i < $count; $i++) {
            $idsize = $ex[$i];
            $query = $mysqli->query("SELECT * FROM color_product WHERE id='$idsize' ");
            $data = $query->fetch_array();
            $color_name = $data['color_name'];

            echo '
                                                        <option value="' . $color_name . '">' . $color_name . '</option>
                                                        ';
        }
    }
    echo '
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>';
    if ($stok == 0) {
        echo '
                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="0" min="0" max="0">
                                                ';
    } else {
        echo '
                                                <input id="qty' . $id . '" class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="1" min="1" max="' . $stok . '">
                                                ';
    }
    echo '
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>';
    if ($stok == 0) {
        echo '
                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail' . $id . ' disabled" disabled>
                                                Add to cart
                                            </button>
                                            ';
    } else {
        echo '
                                            <button id="btn-add-to-cart" type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail' . $id . '">
                                                Add to cart
                                            </button>
                                            ';
    }

    echo '                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}
?>



<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo $set['url']; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/daterangepicker/moment.min.js"></script>
<script src="<?php echo $set['url']; ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/slick/slick.min.js"></script>
<script src="<?php echo $set['url']; ?>js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    // $('.js-addcart-detail').each(function() {
    //     // var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
    //     var product = $('#product').html();
    //     var price = $('#price').html();
    //     var id = $('#id').val();

    //     $(this).on('click', function() {
    //         $('.js-select2').change(function() {
    //             var size = $('.js-select2').val();
    //             console.log(size);
    //         });
    //         console.log(product);
    //         console.log(price);
    //         console.log(id);

    //         swal(product, "is added to cart !", "success");
    //     });
    // });
</script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="<?php echo $set['url']; ?>js/main.js"></script>

<script>
    $(document).ready(function() {

        // var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $('.js-addcart-detail').on('click', function() {
            var product = $('#product').html();
            // var price = $('#price').html();
            var ip = $('#ip').val();
            var size = $('#size').val();
            var color = $('#color').val();
            var qty = $('#qty').val();
            console.log(product);
            // console.log(price);
            console.log(ip);
            console.log(size);
            console.log(color);
            console.log(qty);
            if ((size == "") && (color == "")) {
                swal("Failed", product + " failed to add to cart, size and color not selected!", "error");
            } else if ((size == "")) {
                swal("Failed", "Size not selected!", "error");
            } else if ((color == "")) {
                swal("Failed", "Color not selected!", "error");
            } else if ((qty == 0)){
                swal("Failed", "Qty can not be empty!", "error");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $set['url']; ?>shop/add-to-cart.php',
                    data: {
                        'id': ip,
                        'size': size,
                        'color': color,
                        'qty': qty
                    },
                    success: function(html) {
                        swal("Success", product + " is added to cart!", "success");
                    }
                });
            }

        });
    });
</script>
<script>
    /*==================================================================
    [ Show modal1 ]*/
    <?php
    $jsmquery = $mysqli->query("SELECT * FROM product");
    while ($jsmdata = $jsmquery->fetch_array()) {
        $jsmid = $jsmdata['id'];
        ?>
        $('.js-addcart-detail<?php echo $jsmid; ?>').on('click', function() {
            var product = $('#product<?php echo $jsmid; ?>').html();
            var ip = $('#ip<?php echo $jsmid; ?>').val();
            var size = $('#size<?php echo $jsmid; ?>').val();
            var color = $('#color<?php echo $jsmid; ?>').val();
            var qty = $('#qty<?php echo $jsmid; ?>').val();
            if ((size == "") && (color == "")) {
                swal("Failed", product + " failed to add to cart, size and color not selected!", "error");
            } else if ((size == "")) {
                swal("Failed", "Size not selected!", "error");
            } else if ((color == "")) {
                swal("Failed", "Color not selected!", "error");
            } else if ((qty == 0)){
                swal("Failed", "Qty can not be empty!", "error");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $set['url']; ?>shop/add-to-cart.php',
                    data: {
                        'id': ip,
                        'size': size,
                        'color': color,
                        'qty': qty
                    },
                    success: function(html) {
                        swal("Success", product + " is added to cart!", "success");
                    }
                });
            }

        });
        $('.js-show-modal<?php echo $jsmid; ?>').on('click', function(e) {
            e.preventDefault();
            $('.js-modal<?php echo $jsmid; ?>').addClass('show-modal');
        });

        $('.js-hide-modal<?php echo $jsmid; ?>').on('click', function() {
            $('.js-modal<?php echo $jsmid; ?>').removeClass('show-modal');
        });
    <?php
    }
    ?>
</script>
<script>
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/count-cart.php',
                success: function(html) {
                    $('#count_cart').attr('data-notify', html);
                    $('#count_cart_mobile').attr('data-notify', html);
                }
            });
        }, 1000);
    });
</script>
<script>
    $(document).ready(function() {
        $('#cart').load('<?php echo $set['url']; ?>ajax/list-cart.php');
    });
    $(document).ready(function() {
        $(document).on('click', '#btn-add-to-cart', function() {
            $('#cart').load('<?php echo $set['url']; ?>ajax/list-cart.php');
        });
    });
</script>
<script>
    <?php
    $delquery = $mysqli->query("SELECT * FROM product");
    while ($deldata = $delquery->fetch_array()) {
        $delid = $deldata['id'];
        ?>
        $('#del-cart<?php echo $delid; ?>').on('click', function() {
            var ip = <?php echo $delid; ?>;
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/remove-cart.php',
                data: 'id=' + ip,
                success: function(html) {
                    swal("Success", "Product is removed from cart!", "success");
                    window.location = "<?php echo $set['url']; ?>cart";
                }
            });
        });
        $('#min-product<?php echo $delid; ?>').on('click', function() {
            var ip = <?php echo $delid; ?>;
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/min-cart.php',
                data: 'id=' + ip,
                success: function(html) {
                    window.location = "<?php echo $set['url']; ?>cart";
                }
            });
        });
        $('#plus-product<?php echo $delid; ?>').on('click', function() {
            var ip = <?php echo $delid; ?>;
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/plus-cart.php',
                data: 'id=' + ip,
                success: function(html) {
                    window.location = "<?php echo $set['url']; ?>cart";
                }
            });
        });
    <?php } ?>
</script>
<script>
    $(document).ready(function() {
        $('#daftar_provinsi').change(function() {

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var province_id = $('#daftar_provinsi').val();
        var province = $('#daftar_provinsi option:selected').attr('province');
        console.log(province_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/member/cek-kabupaten.php',
                data: {
                    'province_id': province_id,
                    'province': province
                },
                success: function(data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#daftar_kabupaten").html(data);
                }
            });
        });
        $('#daftar_kabupaten').change(function() {

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var city_id = $('#daftar_kabupaten').val();
        var city_name = $('#daftar_kabupaten option:selected').attr('city_name');
            console.log(city_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/member/cek-kecamatan.php',
                data: {
                    'city_id': city_id,
                    'city_name': city_name
                },
                success: function(data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#daftar_kecamatan").html(data);
                }
            });
        });
        $('#provinsi').change(function() {

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var province_id = $('#provinsi').val();
            var province = $('#provinsi option:selected').attr('province');
            console.log(province_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/rajaongkir/cek-kabupaten.php',
                data: {
                    'province_id': province_id,
                    'province': province
                },
                success: function(data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#kabupaten").html(data);
                }
            });
        });
        $('#kabupaten').change(function() {

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var city_id = $('#kabupaten').val();
            var city_name = $('#kabupaten option:selected').attr('city_name');

            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/rajaongkir/cek-kecamatan.php',
                data: {
                    'city_id': city_id,
                    'city_name': city_name
                },
                success: function(data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#kecamatan").html(data);
                }
            });
        });
        $('#ekspedisi').change(function() {

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var subdistrict_id = $('#kecamatan').val();
            var subdistrict_name = $('#kecamatan option:selected').attr('subdistrict_name');
            var courier = $('#ekspedisi').val();
            var weight = $('#weight').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>ajax/rajaongkir/cek-ongkir.php',
                data: {
                    'subdistrict_id': subdistrict_id,
                    'subdistrict_name': subdistrict_name,
                    'courier': courier,
                    'weight': weight
                },
                success: function(data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#list-ekspedisi").html(data);
                }
            });
        });
        $('#list-ekspedisi').on("change", function() {
            var ongkir = $('#list-ekspedisi input:checked').attr('price');
            var subtotal = $('#subtotal').val();
            var grandttl = parseInt(subtotal) + parseInt(ongkir);
            var reverse = grandttl.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
            document.getElementById('grand-total').innerText = "Rp " + ribuan;
        });
        $('#buat-pesanan').on('click', function() {
            var sesi = $('#sesi').val();
            var id_pesanan = $('#id_pesanan').val();
            var id_user = $('#id_user').val();
            var subtotal = $('#subtotal').val();
            var weight = $('#weight').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var tel = $('#tel').val();
            var address= $('#address').val();
            var province = $('#provinsi option:selected').attr('province');
            var kabupaten = $('#kabupaten option:selected').attr('city_name');
            var kecamatan = $('#kecamatan option:selected').attr('subdistrict_name');
            var postcode = $('#postcode').val();
            var ekspedisi = $('#ekspedisi').val();
            var service = $('#list-ekspedisi input:checked').val();
            var payment_method = $('#payment-method input:checked').val();

            if ((name == "")) {
                swal("Failed", "Nama tidak boleh kosong!", "error");
            } else if ((email == "")) {
                swal("Failed", "Email tidak boleh kosong!", "error");
            } else if ((tel == "")) {
                swal("Failed", "No Hp tidak boleh kosong!", "error");
            } else if ((address == "")) {
                swal("Failed", "Alamat tidak boleh kosong!", "error");
            } else if ((province == null)) {
                swal("Failed", "Provinsi tidak boleh kosong!", "error");
            } else if ((kabupaten == null)) {
                swal("Failed", "Kota / Kabupaten  tidak boleh kosong!", "error");
            } else if ((kecamatan == null)) {
                swal("Failed", "Kecamatan  tidak boleh kosong!", "error");
            } else if ((postcode == "")) {
                swal("Failed", "Kode Pos tidak boleh kosong!", "error");
            } else if ((ekspedisi == "")) {
                swal("Failed", "Ekspedisi tidak boleh kosong!", "error");
            } else if ((service == null)) {
                swal("Failed", "Service tidak boleh kosong!", "error");
            } else if ((payment_method == null)) {
                swal("Failed", "Payment Method tidak boleh kosong!", "error");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $set['url']; ?>ajax/buat-pesanan.php',
                    data: {
                        'sesi' : sesi,
                        'id_pesanan' : id_pesanan,
                        'id_user' : id_user,
                        'subtotal' : subtotal,
                        'weight' : weight,
                        'name' : name,
                        'email' : email,
                        'tel' : tel,
                        'address' : address,
                        'provinsi' : province,
                        'kabupaten' : kabupaten,
                        'kecamatan' : kecamatan,
                        'postcode' : postcode,
                        'ekspedisi' : ekspedisi,
                        'service' : service,
                        'payment_method' : payment_method
                    },
                    success: function(html) {
                        window.location = "<?php echo $set['url']; ?>terimakasih";
                    }
                });
            }
        });
        $('#konfirmasi-pembayaran').on('click', function() {
            var id_pesanan = $('#id-pesanan').html();
            window.location = "<?php echo $set['url']; ?>konfirmasi-pembayaran/"+id_pesanan;
        });        
        // $('#kirim-konfirmasi').on('click', function() {
        //     var id_pesanan = $('#id_pesanan').val();
        //     var bank_tujuan = $('#bank_tujuan option:selected').val();
        //     var bank_pengirim = $('#bank_pengirim').val();
        //     var nama_pengirim = $('#nama_pengirim').val();
        //     var tanggal_transfer = $('#tanggal_transfer').val();
        //     var bukti_transfer = $('#bukti_transfer').val();
        //     var catatan = $('#catatan').val();
        //     console.log(id_pesanan);
        //     console.log(bank_tujuan);
        //     console.log(bank_pengirim);
        //     console.log(nama_pengirim);
        //     console.log(tanggal_transfer);
        //     console.log(bukti_transfer);
        //     console.log(catatan);
        // });     
    });
</script>
<script>
function invalid(name) {
  alert(name+" mohon diisi!");
}
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.more_product', function() {
            var ID = $(this).attr('id');
            $('.more_product').hide();
            $('.loading_product').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo $set['url']; ?>more-product.php',
                data: 'id=' + ID,
                success: function(html) {
                    $('#more_product_main' + ID).remove();
                    $('#post_product').append(html);
                }
            });
        });

    });
</script>

<!-- DataTables -->
<script src="<?php echo $set['url']; ?>/js/jquery.dataTables.js"></script>
<script src="<?php echo $set['url']; ?>/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>


<!-- JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

</body>

</html>