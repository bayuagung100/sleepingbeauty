<?php
include "../admin/config.php";
include "../func/func_date.php";
$sesi = $_POST['sesi'];
$id_pesanan = $_POST['id_pesanan'];
$subtotal = $_POST['subtotal'];
$weight = $_POST['weight'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kecamatan = $_POST['kecamatan'];
$postcode = $_POST['postcode'];
$ekspedisi = $_POST['ekspedisi'];
$service = $_POST['service'];
$payment_method = $_POST['payment_method'];
$pecah = explode("-",$service);
$total = $subtotal+$pecah[2];


$query = mysqli_query($mysqli,"SELECT * FROM temp_cart WHERE id_session='$sesi' ");

while ($data = mysqli_fetch_array ($query)) {   
    $tid = $data['id'];
    $tip = $data['id_product'];
    $tz = $data['size'];
    $tc = $data['color'];
    $tq = $data['qty'];
    $td = $data['date'];
    

    $insuser = mysqli_query($mysqli, "INSERT INTO pembelian
        (
            id_session,
            id_pesanan,
            id_product,
            size,
            color,
            qty,
            date,
            nama,
            email,
            tel,
            address,
            provinsi,
            kabupaten,
            kecamatan,
            kode_pos,
            ekspedisi,
            service,
            payment_method,
            subtotal,
            total,
            total_berat,
            status

        )
        values
        (
            '$sesi',
            '$id_pesanan',
            '$tip',
            '$tz',
            '$tc',
            '$tq',
            '$td',
            '$name',
            '$email',
            '$tel',
            '$address',
            '$provinsi',
            '$kabupaten',
            '$kecamatan',
            '$postcode',
            '$ekspedisi',
            '$service',
            '$payment_method',
            '$subtotal',
            '$total',
            '$weight',
            'pending'
        )
    ");
    if ($insuser) {
        $deltemp = mysqli_query($mysqli,"DELETE FROM temp_cart WHERE id='$tid' AND id_session='$sesi' ");
    }
}
$mail_tagihan = strip_tags(htmlspecialchars($id_pesanan));
$mail_name = strip_tags(htmlspecialchars($name));
$mail_email_address = strip_tags(htmlspecialchars($email));
$mail_phone = strip_tags(htmlspecialchars($tel));

$query2 = mysqli_query($mysqli,"SELECT * FROM pembelian WHERE id_pesanan='$id_pesanan' ");
$dtpem = mysqli_fetch_array ($query2);

// Create the email and send the message
$to = $email; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Tagihan Telah Dibuat";
$email_body = "Halo, $mail_name!\n\n";
$email_body .= "Email ini adalah pemberitahuan Tagihan Anda yang dibuat pada $dtpem[date]\n\n";
$email_body .= "ID Pesanan: $id_pesanan\n\n";
$email_body .= "Order Details: \n\n";
$query3 = mysqli_query($mysqli,"SELECT * FROM pembelian WHERE id_pesanan='$id_pesanan' ");
while ($mail = mysqli_fetch_array($query3)) {
    $mip = $mail['id_product'];
    $mj = $mail['qty'];
    $mu = $mail['size'];
    $mc = $mail['color']
    $mquery = mysqli_query($mysqli,"SELECT * FROM product WHERE id='$mip' ");
    while ($dquery = mysqli_fetch_array($mquery)) {
        $dqnp = $dquery['product_name'];
        $dqh = $dquery['product_price'];
        $dqb = $dquery['product_weight'];

        $ib = $mj*$dqb;
        $it = $mj*$dqh;

        $email_body .= "- $dqnp\n";
        $email_body .= "Ukuran: $mu\n";
        $email_body .= "Warna: $mc\n";
        $email_body .= "Berat: ".$dqb."(gram) x ".$mj." = ".$ib."(gram)\n";
        $email_body .= "Harga: ".rupiah($dqh)." x ".$mj." = ".rupiah($it)."\n\n";

    }
}
$email_body .= "Subtotal: ".$subtotal."\n";
$email_body .= "Ongkir: ".rupiah($pecah[2])." melalui $ekspedisi $pecah[1] -> $kecamatan @ $weight gram\n";
$email_body .= "Payment Method: Bank ".$payment_method." - \n";
$email_body .= "Total: ".rupiah($total)."\n\n";
$email_body .= "----------------------------------------------------------------------\n\n";
$email_body .= "Anda dapat melakukan pembayaran ke rekening kami, sebagai berikut:\n";
$email_body .= "*Mohon sertakan ID Pesanan, untuk konfirmasi pembayaran.\n\n";
$bankquery = mysqli_query($mysqli,"SELECT * FROM rekening_bank");
while ($b = mysqli_fetch_array($bankquery)) {
    $nama_bank = $b['nama_bank'];
    $no_rek = $b['no_rek'];
    $nama_pemilik = $b['nama_pemilik'];

    $email_body .= "- $nama_bank\n";
    $email_body .= "No Rekening: $no_rek\n";
    $email_body .= "a/n: $nama_pemilik\n\n";
}
$email_body .= "\n\n\n";
$email_body .= "Terima Kasih.\n";
$email_body .= "www.sleepingbeauty.co.id";
$headers = "From: sbeauty@erolperkasamandiri.co.id\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $mail_email_address";
mail($to,$email_subject,$email_body,$headers);
?>