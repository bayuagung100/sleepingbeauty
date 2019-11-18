<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=product";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Product</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Gambar","Nama Product","Deskripsi","Stok","Harga","Diskon","Slide"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM product ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $name = $data['product_name'];
            $description = $data['product_description'];
            $stock = $data['product_stock'];
            $price = $data['product_price'];
            $weight = $data['product_weight']; 
            $size = $data['product_size'];
            $color = $data['product_color'];
            $material = $data['product_material'];
            $category = $data['product_category'];
            $image1 = $data['product_image1'];
            $image2 = $data['product_image2'];
            $image3 = $data['product_image3'];
            $slide = $data['product_slide'];

            if($image1){
                $pic = "../images/source/".$image1;
            }
            if($slide=='Y') $slide = '<a href="'.$link.'&show=deactivate&id='.$data['id'].'" style="color: green"><i class="fas fa-check-circle"></i></a>';
            else $slide = '<a href="'.$link.'&show=activate&id='.$data['id'].'" style="color: red"><i class="fas fa-times-circle"></i></a>';
        
            isi_datatables($no, array("<img src='".$pic."' width='150' style='margin-bottom: 10px'>", 
            $name, limit_words(strip_tags($description),10), $stock, rupiah($price), " ", $slide), $link, $data['id']);
            $no++;
        }

        tutup_datatables(array("Gambar","Nama Product","Deskripsi","Stok","Harga","Diskon","Slide"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $query     = $mysqli->query("SELECT * FROM product WHERE id='$_GET[id]'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $data = array("id" => "", "product_name" => "", "product_description" => "", "product_stock" => ""
            , "product_price" => "", "product_weight" => "", "product_size" => "", "product_color" => ""
            , "product_material" => "", "product_category" => "", "product_image1" => "", "product_image2" => ""
            , "product_image3" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Product</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Nama Product", "product_name", $data['product_name'],"Enter nama product");
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Stock Product", "product_stock", $data['product_stock'],"100");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Harga Product (*jangan pakai Rp)", "product_price", $data['product_price'],"10000");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Berat Product (*dalam gram)", "product_weight", $data['product_weight'],"100");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        
                        $size = $mysqli->query ("SELECT * FROM size_product");
                        $list = array();
                        $list[] = array('val'=>'0', 'cap'=>'Tidak Ada');              
                        while($k = $size->fetch_array()){
                            $list[] = array('val'=>$k['id'], 'cap'=>$k['size_name']);
                        }
                        buat_inline_multi_select("Size Product (*bisa lebih dari 1) <a href='index.php?content=size-product'>buat size baru</a>"
                        , "product_size[]", $list, $data['product_size'],"Select a size");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $color = $mysqli->query ("SELECT * FROM color_product");
                        $list = array();
                        $list[] = array('val'=>'0', 'cap'=>'Tidak Ada');
                        while($k = $color->fetch_array()){
                            $list[] = array('val'=>$k['id'], 'cap'=>$k['color_name']);
                        }
                        buat_inline_multi_select("Color Product (*bisa lebih dari 1) <a href='index.php?content=color-product'>buat color baru</a>"
                        , "product_color[]", $list, $data['product_color'],"Select a color");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        $category = $mysqli->query ("SELECT * FROM category_product");
                        $list = array();
                        $list[] = array('val'=>'0', 'cap'=>'Tidak Ada');
                        while($k = $category->fetch_array()){
                            $list[] = array('val'=>$k['id'], 'cap'=>$k['category_name']);
                        }
                        buat_inline_multi_select("Category Product (*bisa lebih dari 1) <a href='index.php?content=category-product'>buat category baru</a>"
                        , "product_category[]", $list, $data['product_category'],"Select a category");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $material = $mysqli->query ("SELECT * FROM material_product");
                        $list = array();
                        $list[] = array('val'=>'0', 'cap'=>'Tidak Ada');
                        while($k = $material->fetch_array()){
                            $list[] = array('val'=>$k['id'], 'cap'=>$k['material_name']);
                        }
                        buat_inline_select("Bahan Product (*<a href='index.php?content=material-product'>buat bahan baru</a>)"
                        , "product_material", $list, $data['product_material']);
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(4);
                        buat_imagepicker("Gambar 1", "product_image1", $data['product_image1'],12);
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(4);
                        buat_imagepicker("Gambar 2", "product_image2", $data['product_image2'],12);
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(4);
                        buat_imagepicker("Gambar 3", "product_image3", $data['product_image3'],12);
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_tinymce("Deskripsi Product", "product_description", $data['product_description'], 'Enter deskripsi product', 'richtext');
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $url = convert_seo($_POST['product_name']);
        $nama	= addslashes(ucwords($_POST['product_name']));
        $stok	= addslashes($_POST['product_stock']);
        $harga	= addslashes($_POST['product_price']);
        $berat	= addslashes($_POST['product_weight']);
        $ukuran = implode(",",$_POST['product_size']);
        $warna = implode(",",$_POST['product_color']);
        $kategori = implode(",",$_POST['product_category']);
        $bahan	= addslashes($_POST['product_material']);
        $gambar1	= addslashes($_POST['product_image1']);
        $gambar2	= addslashes($_POST['product_image2']);
        $gambar3	= addslashes($_POST['product_image3']);
        $deskripsi	= addslashes($_POST['product_description']);
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO product
            (
                product_url,
                product_name,
                product_description,
                product_stock,
                product_price,
                product_weight,
                product_size,
                product_color,
                product_material,
                product_category,
                product_image1,
                product_image2,
                product_image3,
                product_slide
            )
            VALUES
            (
                '$url',
                '$nama',
                '$deskripsi',
                '$stok',
                '$harga',
                '$berat',
                '$ukuran',
                '$warna',
                '$bahan',
                '$kategori',
                '$gambar1',
                '$gambar2',
                '$gambar3',
                'N'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE product SET
            product_url = '$url',
            product_name = '$nama',
            product_description = '$deskripsi',
            product_stock = '$stok',
            product_price = '$harga',
            product_weight = '$berat',
            product_size = '$ukuran',
            product_color = '$warna',
            product_material = '$bahan',
            product_category = '$kategori',
            product_image1 = '$gambar1',
            product_image2 = '$gambar2',
            product_image3 = '$gambar3'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM product WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;

    case "activate":
        $mysqli->query("UPDATE product SET product_slide='Y' WHERE id='$_GET[id]'");
        header('location:'.$link);
    break;
    
    case "deactivate":
        $mysqli->query("UPDATE product SET product_slide='N' WHERE id='$_GET[id]'");
        header('location:'.$link);
    break;
}
