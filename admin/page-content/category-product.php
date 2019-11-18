<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=category-product";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Category Product</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';
        buka_datatables(array("Nama Category","Icon"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM category_product ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $name = $data['category_name'];
            $icon = $data['category_icon'];
            if($icon){
                $pic = "../images/source/".$icon;
            } else {
                $pic = "";
            }
            isi_datatables($no, array($name, "<img src='".$pic."' width='150' style='margin-bottom: 10px'>"), $link, $data['id']);
            $no++;
        }

        tutup_datatables(array("Nama Category","Icon"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $query     = $mysqli->query("SELECT * FROM category_product WHERE id='$_GET[id]'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $data = array("id" => "","category_name" => "","category_icon" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Category Product</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Nama Category", "category_name", $data['category_name'],"Enter nama category");
                buat_imagepicker("Icon", "category_icon", $data['category_icon']);
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $url = convert_seo($_POST['category_name']);
        $nama	= addslashes(ucwords($_POST['category_name']));
        $icon	= addslashes($_POST['category_icon']);

        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO category_product
            (
                category_url,
                category_name,
                category_icon
            )
            VALUES
            (
                '$url',
                '$nama',
                '$icon'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE category_product SET
            category_url = '$url',
            category_name = '$nama',
            category_icon = '$icon'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM category_product WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
?>