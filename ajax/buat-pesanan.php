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

    $to = $email;
    $subject = "Pesanan Anda telah dibuat!";

    $message = include "../mail/buat-pesanan.php";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <sbeauty@erolperkasamandiri.co.id>' . "\r\n";
    $headers .= 'Cc: smileyoudontcry100@gmail.com' . "\r\n";

    mail($to,$subject,$message,$headers);

?>