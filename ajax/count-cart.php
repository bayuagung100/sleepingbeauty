<?php
session_start();
$sesi = session_id();
include "../admin/config.php";
$dncart = $mysqli->query("SELECT COUNT(*) as total FROM temp_cart WHERE id_session='$sesi'");
$dn = mysqli_fetch_assoc($dncart);

echo $dn['total'];
?>