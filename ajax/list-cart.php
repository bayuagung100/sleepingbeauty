<?php
session_start();
$sesi = session_id();
include "../admin/config.php";

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
