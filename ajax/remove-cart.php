<?php
session_start();
$sesi = session_id();
include "../admin/config.php";
$ip = $_POST['id'];

$query = $mysqli->query("DELETE FROM temp_cart WHERE id_product='$ip' AND id_session='$sesi' ");

?>