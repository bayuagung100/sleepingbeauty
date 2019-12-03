<?php include "header.php";
$idurl = $_GET['id'];
$query = $mysqli->query("SELECT * FROM product WHERE product_url='$idurl'");
$data = $query->fetch_array();
$id = $data['id'];
$url = $data['product_url'];
$nama = $data['product_name'];
$desc = $data['product_description'];
$stok = $data['product_stock'];
$harga = $data['product_price'];
$berat = $data['product_weight'];
$ukuran = $data['product_size'];
$warna = $data['product_color'];
$bahan = $data['product_material'];
$kategori = $data['product_category'];
$pic1 = $data['product_image1'];
$pic2 = $data['product_image2'];
$pic3 = $data['product_image3'];
$pic4 = $data['product_image4'];
$pic5 = $data['product_image5'];
$pic6 = $data['product_image6'];
if($pic1!=""){
	$gambar1 = $set['url'] . "images/source/" . $pic1;
} else {
	$gambar1 = $set['url'] . "images/icons/no-image.png";
}
if($pic2!=""){
	$gambar2 = $set['url'] . "images/source/" . $pic2;
} else {
	$gambar2 = $set['url'] . "images/icons/no-image.png";
}
if($pic3!=""){
	$gambar3 = $set['url'] . "images/source/" . $pic3;
} else {
	$gambar3 = $set['url'] . "images/icons/no-image.png";
}
if($pic4!=""){
	$gambar4 = $set['url'] . "images/source/" . $pic4;
} else {
	$gambar4 = $set['url'] . "images/icons/no-image.png";
}
if($pic5!=""){
	$gambar5 = $set['url'] . "images/source/" . $pic5;
} else {
	$gambar5 = $set['url'] . "images/icons/no-image.png";
}
if($pic6!=""){
	$gambar6 = $set['url'] . "images/source/" . $pic6;
} else {
	$gambar6 = $set['url'] . "images/icons/no-image.png";
}
?>

<!-- breadcrumb -->
<div id="breadcrumb" class="container">
	<a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
		Home
	</a>
	<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<a href="<?php echo $set['url']; ?>product" class=" cl8 hov-cl1 trans-04">
		Product
	</a>
	<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<span class=" cl4">
		<?php echo $nama; ?>
	</span>
