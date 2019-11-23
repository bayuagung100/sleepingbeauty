<?php
session_start();
$sesi = session_id();
include "../admin/config.php";

$total = 0;
$yourcartquery = $mysqli->query("SELECT * FROM temp_cart WHERE id_session='$sesi' ");
$ceking = mysqli_num_rows($yourcartquery);

if ($ceking > 0) {
    echo '
    <table class="table-shopping-cart">
        <tr class="table_head">
            <th class="column-aksi"></th>
            <th class="column-1">Product</th>
            <th class="column-2"></th>
            <th class="column-3">Price</th>
            <th class="column-4">Quantity</th>
            <th class="column-5">Total</th>
        </tr>
    ';
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
            <tr class="table_row">
                <td class="column-aksi"><span>x</span></td>
                <td class="column-1">
                    <div class="how-itemcart1">
                        <img src="'.$gambar1.'" alt="'.$nama.'">
                    </div>
                </td>
                <td class="column-2">'.$nama.'</td>
                <td class="column-3">'.rupiah($harga).'</td>
                <td class="column-4">
                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                        </div>

                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="'.$qtycart.'">

                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                        </div>
                    </div>
                </td>
                <td class="column-5">'.rupiah($it).'</td>
            </tr>
            ';
        }
    }
    echo '
    </table>
    ';
} else {
    echo '
    <table class="table-shopping-cart">
        <tr class="table_head">
            <th class="column-aksi"></th>
            <th class="column-1">Product</th>
            <th class="column-2"></th>
            <th class="column-3">Price</th>
            <th class="column-4">Quantity</th>
            <th class="column-5">Total</th>
        </tr>
        <tr class="table-row">
            <td colspan="6" style="text-align:center">Your cart is empty</td>
        </tr>
    ';
    echo '
    </table>
    ';
}
