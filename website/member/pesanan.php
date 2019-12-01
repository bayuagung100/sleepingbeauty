<?php
include "website/header.php";
if(isset($_SESSION['log'])==0){
    header('location:'.$set['url']);
} else {
    if (isset($_GET['id_pesanan'])) {
        echo $_GET['id_pesanan'];
    } else {        
?>
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<a href="<?php echo $set['url']; ?>member/dashboard" class=" cl8 hov-cl1 trans-04">
		Dashboard
	</a>
	<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	<span class=" cl4">
        Pesanan
	</span>
</div>
<div class="container p-t-20 p-b-20">
    <div class="p-lr-40 p-t-30 p-b-40">
        <div class="row p-t-20 p-b-20">
            <div class="col-lg-4 col-xl-4 m-lr-auto m-b-50">
                <div class="m-b-50">
                    <img src="<?php echo $set['url'];?>images/icons/avatar.png" alt="avatar"><span class="m-l-20"><b><?php echo $_SESSION['nama_lengkap'];?></b></span>
                    <a href="<?php echo $set['url'];?>member/logout" class="m-t-30 flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Logout
                    </a>
                </div>
                <div class="menu">
                    <h3 class="m-b-15 menu-title">Menu Anda</h3>
                    <ul>
                        <li>
                        <a href="<?php echo $set['url'];?>member/dashboard">> Dashboard</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/pesanan">> Pesanan</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/profile">> Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                <h3 class="p-b-20">Data Pesanan</h3>
                <p class="cldanger">*Semua pesanan yang statusnya pending terhapus otomatis oleh sistem dalam 1x24 jam.</p>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = $mysqli->query("SELECT * FROM pembelian WHERE id_user='$_SESSION[id]' ");
                        while ($data = $query->fetch_array()) {
                            $id_pesanan = $data['id_pesanan'];
                            $d_product = $data['id_product'];
                            $size = $data['size'];
                            $qty = $data['qty'];
                            $date = $data['date'];
                            $nama = $data['nama'];
                            $email = $data['email'];
                            $tel = $data['tel'];
                            $address = $data['address'];
                            $provinsi = $data['provinsi'];
                            $kabupaten = $data['kabupaten'];
                            $kecamatan = $data['kecamatan'];
                            $kode_pos = $data['kode_pos'];
                            $ekspedisi = $data['ekspedisi'];
                            $service = $data['service'];
                            $payment_method = $data['payment_method'];
                            $subtotal = $data['subtotal'];
                            $total = $data['total'];
                            $total_berat = $data['total_berat'];
                            $status = $data['status'];
                            if ($status=="pending") {
                                $class="cldanger";
                            } else {
                                $class="clgreen";
                            }

                            echo '
                            <tr>
                                <td>'.$id_pesanan.'</td>
                                <td>'.$date.'</td>
                                <td>'.rupiah($total).'</td>
                                <td class="'.$class.'">'.ucwords($status).'</td>
                                <td><a href="'.$set['url'].'member/pesanan/'.$id_pesanan.'" class="lihat-btn hov-btn3">Lihat</td>
                            </tr>
                            ';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
}
?>
<?php
include "website/footer.php";
?>