</div>

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-7 p-b-30">
				<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>
						<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

						<div class="slick3 gallery-lb">
							<?php
							if($gambar1!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar1.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar1.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar1.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							if($gambar2!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar2.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar2.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar2.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							if($gambar3!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar3.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar3.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar3.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							if($gambar4!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar4.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar4.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar4.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							if($gambar5!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar5.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar5.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar5.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							if($gambar6!=""){
								echo'
								<div class="item-slick3" data-thumb="'.$gambar6.'">
									<div class="wrap-pic-w pos-relative">
										<img src="'.$gambar6.'" alt="'.$nama.'">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.$gambar6.'">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								';
							}

							?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-5 p-b-30">
				<div class="p-r-50 p-t-5 p-lr-0-lg">
					<h4 class="mtext-105 cl2 js-name-detail p-b-14">
						<span id="product"><?php echo $nama; ?></span>
					</h4>

					<span class="mtext-106 cl2">
						<?php echo rupiah($harga); ?>
					</span>

					<?php 
						if ($stok > 5) {
							echo '
							<p class="stext-102 clgreen p-t-23">
								'.$stok.' stocks available
							</p>
							';
						} elseif ($stok > 0 && $stok <= 5 ) {
							echo '
							<p class="stext-102 clwarning p-t-23">
								'.$stok.' stocks available
							</p>
							';
						} elseif ($stok == 0) {
							echo '
							<p class="stext-102 cldanger p-t-23">
								Out of stocks
							</p>
							';
						}
					?>

					<p class="stext-102 cl3 p-t-23">
						<?php echo $desc; ?>
					</p>

					<!--  -->
					<!-- <form method="get" action="<?php echo $set["url"];?>shop/add-to-cart.php"> -->
					<input id="ip" type="hidden" name="id" value="<?php echo $id;?>">
					<div class="p-t-33">
						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6">
								Size
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select id="size" class="js-select2" name="size" required>
										<option value="">Pilih Ukuran</option>
										<?php
										$ex = explode(",", $ukuran);
										$count = count($ex);
										for ($i = 0; $i < $count; $i++) {
											$idsize = $ex[$i];
											$query = $mysqli->query("SELECT * FROM size_product WHERE id='$idsize' ");
											$data = $query->fetch_array();
											$size_name = $data['size_name'];

											echo '
											<option value="' . $size_name . '">' . $size_name . '</option>
											';
										}

										?>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6">
								Color
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select id="color" class="js-select2" name="color" required>
										<option value="">Pilih Warna</option>
										<?php
										$ex = explode(",", $warna);
										$count = count($ex);
										for ($i = 0; $i < $count; $i++) {
											$idcolor = $ex[$i];
											$query = $mysqli->query("SELECT * FROM color_product WHERE id='$idcolor' ");
											$data = $query->fetch_array();
											$color_name = $data['color_name'];

											echo '
											<option value="' . $color_name . '">' . $color_name . '</option>
											';
										}
										?>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-204 flex-w flex-m respon6-next">
								<div class="wrap-num-product flex-w m-r-20 m-tb-10">
									<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-minus"></i>
									</div>

									<?php 
									if ($stok == 0) {
										echo '
										<input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="0" min="0" max="0">
										';
									} else {
										echo'
										<input id="qty" class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="1" min="1" max="'.$stok.'">
										';
									}
									?>
									

									<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-plus"></i>
									</div>
								</div>

								<?php
									if($stok == 0){
										echo '
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail disabled" disabled>
											Add to cart
										</button>
										';
									} else {
										echo '
										<button id="btn-add-to-cart" type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
										';
									}
								?>
								
								
							</div>
						</div>
					</div>

					<!-- </form> -->
				</div>
			</div>
		</div>

		<div class="bor10 m-t-50 p-t-43 p-b-40">
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#information" role="tab">Detail Product</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-43">
					<!-- - -->
					<div class="tab-pane fade show active" id="description" role="tabpanel">
						<div class="how-pos2 p-lr-15-md">
							<p class="stext-102 cl6">
								<?php echo $desc; ?>
							</p>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="information" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<ul class="p-lr-28 p-lr-15-sm">
									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Weight
										</span>

										<span class="stext-102 cl6 size-206">
											<?php echo $berat; ?> gram
										</span>
									</li>

									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Materials
										</span>

										<span class="stext-102 cl6 size-206">
											<?php 
											$materialquery = $mysqli->query("SELECT * FROM material_product WHERE id='$bahan' ");
											$bdata = $materialquery->fetch_array();
											echo $bdata['material_name']; ?>
										</span>
									</li>

									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Color
										</span>

										<span class="stext-102 cl6 size-206">
											<?php
											$ex = explode(",", $warna);
											$count = count($ex);
											for ($i = 0; $i < $count; $i++) {
												$idcolor = $ex[$i];
												$query = $mysqli->query("SELECT * FROM color_product WHERE id='$idcolor' ");
												$data = $query->fetch_array();
												$color_name = $data['color_name'];

												echo '
											' . $color_name . ',
											';
											}
											?>
										</span>
									</li>

									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Size
										</span>

										<span class="stext-102 cl6 size-206">
											<?php
											$ex = explode(",", $ukuran);
											$count = count($ex);
											for ($i = 0; $i < $count; $i++) {
												$idsize = $ex[$i];
												$query = $mysqli->query("SELECT * FROM size_product WHERE id='$idsize' ");
												$data = $query->fetch_array();
												$size_name = $data['size_name'];

												echo '
											' . $size_name . ',
											';
											}

											?>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
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