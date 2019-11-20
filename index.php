<?php
session_start();
error_reporting();
ob_start();
include "admin/config.php";
include "func/func_date.php";

$content  = (isset($_GET['content'])) ? $_GET['content'] : "home";
$kosong   = true;
$page     = array('home','product','product-detail','category','category-detail','best-seller','contact','cart');
foreach($page as $pg){
  if($content == $pg and $kosong){
    
      include 'website/'.$pg.'.php';
      $kosong = false;
    
  }
}

if($kosong) include 'website/404.php';
?>
