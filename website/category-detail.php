<?php include "header.php";
$idurl = $_GET['id'];
$query = $mysqli->query("SELECT * FROM category_product WHERE category_url='$idurl'");
$data = $query->fetch_array();
$idkat = $data['id'];
$namakat = $data['category_name'];
// $id = $data['id'];
// $url = $data['product_url'];
// $nama = $data['product_name'];
// $desc = $data['product_description'];
// $stok = $data['product_stock'];
// $harga = $data['product_price'];
// $berat = $data['product_weight'];
// $ukuran = $data['product_size'];
// $warna = $data['product_color'];
// $bahan = $data['product_material'];
// $kategori = $data['product_category'];
// $gambar1 = $set['url'] . "images/source/" . $data['product_image1'];
// $gambar2 = $set['url'] . "images/source/" . $data['product_image2'];
// $gambar3 = $set['url'] . "images/source/" . $data['product_image3'];
?>

<!-- breadcrumb -->
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    <a href="<?php echo $set['url']; ?>category" class=" cl8 hov-cl1 trans-04">
        Category
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    <span class=" cl4">
        <?php echo $namakat; ?>
    </span>
</div>

<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <p>Product with category: <?php echo $namakat; ?></p>
            </div>
        </div>

        <div id="post_category">
            <?php
            echo '<div class="row isotope-grid">';
            $limit = 4;
            // $sql = $mysqli->query("SELECT * FROM product WHERE product_category LIKE '%$idkat%' ");
            // $totalRowCount = $sql->num_rows;

            $all_query = $mysqli->query("SELECT * FROM product WHERE product_category LIKE '%$idkat%' ORDER BY id DESC ");
            while ($alldata = $all_query->fetch_array()) {
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
                echo '
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <a href="' . $set['url'] . 'product/' . $url . '" >
                                <img src="' . $set['url'] . 'images/source/' . $gambar1 . '" alt="' . $nama . '">
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="' . $set['url'] . 'product/' . $url . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        ' . $nama . '
                                    </a>

                                    <span class="stext-105 cl3">
                                        ' . rupiah($harga) . '
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
            }
            echo '</div>';
            ?>
        </div>

    </div>
</section>

<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Related Product
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php
                $all_query = $mysqli->query("SELECT * FROM product ORDER BY RAND() LIMIT 8");
                while ($alldata = $all_query->fetch_array()) {
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

                    $ex = explode(",", $kategori);
                    $count = count($ex);
                    for ($i = 0; $i < $count; $i++) {
                        $idkat = $ex[$i];
                        $query = $mysqli->query("SELECT * FROM category_product WHERE id='$idkat' ");
                        $data = $query->fetch_array();
                        $slug = $data['category_url'];

                        echo '
						<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-pic hov-img0">
									<a href="' . $set['url'] . 'product/' . $url . '" >
									<img src="' . $set['url'] . 'images/source/' . $gambar1 . '" alt="' . $nama . '">
									</a>
									<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal' . $id . '">
										Quick View
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="' . $set['url'] . 'product/' . $url . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											' . $nama . '
										</a>

										<span class="stext-105 cl3">
											' . rupiah($harga) . '
										</span>
									</div>
								</div>
							</div>
						</div>
                    ';
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>