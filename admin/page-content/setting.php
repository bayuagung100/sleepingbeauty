<?php
if (!defined("INDEX")) header('location: ../index.php');

$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=setting";

switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">';
        echo'
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-credit-card"></i>
                            Daftar Rekening Bank
                        </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <a href="'.$link.'&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah</span>
                            </a>
                        </div>
                        ';
                        buka_datatables(array("Nama Bank","No Rekening","Nama Pemilik","Logo Bank"));
                        $no = 1;
                        $query = $mysqli->query("SELECT * FROM rekening_bank ORDER BY id DESC");
                        while ($data = $query->fetch_array()) {
                            $nama_bank = $data['nama_bank'];
                            $no_rek = $data['no_rek'];
                            $nama_pemilik = $data['nama_pemilik'];
                            $logo_bank = $data['logo_bank'];
                            if($logo_bank){
                                $pic = "../images/source/".$logo_bank;
                            }
                            isi_datatables($no, array($nama_bank, $no_rek, $nama_pemilik, "<img src='".$pic."' width='150' style='margin-bottom: 10px'>",),$link ,$data['id']);
                            $no++;
                        }

                        tutup_datatables(array("Nama Bank","No Rekening","Nama Pemilik","Logo Bank"));

        echo'
                    </div>
                </div>
        ';
        echo'
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Informasi Website
                        </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
        ';
                        $query  = $mysqli->query("SELECT * FROM setting ");
                        $data = $query->fetch_array();
                        buka_form($link, $data['id'], "setting");
                        buat_textbox('Judul Website', 'title', $data['title'], 'Enter judul website');
                        buat_textbox('Url Website', 'url', $data['url'], 'http://domain.com/');
                        buat_textarea('Deskripsi Website (*Jangan pakai enter)', 'description', $data['description'], 'Enter deskripsi website');
                        tutup_form($link);

        echo '          </div>
                    </div>
                </div>
        ';

        echo'
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Social Media
                        </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
        ';
                        $query  = $mysqli->query("SELECT * FROM social_media ");
                        $data = $query->fetch_array();
                        buka_form($link, $data['id'], "social");
                        buat_textbox('Email', 'email', $data['email'], 'Enter email');
                        buat_textbox('Whatsapp (*Jangan pakai +)', 'wa', $data['wa'], '6281xxxxxxxxx');
                        buat_textarea('Instagram', 'ig', $data['ig'], 'https://www.instagram.com/namaig/');
                        tutup_form($link);

        echo '          </div>
                    </div>
                </div>
        ';
        
        echo '<div>
        </div>
    </section>
            ';
        break;
    
    case "form":
        global $mysqli;
        if(isset($_GET['id'])){
            $query  = $mysqli->query ( "SELECT * FROM rekening_bank WHERE id='$_GET[id]'");
            $data= $query->fetch_array();
            $aksi   = "Edit";
        }else{
            $data = array("id"=>"", "nama_bank"=>"", "no_rek"=>"", "nama_pemilik"=>"", "logo_bank"=>"");
            $aksi   = "Tambah";
        }
        
            echo'
            <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Rekening Bank</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                    buat_textbox("Nama Bank", "nama_bank", $data['nama_bank'], "Enter nama bank");
                    buat_textbox("No Rekening", "no_rek", $data['no_rek'], "Enter no.rekening");
                    buat_textbox("Nama Pemilik", "nama_pemilik", $data['nama_pemilik'], "Enter nama pemilik");
                    buat_imagepicker("Logo Bank", "logo_bank", $data['logo_bank']);
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;

    case "action":
        $title   = ucwords(addslashes($_POST['title']));
        $url   = addslashes($_POST['url']);
        $description  = addslashes($_POST['description']);

        $email   = addslashes($_POST['email']);
        $wa   = addslashes($_POST['wa']);
        $ig  = addslashes($_POST['ig']);

        $nama_bank = ucwords(addslashes($_POST['nama_bank']));
        $no_rek = addslashes($_POST['no_rek']);
        $nama_pemilik = addslashes($_POST['nama_pemilik']);
        $logo_bank = addslashes($_POST['logo_bank']);


        if ($_POST['aksi'] == "setting") {
            $query  = $mysqli->query("UPDATE setting SET       
                title = '$title',
                url = '$url',
                description = '$description'
                WHERE id='$_POST[id]'
                ");
        }

        if ($_POST['aksi'] == "social") {
            $query  = $mysqli->query("UPDATE social_media SET       
                email = '$email',
                wa = '$wa',
                ig = '$ig'
                WHERE id='$_POST[id]'
                ");
        }

        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO rekening_bank
            (
                nama_bank,
                no_rek,
                nama_pemilik,
                logo_bank
            )
            VALUES
            (
                '$nama_bank',
                '$no_rek',
                '$nama_pemilik',
                '$logo_bank'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE rekening_bank SET
            nama_bank = '$nama_bank',
            no_rek = '$no_rek',
            nama_pemilik = '$nama_pemilik',
            logo_bank = '$logo_bank'

            WHERE id='$_POST[id]'
            ");
        }

        header('location:' . $link);
        break;

    case "delete":
        $query = $mysqli->query("DELETE FROM rekening_bank WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
