<?php
session_start();
$sesi = session_id();
include "../admin/config.php";
include "../func/func_date.php";
$ip = $_POST['id'];
$size = $_POST['size'];
$color = $_POST['color'];
$qty = $_POST['qty'];



$cek = mysqli_query($mysqli,"SELECT * FROM temp_cart WHERE id_product='$ip' 
    AND id_session='$sesi' AND size='$size' AND color='$color' ");
$ceking = mysqli_num_rows($cek);

if ($ceking > 0){
    $tambah = mysqli_query($mysqli, "UPDATE temp_cart 
        SET qty = qty + '$qty'
        WHERE id_session='$sesi' AND id_product='$ip'
    ");
}else{
    $query = mysqli_query($mysqli,"INSERT INTO temp_cart
        (
            id_product,
            id_session,
            size,
            color,
            qty,
            date
        )
        VALUES 
        (
            '$ip',
            '$sesi',
            '$size',
            '$color',
            '$qty',
            '$tanggal'
        )
    ");
}



?>