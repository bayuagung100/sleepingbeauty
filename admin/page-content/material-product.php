<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=material-product";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bahan Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Bahan Product</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';
        buka_datatables(array("Nama Bahan"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM material_product ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $name = $data['material_name'];
            isi_datatables($no, array($name), $link, $data['id']);
            $no++;
        }

        tutup_datatables(array("Nama Bahan"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $query     = $mysqli->query("SELECT * FROM material_product WHERE id='$_GET[id]'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $data = array("id" => "","material_name" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Bahan Product</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Nama Bahan", "material_name", $data['material_name'],"Enter bahan product");
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $nama	= addslashes(ucwords($_POST['material_name']));

        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO material_product
            (
                material_name
            )
            VALUES
            (
                '$nama'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE material_product SET
            material_name = '$nama'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM material_product WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
?>