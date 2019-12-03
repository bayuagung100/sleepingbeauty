<?php include "header.php"; ?>

<!-- breadcrumb -->
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    <span class=" cl4">
        Cart
    </span>
</div>
<?php
$query = mysqli_query($mysqli, "SELECT * FROM temp_cart WHERE id_session='$sesi' ");
$data = mysqli_fetch_array($query);

$id_pesanan = str_replace('-', '', $data['date']) . $data['id'] . $data['id_product'];

?>
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <?php
            $total = 0;
            $totalberat = 0;
            $yourcartquery = $mysqli->query("SELECT * FROM temp_cart WHERE id_session='$sesi' ");
            $ceking = mysqli_num_rows($yourcartquery);

            if ($ceking > 0) {
            echo '
            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                
                    <div class="wrap-table-shopping-cart">
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
                            $berat = $data['product_weight'];
                            $ukuran = $data['product_size'];
                            $warna = $data['product_color'];
                            $pic1 = $data['product_image1'];
                            if ($pic1 != "") {
                            $gambar1 = $set['url'] . "images/source/" . $pic1;
                            } else {
                            $gambar1 = $set['url'] . "images/icons/no-image.png";
                            }

                            $ib = $qtycart*$berat;
                            $it = $qtycart * $harga;
                            $total += $it;
                            $totalberat += $ib;

                            echo '
                            <tr class="table_row">
                                <td class="column-aksi">
                                <span id="del-cart'.$id.'">x</span>
                                </td> 
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="'.$gambar1.'" alt="'.$nama.'">
                                    </div>
                                </td>
                                <td class="column-2"><span class="tangerine-product">'.$nama.'</span><br>@'.$berat.' gram</td>
                                <td class="column-3">'.rupiah($harga).'</td>
                                <td class="column-4">
                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div id="min-product'.$id.'" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="'.$qtycart.'">

                                        <div id="plus-product'.$id.'" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-5">'.rupiah($it).'<br>@'.$ib.' gram</td>
                            </tr>
                            ';
                            }
                            }

                            echo '
                        </table>
                    </div>
                
            </div>
            ';
            ?>
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Penagihan & Pengiriman
                    </h4>
                    <input type="hidden" id="sesi" name="sesi" value="<?php echo $sesi;?>">
                    <input type="hidden" id="id_pesanan" name="id_pesanan" value="<?php echo $id_pesanan?>">
                    <input type="hidden" id="id_user" name="id_user" value="<?php if(isset($_SESSION['id'])){echo $_SESSION['id'];}?>">
                    <input type="hidden" id="subtotal" name="subtotal" value="<?php echo $total;?>">
                    <input type="hidden" id="weight" name="weight" value="<?php echo $totalberat?>">
                    <p>Nama Lengkap (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="name" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="name" placeholder="Nama Lengkap" value="<?php if(isset($_SESSION['nama_lengkap'])){echo $_SESSION['nama_lengkap'];}?>" required>
                    </div>
                    <p>Email (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="email" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="email" placeholder="example@email.com" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>" required>
                    </div>
                    <p>No Hp / WhatsApp (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="tel" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="tel" name="tel" placeholder="081xxxxxxxxx" value="<?php if(isset($_SESSION['no_hp'])){echo $_SESSION['no_hp'];}?>" required>
                    </div>
                    <p>Alamat Lengkap (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                    <textarea id="address" class="stext-111 cl2 plh3 size-textarea p-lr-28 p-tb-25" name="address" placeholder="Nama jalan dan nomor rumah" required><?php if(isset($_SESSION['alamat'])){echo $_SESSION['alamat'];}?></textarea>
                    </div>
                    
                    <?php 
                    if (isset($_SESSION['log'])==0){
                        echo '
                        <p>Provinsi (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        ';
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "key: 772b99fdc5a62231d8a83772580ae8fa"
                            ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        $listProv = array();

                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            $arrayResponse = json_decode($response, true);

                            $tempListProv = $arrayResponse['rajaongkir']['results'];

                            foreach ($tempListProv as $value) {
                                $prov = new stdClass();
                                $prov->id = $value['province_id'];
                                $prov->nama = $value['province'];

                                array_push($listProv, $prov);
                            }

                            echo '
                            <select id="provinsi" class="js-select2" name="provinsi" required>
                                <option value="">Pilih Porvinsi</option>
                            ';
                            foreach ($listProv as $prov) {
                                echo '
                                <option value="' . $prov->id . '" province="' . $prov->nama . '">' . $prov->nama . '</option>
                                ';
                            }
                            echo '
                                </select>
                            ';
                        }
                        echo'
                            <div class="dropDownSelect2"></div>
                        </div>
                        
                        <p>Kota / Kabupaten (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select id="kabupaten" class="js-select2" name="kabupaten" required>
                                <option value="">Pilih Kota / Kabupaten</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>

                        <p>Kecamatan (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select id="kecamatan" class="js-select2" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        ';
                    } else {
                        echo '
                        <p>Provinsi (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        ';
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "key: 772b99fdc5a62231d8a83772580ae8fa"
                            ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        $listProv = array();

                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            $arrayResponse = json_decode($response, true);

                            $tempListProv = $arrayResponse['rajaongkir']['results'];

                            foreach ($tempListProv as $value) {
                                $prov = new stdClass();
                                $prov->id = $value['province_id'];
                                $prov->nama = $value['province'];

                                array_push($listProv, $prov);
                            }

                            echo '
                            <select id="provinsi" class="js-select2" name="provinsi" required>
                                <option value="">Pilih Porvinsi</option>
                            ';
                            foreach ($listProv as $prov) {
                                $select = $prov->id == $_SESSION['idprov'] ? 'selected' : '';
                                echo '
                                <option value="' . $prov->id . '" province="' . $prov->nama . '" '.$select.'>' . $prov->nama . '</option>
                                ';
                            }
                            echo '
                                </select>
                            ';
                        }
                        echo'
                            <div class="dropDownSelect2"></div>
                        </div>';
                        
                        echo'
                        <p>Kota / Kabupaten (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        ';
                        $curl2 = curl_init();
                        curl_setopt_array($curl2, array(
                            CURLOPT_URL => "https://pro.rajaongkir.com/api/city",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "key: 772b99fdc5a62231d8a83772580ae8fa"
                            ),
                        ));

                        $response2 = curl_exec($curl2);
                        $err2 = curl_error($curl2);
                        curl_close($curl2);
                        $listKab = array();

                        if ($err2) {
                            echo "cURL Error #:" . $err2;
                        } else {
                            $arrayResponse2 = json_decode($response2, true);

                            $tempListKab = $arrayResponse2['rajaongkir']['results'];

                            foreach ($tempListKab as $value) {
                                $kab = new stdClass();
                                $kab->id = $value['city_id'];
                                $kab->nama = $value['city_name'];
                                $kab->type = $value['type'];

                                array_push($listKab, $kab);
                            }

                            echo '
                            <select id="kabupaten" class="js-select2" name="kabupaten" required>
                                <option value="">Pilih Kota / Kabupaten</option>
                            ';
                            foreach ($listKab as $kab) {
                                $select = $kab->id == $_SESSION['idkab'] ? 'selected' : '';
                                echo '
                                <option value="' . $kab->id . '" city_name="' . $kab->nama . ' ('.$kab->type.')" '.$select.'>' . $kab->nama . ' ('.$kab->type.')</option>
                                ';
                            }
                            echo '
                                </select>
                            ';
                        }
                            // <select id="kabupaten" class="js-select2" name="kabupaten" required>
                            //     <option value="">Pilih Kota / Kabupaten</option>
                            // </select>
                        echo'
                            <div class="dropDownSelect2"></div>
                        </div>
                        ';

                        echo'
                        <p>Kecamatan (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        ';

                        echo '
                        <select id="kecamatan" class="js-select2" name="kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                        ';

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$_SESSION[idkab]",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "key: 772b99fdc5a62231d8a83772580ae8fa"
                        ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                        echo "cURL Error #:" . $err;
                        } else {
                        //echo $response;
                        }

                        $data = json_decode($response, true);
                        for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                            $select = $data['rajaongkir']['results'][$i]['subdistrict_id'] == $_SESSION['idkec'] ? 'selected' : '';
                            echo "<option value='".$data['rajaongkir']['results'][$i]['subdistrict_id']."' subdistrict_name='".$data['rajaongkir']['results'][$i]['subdistrict_name']."' ".$select.">".$data['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
                        }

                        echo '
                            </select>
                        ';
                        
                            // <select id="kecamatan" class="js-select2" name="kecamatan" required>
                            //     <option value="">Pilih Kecamatan</option>
                            // </select>
                        echo '
                            <div class="dropDownSelect2"></div>
                        </div>
                        ';
                    }
                    ?>
                    <p>Kode Pos (Wajib diisi)</p>
                    <div class="bor8 bg0 m-b-22">
                        <input id="postcode" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Kode Pos" value="<?php if(isset($_SESSION['kode_pos'])){echo $_SESSION['kode_pos'];}?>" required>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <?php echo rupiah($total).'<br>@'.$totalberat.' gram';?>
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Ongkir:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                Pengiriman dari Jakarta Selatan (Toko Kami).
                            </p>
                        </div>
                        
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="p-t-15" style="width:100%">
                            <span class="stext-112 cl8">
                                Menghitung Ongkir (Wajib diisi)
                            </span>

                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select id="ekspedisi" class="js-select2" name="ekspedisi" required>
                                    <option value="">Pilih Ekspedisi</option>
                                    <option value="sicepat">SiCepat Express</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="jnt">J&T Express</option>
                                    <option value="jet">JET Express</option>
                                    <option value="wahana">Wahana</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>

                            <div id="list-ekspedisi">
                            
                            </div>

                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="p-t-15" style="width:100%">
                            <span class="stext-112 cl8">
                                Payment Method (Wajib diisi)
                            </span>

                            <p id="payment-method">';
                            <?php
                            $bankquery = $mysqli->query("SELECT * FROM rekening_bank");
                            while ($databank = $bankquery->fetch_array()) {
                                $id = $databank['id'];
                                $nama = $databank['nama_bank'];
                                $norek = $databank['no_rek'];
                                $namapemilik = $databank['nama_pemilik'];
                                $logo = $databank['logo_bank'];

                                echo '
                                <input style="display:none" id="'.$nama.'" type="radio" name="payment-method" value="'.$nama.'-'.$norek.'-'.$namapemilik.'" required/>
                                <label for="'.$nama.'">
                                    <img src="'.$set['url'].'images/source/'.$logo.'" style="max-width:150px;max-height:100px">
                                </label>
                                ';
                            }
                                

                            echo '
                            </p>
                            ';
                            ?>

                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-211">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span id="grand-total" class="mtext-110 cl2">
                            Calculating...
                            </span>
                        </div>
                    </div>

                    <div id="buat-pesanan" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Buat Pesanan
                    </div>
                </div>
            </div>
            <?php
            } else {
            echo '
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-aksi"></th>
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>

                            <tr class="table_row">
                                <td colspan="6" style="text-align:center">Your cart is empty</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            ';
            
}?>
        </div>
    </div>
</form>

<?php include "footer.php"; ?>