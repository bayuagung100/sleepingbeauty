<?php
include "website/header.php";
if(isset($_SESSION['log'])==0){
    header('location:'.$set['url']);
} else {      
?>
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<a href="<?php echo $set['url']; ?>member/dashboard" class=" cl8 hov-cl1 trans-04">
		Dashboard
	</a>
	<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<span class=" cl4">
        Profile
	</span>
</div>
<div class="container p-t-20 p-b-20">
    <div class="p-lr-40 p-t-30 p-b-40">
        <div class="row p-t-20 p-b-20">
            <div class="col-lg-4 col-xl-4 m-lr-auto m-b-50">
                <div class="m-b-50">
                    <img src="<?php echo $set['url'];?>images/icons/avatar.png" alt="avatar"><span class="m-l-20"><b><?php echo $_SESSION['nama_lengkap'];?></b></span>
                    <a href="<?php echo $set['url'];?>member/logout" class="m-t-30 flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Logout
                    </a>
                </div>
                <div class="menu">
                    <h3 class="m-b-15 menu-title">Menu Anda</h3>
                    <ul>
                        <li>
                        <a href="<?php echo $set['url'];?>member/dashboard">> Dashboard</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/pesanan">> Pesanan</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/profile">> Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                <h3 class="p-b-20">Profile</h3>
                <?php
                if(isset($_POST['update-profile'])){
                    $name = ucwords($_POST['name']);
                    $email = $_POST['email'];
                    $tel = $_POST['tel'];
                    $address = $_POST['address'];
                    $provinsi = $_POST['provinsi'];
                    $kabupaten = $_POST['kabupaten'];
                    $kecamatan = $_POST['kecamatan'];
                    $postcode = $_POST['postcode'];

                    $query = $mysqli->query("UPDATE member SET
                        email = '$email',
                        nama_lengkap = '$name',
                        no_hp = '$tel',
                        provinsi = '$provinsi',
                        kabupaten = '$kabupaten',
                        kecamatan = '$kecamatan',
                        kode_pos = '$postcode',
                        alamat = '$address'

                        WHERE id='$_SESSION[id]'
                    ");
                    if ($query) {
                        $pecahprov = explode("-",$provinsi);
                        $idprov = $pecahprov[0];
                        $prov = $pecahprov[1];
                        $pecahkab = explode("-",$kabupaten);
                        $idkab = $pecahkab[0];
                        $kab = $pecahkab[1];
                        $pecahkec = explode("-",$kecamatan);
                        $idkec = $pecahkec[0];
                        $kec = $pecahkec[1];
                        $_SESSION['email'] = $email;
                        $_SESSION['nama_lengkap'] = $name;
                        $_SESSION['no_hp'] = $tel;
                        $_SESSION['idprov'] = $idprov;
                        $_SESSION['prov'] = $prov;
                        $_SESSION['idkab'] = $idkab;
                        $_SESSION['kab'] = $kab;
                        $_SESSION['idkec'] = $idkec;
                        $_SESSION['kec'] = $kec;
                        $_SESSION['kode_pos'] = $postcode;
                        $_SESSION['alamat'] = $address;
                        echo '
                        <div class="alert alert-success" role="alert"><b>Success.</b> Profile berhasil diupdate.</div>
                        ';
                    } else {
                        echo '
                        <div class="alert alert-danger" role="alert"><b>Sorry.</b> Profile gagal diupdate.</div>
                        ';
                    }
                }
                ?>
                <form action="" method="post">
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
                            <option value="' . $prov->id . '-'.$prov->nama.'" province="' . $prov->nama . '" '.$select.'>' . $prov->nama . '</option>
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
                            <option value="' . $kab->id . '-' . $kab->nama . ' ('.$kab->type.')" city_name="' . $kab->nama . ' ('.$kab->type.')" '.$select.'>' . $kab->nama . ' ('.$kab->type.')</option>
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
                        echo "<option value='".$data['rajaongkir']['results'][$i]['subdistrict_id']."-".$data['rajaongkir']['results'][$i]['subdistrict_name']."' subdistrict_name='".$data['rajaongkir']['results'][$i]['subdistrict_name']."' ".$select.">".$data['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
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
                    ?>
                    <p>Kode Pos (Wajib diisi)</p>
                    <div class="bor8 bg0 m-b-22">
                        <input id="postcode" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Kode Pos" value="<?php if(isset($_SESSION['kode_pos'])){echo $_SESSION['kode_pos'];}?>" required>
                    </div>
                    <button type="submit" name="update-profile" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
<?php
include "website/footer.php";
?>