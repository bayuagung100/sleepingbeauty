<?php
include "header.php";
?>
<?php
if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];
    ?>
    <!-- breadcrumb -->
    <div id="breadcrumb" class="container">
        <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
            Home
        </a>
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        <span class=" cl4">
            Konfirmasi Pembayaran
        </span>
    </div>

    <div class="container p-t-20 p-b-20">
        <div class="p-lr-40 p-t-30 p-b-40">
            <div class="row bor10 p-t-20 p-b-20">
                <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                    <p>Kami menerima pembayaran Transfer Bank di Indonesia dengan berbagai cara, diantaranya adalah melalui Internet Banking, Transfer ATM, m-Banking, SMS Banking, Setoran Tunai maupun Phone Banking. Semua pembayaran produk dapat dilakukan melalui rekening bank berikut ini:</p>
                    <div class="p-t-20 p-b-20 p-l-20 p-r-20">
                    <ul>
                    <?php
                    $query = $mysqli->query("SELECT * FROM rekening_bank");
                    while($data = $query->fetch_array()){
                        $nb = $data['nama_bank'];
                        $nr = $data['no_rek'];
                        $np = $data['nama_pemilik'];

                        echo '
                        <li>
                            <p>
                                <b>'.$nb.'</b>
                                <br>
                                No Rekening: '.$nr.'
                                <br>
                                a/n: '.$np.'
                            </p>
                        </li>
                        ';
                    }
                    ?>
                    </ul>
                    </div>
                    <div class="peringatan">
                        <p class="icon-left">
                        <img height="50" width="55" alt="Konfirmasi Pembayaran" src="<?php echo $set['url'];?>images/icons/warning-icon.png">
                        </p>
                        <p class="text">Penting: Harap pastikan hanya melakukan transfer ke salah satu rekening di <?php echo $set['url'];?>. Kami tidak akan pernah meminta Anda untuk membuat permintaan transfer ke rekening lain. Harap berhati-hati terhadap penipuan.</p>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                    <?php
					if(isset($_POST['kirim-konfirmasi'])){
                        $id_pesanan = $_POST['id_pesanan'];
						$bank_tujuan = $_POST['bank_tujuan'];
                        $bank_pengirim = $_POST['bank_pengirim'];
                        $no_rek_pengirim = $_POST['no_rek_pengirim'];
                        $nama_pengirim = $_POST['nama_pengirim'];
						$tanggal_transfer = $_POST['tanggal_transfer'];
						$catatan = $_POST['catatan'];
						$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
						$file = $_FILES['bukti_transfer']['name'];
						$x = explode('.', $file);
						$ekstensi = strtolower(end($x));
						$file_tmp = $_FILES['bukti_transfer']['tmp_name'];

						if(in_array($ekstensi,$ekstensi_diperbolehkan) === true) {
							if(move_uploaded_file($file_tmp, 'images/bukti_tf/'.$file)){
							$kquery = $mysqli->query("INSERT INTO konfirmasi_pembayaran
								(
                                    id_pesanan,
									bank_tujuan,
									bank_pengirim,
									no_rek_pengirim,
									nama_pengirim,
									tanggal_transfer,
									bukti_transfer,
									catatan,
									konfirmasi
								)
								values
								(
                                    '$id_pesanan',
									'$bank_tujuan',
									'$bank_pengirim',
									'$no_rek_pengirim',
									'$nama_pengirim',
									'$tanggal_transfer',
									'$file',
									'$catatan',
									'N'
								)
                            ");
							echo '
							<div class="alert alert-success" role="alert"><b>Success.</b> Bukti Transfer yang Anda upload akan diproses dalam 1x24 jam di jam kerja kami.</div>
                            <script>
                            alert("Success. Bukti Transfer yang Anda upload akan diproses dalam 1x24 jam di jam kerja kami."); 
							</script>
							';
							}
						}else{
							echo '
							<div class="alert alert-danger" role="alert"><b>Sorry!</b> Bukti Transfer yang Anda upload tidak didukung.</div>
							<script>
							alert("Sorry! Bukti Transfer yang Anda upload tidak didukung."); 
							</script>
							';
						}
					}
					?>
                        <p>ID Pesanan (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="id_pesanan" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="id_pesanan" value="<?php echo $id_pesanan;?>" placeholder="ID Pesanan" required>
                        </div>
                        <p>Bank Tujuan (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select id="bank_tujuan" class="js-select2" name="bank_tujuan" required>
                                <option value="">Pilih Bank TUjuan</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM rekening_bank");
                                while($data = $query->fetch_array()){
                                    $nb = $data['nama_bank'];
                                    $nr = $data['no_rek'];
                                    $np = $data['nama_pemilik'];

                                    echo '
                                    <option value="'.$nb.'-'.$nr.'-'.$np.'">'.$nb.' ('.$nr.') a/n '.$np.'</option>
                                    ';
                                }
                                ?>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <p>Bank Pengirim (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="bank_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="bank_pengirim" placeholder="Bank Pengirim" required>
                        </div>
                        <p>No Rekening Pengirim (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="no_rek_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="no_rek_pengirim" placeholder="No Rekening Pengirim" required>
                        </div>
                        <p>Nama Pengirim Sesuai Rekening (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="nama_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="nama_pengirim" placeholder="Nama Pengirim Sesuai Rekening" required>
                        </div>
                        <p>Tanggal Transfer (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="tanggal_transfer" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="date" name="tanggal_transfer" required>
                        </div>
                        <p>Bukti Transfer (Wajib diisi)</p>
                        <div class="bor8 how-pos4-parent">
                            <input id="bukti_transfer" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="file" name="bukti_transfer" required>
                        </div>
                        <span>File didukung: .jpeg, .jpg dan .png</span>
                        <p class="m-t-20 ">Catatan Tambahan (Opsional)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                        <textarea id="catatan" class="stext-111 cl2 plh3 size-textarea p-lr-28 p-tb-25" name="catatan"></textarea>
                        </div>
                        <button id="kirim-konfirmasi" type="submit" name="kirim-konfirmasi" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
}else {
    ?>
    <!-- breadcrumb -->
    <div id="breadcrumb" class="container">
        <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
            Home
        </a>
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        <span class=" cl4">
            Konfirmasi Pembayaran
        </span>
    </div>

    <div class="container p-t-20 p-b-20">
        <div class="p-lr-40 p-t-30 p-b-40">
            <div class="row bor10 p-t-20 p-b-20">
                <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                    <p>Kami menerima pembayaran Transfer Bank di Indonesia dengan berbagai cara, diantaranya adalah melalui Internet Banking, Transfer ATM, m-Banking, SMS Banking, Setoran Tunai maupun Phone Banking. Semua pembayaran produk dapat dilakukan melalui rekening bank berikut ini:</p>
                    <div class="p-t-20 p-b-20 p-l-20 p-r-20">
                    <ul>
                    <?php
                    $query = $mysqli->query("SELECT * FROM rekening_bank");
                    while($data = $query->fetch_array()){
                        $nb = $data['nama_bank'];
                        $nr = $data['no_rek'];
                        $np = $data['nama_pemilik'];

                        echo '
                        <li>
                            <p>
                                <b>'.$nb.'</b>
                                <br>
                                No Rekening: '.$nr.'
                                <br>
                                a/n: '.$np.'
                            </p>
                        </li>
                        ';
                    }
                    ?>
                    </ul>
                    </div>
                    <div class="peringatan">
                        <p class="icon-left">
                        <img height="50" width="55" alt="Konfirmasi Pembayaran" src="<?php echo $set['url'];?>images/icons/warning-icon.png">
                        </p>
                        <p class="text">Penting: Harap pastikan hanya melakukan transfer ke salah satu rekening di <?php echo $set['url'];?>. Kami tidak akan pernah meminta Anda untuk membuat permintaan transfer ke rekening lain. Harap berhati-hati terhadap penipuan.</p>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                    <?php
					if(isset($_POST['kirim-konfirmasi'])){
                        $id_pesanan = $_POST['id_pesanan'];
						$bank_tujuan = $_POST['bank_tujuan'];
                        $bank_pengirim = $_POST['bank_pengirim'];
                        $no_rek_pengirim = $_POST['no_rek_pengirim'];
                        $nama_pengirim = $_POST['nama_pengirim'];
						$tanggal_transfer = $_POST['tanggal_transfer'];
						$catatan = $_POST['catatan'];
						$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
						$file = $_FILES['bukti_transfer']['name'];
						$x = explode('.', $file);
						$ekstensi = strtolower(end($x));
						$file_tmp = $_FILES['bukti_transfer']['tmp_name'];

						if(in_array($ekstensi,$ekstensi_diperbolehkan) === true) {
							if(move_uploaded_file($file_tmp, 'images/bukti_tf/'.$file)){
							$kquery = $mysqli->query("INSERT INTO konfirmasi_pembayaran
								(
                                    id_pesanan,
									bank_tujuan,
									bank_pengirim,
									no_rek_pengirim,
									nama_pengirim,
									tanggal_transfer,
									bukti_transfer,
									catatan,
									konfirmasi
								)
								values
								(
                                    '$id_pesanan',
									'$bank_tujuan',
									'$bank_pengirim',
									'$no_rek_pengirim',
									'$nama_pengirim',
									'$tanggal_transfer',
									'$file',
									'$catatan',
									'N'
								)
                            ");
							echo '
							<div class="alert alert-success" role="alert"><b>Success.</b> Bukti Transfer yang Anda upload akan diproses dalam 1x24 jam di jam kerja kami.</div>
                            <script>
                            alert("Success. Bukti Transfer yang Anda upload akan diproses dalam 1x24 jam di jam kerja kami."); 
							</script>
							';
							}
						}else{
							echo '
							<div class="alert alert-danger" role="alert"><b>Sorry!</b> Bukti Transfer yang Anda upload tidak didukung.</div>
							<script>
							alert("Sorry! Bukti Transfer yang Anda upload tidak didukung."); 
							</script>
							';
						}
					}
					?>
                        <p>ID Pesanan (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="id_pesanan" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="id_pesanan" placeholder="ID Pesanan" required>
                        </div>
                        <p>Bank Tujuan (Wajib diisi)</p>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select id="bank_tujuan" class="js-select2" name="bank_tujuan" required>
                                <option value="">Pilih Bank TUjuan</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM rekening_bank");
                                while($data = $query->fetch_array()){
                                    $nb = $data['nama_bank'];
                                    $nr = $data['no_rek'];
                                    $np = $data['nama_pemilik'];

                                    echo '
                                    <option value="'.$nb.'-'.$nr.'-'.$np.'">'.$nb.' ('.$nr.') a/n '.$np.'</option>
                                    ';
                                }
                                ?>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <p>Bank Pengirim (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="bank_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="bank_pengirim" placeholder="Bank Pengirim" required>
                        </div>
                        <p>No Rekening Pengirim (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="no_rek_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="no_rek_pengirim" placeholder="No Rekening Pengirim" required>
                        </div>
                        <p>Nama Pengirim Sesuai Rekening (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="nama_pengirim" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="text" name="nama_pengirim" placeholder="Nama Pengirim Sesuai Rekening" required>
                        </div>
                        <p>Tanggal Transfer (Wajib diisi)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="tanggal_transfer" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="date" name="tanggal_transfer" required>
                        </div>
                        <p>Bukti Transfer (Wajib diisi)</p>
                        <div class="bor8 how-pos4-parent">
                            <input id="bukti_transfer" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="file" name="bukti_transfer" required>
                        </div>
                        <span>File didukung: .jpeg, .jpg dan .png</span>
                        <p class="m-t-20 ">Catatan Tambahan (Opsional)</p>
                        <div class="bor8 m-b-20 how-pos4-parent">
                        <textarea id="catatan" class="stext-111 cl2 plh3 size-textarea p-lr-28 p-tb-25" name="catatan"></textarea>
                        </div>
                        <button id="kirim-konfirmasi" type="submit" name="kirim-konfirmasi" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
include "footer.php";
?>