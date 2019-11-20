<?php
if(!empty($_POST["id"])){

    // Include the database configuration file
    include 'admin/config.php';
    
    // Count all records except already displayed
    $query = $mysqli->query("SELECT COUNT(*) as num_rows FROM product WHERE id < ".$_POST['id']." ORDER BY id DESC");
    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];
    
    $showLimit = 8;
    echo '<div class="row isotope-grid">';
    // Get records from the database
    $pquery = $mysqli->query("SELECT * FROM product WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT $showLimit");
    $jml = $pquery->num_rows;
    while ($alldata = $pquery->fetch_array()) {
        $id = $alldata['id'];
        $url = $alldata['product_url'];
        $nama = $alldata['product_name'];
        $desc = $alldata['product_description'];
        $stok = $alldata['product_stock'];
        $harga = $alldata['product_price'];
        $berat = $alldata['product_weight'];
        $ukuran = $alldata['product_size'];
        $warna = $alldata['product_color'];
        $bahan = $alldata['product_material'];
        $kategori = $alldata['product_category'];
        $gambar1 = $alldata['product_image1'];
        $gambar2 = $alldata['product_image2'];
        $gambar3 = $alldata['product_image3'];

        $ex = explode(",",$kategori);
        $count = count($ex);
        for ($i=0; $i < $count; $i++) { 
            $idkat = $ex[$i];
            $query=$mysqli->query("SELECT * FROM category_product WHERE id='$idkat' ");
            $data = $query->fetch_array();
            $slug = $data['category_url'];

            echo '
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item '.$slug.'">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <a href="'.$set['url'].'product/'.$url.'" >
                        <img src="'.$set['url'].'images/source/'.$gambar1.'" alt="'.$nama.'">
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="'.$set['url'].'product/'.$url.'" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                '.$nama.'
                            </a>

                            <span class="stext-105 cl3">
                                '.rupiah($harga).'
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            ';
        }
    }
    echo'</div>';
    if($totalRowCount > $showLimit){
        echo '
        <!-- Load more -->
        <div id="more_product_main' . $id . '" class="flex-c-m flex-w w-full p-t-45">
            <button id="' . $id . '" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 more_product">
                Load More
            </button>
            <button class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 loading_product" style="display:none">
                Loading ...
            </button>
        </div>
        ';
    }
}
