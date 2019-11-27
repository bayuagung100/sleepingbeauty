<?php
include "header.php";
?>  
<?php
$query = $mysqli->query("SELECT * FROM pembelian WHERE id_session='$sesi' ORDER BY id DESC ");
$data = $query->fetch_array();
$jml = $query->num_rows;
$id_pesanan = $data['id_pesanan'];
$tanggal = $data['date'];
$nama = $data['nama'];
$email = $data['email'];
$hp = $data['tel'];
$alamat = $data['address'];
$provinsi = $data['provinsi'];
$kabupaten = $data['kabupaten'];
$kecamatan = $data['kecamatan'];
$kode_pos = $data['kode_pos'];
$subtotal = $data['subtotal'];
$grandtotal = $data['total'];
$payment_method = $data['payment_method'];
$pecah = explode("-",$payment_method);
$bank = $pecah[0];
$norek = $pecah[1];
$pemilik_rek = $pecah[2];
$service = $data['service'];
$pecah2 = explode("-",$service);
$layanan = $pecah2[1];
$ongkir = $pecah2[2];
$ekspedisi = strtoupper($data['ekspedisi']);
$kecamatan = $data['kecamatan'];
$total_berat = $data['total_berat'];
if ($jml > 0) {
    $to = $email;
    $subject = "HTML email";

    $message = "
    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    <p>This email contains HTML Tags!</p>
    <table>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    </tr>
    <tr>
    <td>John</td>
    <td>Doe</td>
    </tr>
    </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <sbeauty@erolperkasamandiri.co.id>' . "\r\n";
    $headers .= 'Cc: smileyoudontcry100@gmail.com' . "\r\n";

    mail($to,$subject,$message,$headers);
    // $mail_tagihan = strip_tags(htmlspecialchars($id_pesanan));
    // $mail_name = strip_tags(htmlspecialchars($nama));
    // $mail_email_address = strip_tags(htmlspecialchars($email));
    // $mail_phone = strip_tags(htmlspecialchars($hp));

    // $query2 = mysqli_query($mysqli,"SELECT * FROM pembelian WHERE id_pesanan='$id_pesanan' ");
    // $dtpem = mysqli_fetch_array ($query2);

    // // Create the email and send the message
    // $to = $email; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    // $email_subject = "Tagihan Telah Dibuat";
    // $email_body = "Halo, $mail_name!\n\n";
    // $email_body .= "Email ini adalah pemberitahuan Tagihan Anda yang dibuat pada $dtpem[date]\n\n";
    // $email_body .= "ID Pesanan: $id_pesanan\n\n";
    // $email_body .= "Order Details: \n\n";
    // while ($mail = mysqli_fetch_array($query2)) {
    //     $mip = $mail['id_product'];
    //     $mj = $mail['qty'];
    //     $mu = $mail['size'];
    //     $mc = $mail['color']
    //     $mquery = mysqli_query($mysqli,"SELECT * FROM product WHERE id='$mip' ");
    //     while ($dquery = mysqli_fetch_array($mquery)) {
    //         $dqnp = $dquery['product_name'];
    //         $dqh = $dquery['product_price'];
    //         $dqb = $dquery['product_weight'];

    //         $ib = $mj*$dqb;
    //         $it = $mj*$dqh;

    //         $email_body .= "- $dqnp\n";
    //         $email_body .= "Ukuran: $mu\n";
    //         $email_body .= "Warna: $mc\n";
    //         $email_body .= "Berat: ".$dqb."(gram) x ".$mj." = ".$ib."(gram)\n";
    //         $email_body .= "Harga: ".rupiah($dqh)." x ".$mj." = ".rupiah($it)."\n\n";

    //     }
    // }
    // $email_body .= "Subtotal: ".$subtotal."\n";
    // $email_body .= "Ongkir: ".rupiah($ongkir)." melalui $ekspedisi $layanan -> $kecamatan @ $total_berat gram\n";
    // $email_body .= "Payment Method: Bank ".$payment_method." - \n";
    // $email_body .= "Total: ".rupiah($grandtotal)."\n\n";
    // $email_body .= "----------------------------------------------------------------------\n\n";
    // $email_body .= "Anda dapat melakukan pembayaran ke rekening kami, sebagai berikut:\n";
    // $email_body .= "*Mohon sertakan ID Pesanan, untuk konfirmasi pembayaran.\n\n";
    // $bankquery = mysqli_query($mysqli,"SELECT * FROM rekening_bank");
    // while ($b = mysqli_fetch_array($bankquery)) {
    //     $nama_bank = $b['nama_bank'];
    //     $no_rek = $b['no_rek'];
    //     $nama_pemilik = $b['nama_pemilik'];

    //     $email_body .= "- $nama_bank\n";
    //     $email_body .= "No Rekening: $no_rek\n";
    //     $email_body .= "a/n: $nama_pemilik\n\n";
    // }
    // $email_body .= "\n\n\n";
    // $email_body .= "Terima Kasih.\n";
    // $email_body .= "www.sleepingbeauty.co.id";
    // $headers = "From: sbeauty@erolperkasamandiri.co.id\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    // $headers .= "Reply-To: $mail_email_address";
    // mail($to,$email_subject,$email_body,$headers);
?>
<div class="container m-t-50 m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40">
        <h4 class="text-center mtext-109 cl2">Terima kasih.<br>Pesanan Anda telah dibuat.</h4>
        <hr>
        <div class="row">
            <div class="col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <ul class="borcard p-t-20 p-b-20 p-l-20 p-r-20">
                    <li>
                        ID Pesanan: <span id="id-pesanan" class="stext-110 cl2"><?php echo $id_pesanan;?></span>
                    </li>
                    <li>
                        Tanggal: <span class="stext-110 cl2"><?php echo tgl_indonesia($tanggal);?></span>
                    </li>
                    <li>
                        Nama: <span class="stext-110 cl2"><?php echo $nama;?></span>
                    </li>
                    <li>
                        Email: <span class="stext-110 cl2"><?php echo $email;?></span>
                    </li>
                    <li>
                        No Hp: <span class="stext-110 cl2"><?php echo $hp;?></span>
                    </li>
                    <li>
                        Total: <span class="stext-110 cl2"><?php echo rupiah($grandtotal);?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <p>Lakukan pembayaran langsung ke rekening bank <?php echo $bank;?> kami. Silahkan Gunakan <b>ID Pesanan</b> Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana telah Kami terima. </p>
                <div class="text-center notifdanger m-t-10 cl2">*Pastikan Anda transfer sebelum 1x24 jam atau transaksi Anda akan dibatalkan secara otomatis oleh sistem.</div>
                <p class="text-center p-t-20 cl2">Setelah Anda melakukan pembayaran harap melakukan <b>KONFIRMASI PEMBAYARAN</b> melalui link dibawah ini.</p>
                <div id="konfirmasi-pembayaran" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        KONFIRMASI PEMBAYARAN
                    </div>
            </div>
            
            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                <h4 class="mtext-109 cl2">Detail pembayaran</h4>
                <ul>
                    <li>
                        Bank Tujuan: <span class="stext-110 cl2">Bank <?php echo $bank;?></span>
                    </li>
                    <li>
                        No Rekening Tujuan: <span class="stext-110 cl2"><?php echo $norek;?></span>
                    </li>
                    <li>
                        Nama Pemilik: <span class="stext-110 cl2"><?php echo $pemilik_rek;?></span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                <h4 class="mtext-109 cl2">Order Details</h4>
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                    <tbody>
                        <tr class="table_head">
                            <th class="column-1 p-l-50">Product</th>
                            <th class="column-2"></th>
                            <th class="column-3">Price</th>
                            <th class="column-4">Quantity</th>
                            <th class="column-5">Total</th>
                        </tr>
                        <?php 
                        
                        $query2 = $mysqli->query("SELECT * FROM pembelian WHERE id_session='$sesi' AND id_pesanan='$id_pesanan'  ");
                        while ($data2 = $query2->fetch_array()) {
                            $ip = $data2['id_product'];
                            $qty = $data2['qty'];
                            
                            $total=0;
                            $totalberat=0;
                            $query3 = $mysqli->query("SELECT * FROM product WHERE id='$ip' ");
                            while ($data3 = $query3->fetch_array()) {
                                $pn = $data3['product_name'];
                                $pc = $data3['product_price'];
                                $pw = $data3['product_weight'];
                                $pi = $data3['product_image1'];

                                $ib = $qty*$pw;
                                $it = $qty*$pc;
                                $total += $it;
                                $totalberat += $ib;

                                echo '
                                <tr class="table_row">
                                    <td class="column-1 p-l-50">
                                        <div class="how-itemcart1">
                                            <img src="'.$set['url'].'images/source/'.$pi.'" alt="'.$pn.'">
                                        </div>
                                    </td>
                                    <td class="column-2">'.$pn.'<br>@'.$pw.' gram</td>
                                    <td class="column-3">'.rupiah($pc).'</td>
                                    <td class="column-4">'.$qty.'</td>
                                    <td class="column-5">'.rupiah($total).'<br>@'.$totalberat.' gram</td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                        <tr>
                            <td class="p-l-50">Subtotal:</td>
                            <td class="column-5" colspan="4"><b><?php echo rupiah($subtotal);?></b></td>
                        </tr>
                        <tr>
                            <td class="p-l-50">Ongkir:</td>
                            <td class="column-5" colspan="4"><b><?php echo rupiah($ongkir);?></b> melalui <?php echo $ekspedisi;?> <?php echo $layanan;?> -> <?php echo $kecamatan;?> @<?php echo $total_berat;?>gram</td>
                        </tr>
                        <tr>
                            <td class="p-l-50">Payment Method:</td>
                            <td class="column-5" colspan="4">Bank <?php echo $bank;?></td>
                        </tr>
                        <tr>
                            <td class="p-l-50">Total:</td>
                            <td class="column-5" colspan="4"><b><?php echo rupiah($grandtotal);?></b> @<?php echo $total_berat;?>gram</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                <h4 class="mtext-109 cl2">Alamat Penagihan</h4>
                <p><?php echo $nama;?></p>
                <p><?php echo $alamat;?></p>
                <p><?php echo $kecamatan;?>, <?php echo $kabupaten;?></p>
                <p><?php echo $provinsi;?></p>
                <p><?php echo $kode_pos;?></p>
            </div>

        </div>
    </div>
</div>
<?php
} else {
    echo'
    <script>
    window.location = "'.$set['url'].'";
    </script>
    ';
}
include "footer.php";
?>