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
                    <h3>Login Member</h3>
                    <p>Masukkan email dan password Anda untuk login</p>
                </div>
                <hr/>
                <?php
                if(isset($_POST['login'])){
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);

                    $cekemail = $mysqli->query("SELECT * FROM member WHERE email='$email' ");
                    $cek_email = $cekemail->num_rows;
                
                    if($cek_email > 0){
                        $cekuser = $mysqli->query("SELECT * FROM member WHERE email='$email' AND password='$password' ");
                        $jmluser = $cekuser->num_rows;
                        $data = $cekuser->fetch_array();

                        if ($jmluser > 0) {
                            $pecahprov = explode("-",$data['provinsi']);
                            $idprov = $pecahprov[0];
                            $prov = $pecahprov[1];
                            $pecahkab = explode("-",$data['kabupaten']);
                            $idkab = $pecahkab[0];
                            $kab = $pecahkab[1];
                            $pecahkec = explode("-",$data['kecamatan']);
                            $idkec = $pecahkec[0];
                            $kec = $pecahkec[1];
                            $_SESSION['id'] = $data['id'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['password'] = $data['password'];
                            $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                            $_SESSION['no_hp'] = $data['no_hp'];
                            $_SESSION['idprov'] = $idprov;
                            $_SESSION['prov'] = $prov;
                            $_SESSION['idkab'] = $idkab;
                            $_SESSION['kab'] = $kab;
                            $_SESSION['idkec'] = $idkec;
                            $_SESSION['kec'] = $kec;
                            $_SESSION['kode_pos'] = $data['kode_pos'];
                            $_SESSION['alamat'] = $data['alamat'];
                        
                        
                            $_SESSION['log'] = 1;
                            echo '
                            <script>
                            alert("Login Success"); 
                            window.location = "' . $set['url'] . 'member/dashboard";
                            </script>
                            ';
                            } else {
                            echo '
                            <div class="alert alert-danger" role="alert"><b>Sorry!</b> email atau password salah.</div>
                            ';
                            }  
                    } else {
                        echo'
                        <div class="alert alert-danger" role="alert"><b>Sorry!</b> email yang Anda masukkan belum terdaftar, silahkan Anda daftar terlebih dahulu <a href="' . $set['url'] . 'member/daftar">daftar disini</a>.</div>
                        ';
                    }
                }
                ?>
                <form action="" method="post">
                    <p>Email (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="email" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="email" name="email" placeholder="Email" required>
                    </div>
                    <p>Password (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="password" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" name="login" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Masuk</button>
                    <br>
                    <p>Lupa Password? <a href="<?php echo $set['url']; ?>member/lupa-password">Klik disini.</a></p>
                    <p>Belum punya akun? <a href="<?php echo $set['url']; ?>member/daftar">Daftar disini.</a></p>
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