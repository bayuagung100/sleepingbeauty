<?php 
include "website/header.php";
if(isset($_SESSION['log'])==1){
    header('location:'.$set['url'].'member/dashboard');
} else {
?>
<div class="container p-t-20 p-b-20">
    <div class="p-lr-40 p-t-30 p-b-40">
        <div class="row bor10 p-t-20 p-b-20">
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                <div class="text-center">
                    <h3>Daftar Member</h3>
                    <p>Lengkapi data berikut untuk registrasi</p>
                </div>
                <hr/>
                <?php
                if(isset($_POST['daftar'])){
                    $nama_lengkap = ucwords($_POST['nama_lengkap']);
                    $no_hp = $_POST['no_hp'];
                    $provinsi = $_POST['provinsi'];
                    $kabupaten = $_POST['kabupaten'];
                    $kecamatan = $_POST['kecamatan'];
                    $postcode = $_POST['postcode'];
                    $alamat = $_POST['alamat'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $ulangi_password = $_POST['ulangi_password'];
                    $md5 = md5($password);

                    if ($password != $ulangi_password) {
                        echo '
                        <div class="alert alert-danger" role="alert"><b>Sorry!</b> password yang Anda masukkan tidak sama.</div>
                        ';
                    } else {
                        $cekquery = $mysqli->query("SELECT * FROM member WHERE email='$email' ");
                        $cek = $cekquery->num_rows;
                    
                        if($cek > 0){
                            echo'
                            <div class="alert alert-danger" role="alert"><b>Sorry!</b> email yang Anda gunakan sudah terdaftar.</div>
                            ';
                        } else {
                            $insert = $mysqli->query("INSERT INTO member
                                (
                                    email,
                                    password,
                                    nama_lengkap,
                                    no_hp,
                                    provinsi,
                                    kabupaten,
                                    kecamatan,
                                    kode_pos,
                                    alamat
                                )
                                VALUES
                                (
                                    '$email',
                                    '$md5',
                                    '$nama_lengkap',
                                    '$no_hp',
                                    '$provinsi',
                                    '$kabupaten',
                                    '$kecamatan',
                                    '$postcode',
                                    '$alamat'
                                )
                            ");
                            if ($insert) {
                                echo '
                                <div class="alert alert-success" role="alert"><b>Success!</b> pendaftaran berhasil, silahkan Anda login. <a href="' . $set['url'] . 'member">login disini</a></div>
                                ';
                            } else {
                                echo '
                                <script>
                                alert("Pendaftaran gagal, Silahkan coba lagi.");
                                window.location = "' . $set['url'] . 'member/daftar";
                                </script>
                                ';
                            }
                        }
                    }
                
                    
                }
                ?>
                <form action="" method="post">
                    <p>Nama Lengkap (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="nama_lengkap" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    </div>
                    <p>No Hp / WhatsApp (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="no_hp" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="tel" name="no_hp" placeholder="081xxxxxxxxx" required>
                    </div>

                    <p>Provinsi (Wajib diisi)</p>
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                    <?php
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
                        <select id="daftar_provinsi" class="js-select2" name="provinsi" required>
                            <option value="">Pilih Porvinsi</option>
                        ';
                        foreach ($listProv as $prov) {
                            echo '
                            <option value="' . $prov->id . '-'.$prov->nama.'" province="' . $prov->nama . '">' . $prov->nama . '</option>
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
                        <select id="daftar_kabupaten" class="js-select2" name="kabupaten" required>
                            <option value="">Pilih Kota / Kabupaten</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <p>Kecamatan (Wajib diisi)</p>
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        <select id="daftar_kecamatan" class="js-select2" name="kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <p>Kode Pos (Wajib diisi)</p>
                    <div class="bor8 bg0 m-b-22">
                        <input id="postcode" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Kode Pos" required>
                    </div>
                    ';
                    ?>
                    <p>Alamat Lengkap (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                    <textarea id="alamat" class="stext-111 cl2 plh3 size-textarea p-lr-28 p-tb-25" name="alamat" placeholder="Nama jalan dan nomor rumah" required></textarea>
                    </div>
                    <p>Email (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="email" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="email" name="email" placeholder="Email" required>
                    </div>
                    <p>Password (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="password" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="password" name="password" placeholder="Password" required>
                    </div>
                    <p>Ulangi Password (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="ulangi_password" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="password" name="ulangi_password" placeholder="Ulangi Password" required>
                    </div>
                    <button type="submit" name="daftar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Masuk</button>
                    <br>
                    <p>Sudah punya akun? <a href="<?php echo $set['url']; ?>member">Login disini.</a></p>
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