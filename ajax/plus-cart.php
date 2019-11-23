<?php
session_start();
$sesi = session_id();
include "../admin/config.php";
$ip = $_POST['id'];

$cek = mysqli_query($mysqli, "SELECT * FROM temp_cart WHERE id_product='$ip' 
    AND id_session='$sesi'");
$ceking = mysqli_fetch_array($cek);

$query = mysqli_query($mysqli, "UPDATE temp_cart 
        SET qty = qty + 1
        WHERE id_session='$sesi' AND id_product='$ip'
    ");
?>
