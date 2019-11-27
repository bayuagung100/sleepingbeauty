<?php
//server hosting
$servername = "localhost";
$username = "u328098603_sb";
$password = "lalaLand123";
$database = "u328098603_sb"; 

//local-server
// $servername = "sql261.main-hosting.eu";
// $username = "u328098603_sb";
// $password = "lalaLand123";
// $database = "u328098603_sb";

//localpc
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "sleepingbeauty";
 
// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);


//Menentukan timezone //
date_default_timezone_set('Asia/Jakarta'); 

//Membuat variabel yang menyimpan nilai waktu //
$nama_hari 	= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari		= date("w");
$hari_ini 	= $nama_hari[$hari];

$tgl_sekarang = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");

$tanggal 	= date("Y-m-d");  
$jam 		= date("H:i:s");

$query = $mysqli->query("SELECT * FROM setting");
$set = $query->fetch_array();

function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit)).' ...';
}	
function convert_seo($kata) {
    $simbol = array ('-','/','\\',',','.','#',':',';','\',','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	
	//Menghilangkan simbol pada array $simbol
    $kata = str_replace($simbol, '', $kata); 
	//Ubah ke huruf kecil dan mengganti spasi dengan (-)
    $kata = strtolower(str_replace(' ', '-', $kata)); 
    
	return $kata;
}

// Fungsi untuk membuat paginasi halaman
function buat_paging($link1, $link2, $batas, $jmldata, $halaktif){
    global $mysqli;
    $query = $mysqli->query("SELECT * FROM setting");
    $set = $query->fetch_array();
	$link1 = $set["url_website"].'program?'.$link1;
	$jmlhalaman = ceil($jmldata/$batas);
	$class = 'btn btn-sm btn-default';
	$link_halaman = '';	
	$link_halaman .= '<div style="text-align: center">';
	
	// Link ke halaman pertama (first) dan sebelumnya (prev)
	if($halaktif > 1){
		$prev = $halaktif-1;
		$link_halaman .= '<a href="'.$link1.'=1'.$link2.'" class="'.$class.'"><< First </a>  
						  <a href="'.$link1.'='.$prev.$link2.'" class="'.$class.'">< Prev </a>';
	}
	else{ 
		$link_halaman .= '<a href="#" class="'.$class.' disabled"><< First </a>  
						  <a href="#" class="'.$class.' disabled">< Prev </a>';
	}

	// Link halaman 1,2,3, ...
	$angka = ($halaktif > 3 ? "...  " : " "); 
	for ($i=$halaktif-2; $i<$halaktif; $i++){
		if ($i < 1) continue;
		$angka .= '<a href="'.$link1.'='.$i.$link2.'" class="'.$class.'">'.$i.'</a> ';
	}
	
	$angka .= '<a href="" class="btn btn-sm btn-primary disabled">'.$halaktif.'</a> ';
	  
    for($i=$halaktif+1; $i<($halaktif+3); $i++){
		if($i > $jmlhalaman) break;
		$angka .= '<a href="'.$link1.'='.$i.$link2.'" class="'.$class.'">'.$i.'</a> ';
	}
	
	$angka .= ($halaktif+2<$jmlhalaman ? '... <a href="'.$link1.'='.$jmlhalaman.$link2.'" class="'.$class.'">'.$jmlhalaman.'</a> ' : ' ');

	$link_halaman .= $angka;

	// Link ke halaman berikutnya (Next) dan terakhir (Last) 
	if($halaktif < $jmlhalaman){
		$next = $halaktif+1;
		$link_halaman .= '<a href="'.$link1.'='.$next.$link2.'" class="'.$class.'"> Next > </a>  
						  <a href="'.$link1.'='.$jmlhalaman.$link2.'" class="'.$class.'"> Last >> </a>';
	}
	else{
		$link_halaman .= '<a href="#" class="'.$class.' disabled"> Next > </a>  
						  <a href="#" class="'.$class.' disabled"> Last >> </a>';
	}
	
	$link_halaman .= '</div>';
	echo $link_halaman;
}

function metaheader()
{
    global $mysqli;
    $content = (isset($_GET['content'])) ? $_GET['content'] : "home";
    $home = $mysqli->query("SELECT * FROM setting");
    $h = $home->fetch_array();
    if($content=="home"){
    echo'
    <title>'.$h["judul_website"].'</title>
    <meta name="description" content="'.$h["deskripsi"].'" />
    <link rel="canonical" href="'.$h["url"].'" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="'.$h["judul_website"].'" />
    <meta property="og:description" content="'.$h["deskripsi"].'" />
    <meta property="og:url" content="'.$h["url"].'" />
    <meta property="og:site_name" content="'.$h["judul_website"].'" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="'.$h["judul_website"].'" />
    <meta name="twitter:description" content="'.$h["deskripsi"].'" />
    ';
    }elseif($content=="product"){
    $product = $mysqli->query("SELECT * FROM product WHERE id=$_GET[id]");
    $p = $product->fetch_array();
    echo'
    <title>'.$p["nama_product"].' | '.$h["judul_website"].'</title>
    <meta name="description" content="'.str_replace('"',"",$p["deskripsi"]).'" />
    <link rel="canonical" href="'.$h["url"].'product/'.$p["id"].'/detail/" />
    <meta property="og:type" content="product" />
    <meta property="og:title" content="'.$p["nama_product"].' | '.$h["judul_website"].'" />
    <meta property="og:image" content="'.$h["url"].'media/source/'.$p["gambar"].'">
    <meta property="og:description" content="'.str_replace('"',"",$p["deskripsi"]).'" />
    <meta property="og:url" content="'.$h["url"].'product/'.$p["id"].'/detail/" />
    <meta property="og:site_name" content="'.$h["judul_website"].'" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="'.$p["nama_product"].' | '.$h["judul_website"].'" />
    <meta name="twitter:image" content="'.$h["url"].'media/source/'.$p["gambar"].'" />
    <meta name="twitter:description" content="'.str_replace('"',"",$p["deskripsi"]).'" />
    ';
    }elseif($content=="product-all"){
    echo'
    <title>Jual Baju dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'</title>
    <meta name="description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <link rel="canonical" href="'.$h["url"].'product/" />
    <meta property="og:type" content="product.group" />
    <meta property="og:title" content="Jual Baju dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'" />
    <meta property="og:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <meta property="og:url" content="'.$h["url"].'product/" />
    <meta property="og:site_name" content="'.$h["judul_website"].'" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Jual Baju dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'" />
    <meta name="twitter:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    ';
    }elseif($content=="category-all"){
    echo'
    <title>Jual Baju, Hijab, Cadar dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'</title>
    <meta name="description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <link rel="canonical" href="'.$h["url"].'category/" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="Jual Baju, Hijab, Cadar dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'" />
    <meta property="og:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <meta property="og:url" content="'.$h["url"].'category/" />
    <meta property="og:site_name" content="'.$h["judul_website"].'" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Jual Baju, Hijab, Cadar dan Perlengkapan Syar'."'".'i Wanita | '.$h["judul_website"].'" />
    <meta name="twitter:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    ';
    }elseif($content=="category"){
    $category = $mysqli->query("SELECT * FROM cat_product WHERE id=$_GET[id]");
    $c = $category->fetch_array();
    echo'
    <title>'.$c["nama_cp"].' | '.$h["judul_website"].'</title>
    <meta name="description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <link rel="canonical" href="'.$h["url"].'category/'.$c["id"].'/'.strtolower(str_replace(array(' ','/'), '-',$c["nama_cp"])).'" />
    <meta property="og:type" content="product.group" />
    <meta property="og:title" content="'.$c["nama_cp"].' | '.$h["judul_website"].'" />
    <meta property="og:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    <meta property="og:url" content="'.$h["url"].'category/'.$c["id"].'/'.strtolower(str_replace(array(' ','/'), '-',$c["nama_cp"])).'" />
    <meta property="og:site_name" content="'.$h["judul_website"].'" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="'.$c["nama_cp"].' | '.$h["judul_website"].'" />
    <meta name="twitter:description" content="Beli perlengkapan syar'."'".'i wanita dan baju muslim wanita & remaja wanita modern model terbaru di '.$h["judul_website"].'" />
    ';
    }
}




?> 
