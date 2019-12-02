<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=member";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Member</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Data Member</h3>
                    
                </div>
    ';
        buka_datatables(array("Nama Lengkap", "Email","No Hp"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM member ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $email = $data['email'];
            $nama_lengkap = $data['nama_lengkap'];
            $no_hp = $data['no_hp'];
            detail_datatables($no, array($nama_lengkap,$email,$no_hp), $link, $id);
            $no++;
        }

        tutup_datatables(array("Nama Lengkap", "Email","No Hp"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if(isset($_GET['id'])){
        $query  = $mysqli->query ( "SELECT * FROM member WHERE id='$_GET[id]'");
        $data= $query->fetch_array();
        $aksi   = "Detail";
        }
      
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">'.$aksi.' Member</h3>
                        <a href="' . $link . '" class="btn btn-primary btn-icon-split" style="float: right!important;">
                            <span class="icon text-white-50">
                                <i class="fas fa-angle-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                    <div class="card-body">';
                    $pecahprov = explode("-",$data['provinsi']);
                    $idprov = $pecahprov[0];
                    $prov = $pecahprov[1];
                    $pecahkab = explode("-",$data['kabupaten']);
                    $idkab = $pecahkab[0];
                    $kab = $pecahkab[1];
                    $pecahkec = explode("-",$data['kecamatan']);
                    $idkec = $pecahkec[0];
                    $kec = $pecahkec[1];
                    buat_notag("Nama Lengkap :", $data['nama_lengkap'], 4);
                    buat_rowtabsbuka();
                        buat_label("Email:",2);
                        buat_col($data['email'],4);
                        buat_label("No Hp :",2);
                        buat_col($data['no_hp'],4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Provinsi :",2);
                        buat_col($prov,4);
                        buat_label("Kota / Kabupaten :",2);
                        buat_col($kab,4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Kecamatan :",2);
                        buat_col($kec,4);
                        buat_label("Kode Pos :",2);
                        buat_col($data['kode_pos'],4);
                    buat_rowtabstutup();
                    buat_tag("Alamat :", $data['alamat']);
                    
       echo '
                    </div>
                </div>
            </div>            
        </section>';
    break;
}
?>