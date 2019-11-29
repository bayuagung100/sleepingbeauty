<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=konfirmasi-pembayaran";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfirmasi Pembayaran</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Konfirmasi Pembayaran</h3>
                    
                </div>
    ';
        buka_datatables(array("ID Pesanan","Tanggal Transfer","Nama Pengirim","Bank Pengirim","Bank Tujuan","Catatan","Status"));
        $no = 1;
        $query = $mysqli->query("SELECT DISTINCT id_pesanan,bank_tujuan,bank_pengirim,no_rek_pengirim,nama_pengirim,tanggal_transfer,bukti_transfer,catatan,konfirmasi FROM konfirmasi_pembayaran WHERE konfirmasi='N' ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id_pesanan = $data['id_pesanan'];
            $bank_tujuan = $data['bank_tujuan'];
            $bank_pengirim = $data['bank_pengirim'];
            $no_rek_pengirim = $data['no_rek_pengirim'];
            $nama_pengirim = $data['nama_pengirim'];
            $tanggal_transfer = $data['tanggal_transfer'];
            $bukti_transfer = $data['bukti_transfer'];
            $catatan = $data['catatan'];
            $konfirmasi = $data['konfirmasi'];

            if ($konfirmasi="N") {
                $status = "Belum Dikonfirmasi";
            }
            
            isi_datatables($no, array($id_pesanan,$tanggal_transfer,$nama_pengirim,$bank_pengirim." - ".$no_rek_pengirim,$bank_tujuan,$catatan,$status), $link, $id_pesanan);
            $no++;
        }

        tutup_datatables(array("ID Pesanan","Tanggal Transfer","Nama Pengirim","Bank Pengirim","Bank Tujuan","Catatan","Status"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if(isset($_GET['id'])){
        $query  = $mysqli->query ( "SELECT * FROM konfirmasi_pembayaran WHERE id_pesanan='$_GET[id]'");
        $data= $query->fetch_array();
        $aksi   = "Detail";
        }
      
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">'.$aksi.' Konfirmasi</h3>
                    </div>
                    <div class="card-body">';
                    buka_form($link, $data['id_pesanan'], strtolower($aksi));
                    buat_notag("ID Pesanan :", $data['id_pesanan'], 4);
                    buat_rowtabsbuka();
                        buat_label("Nama Pengirim:",2);
                        buat_col($data['nama_pengirim'],4);
                        buat_label("Tanggal Transfer:",2);
                        buat_col($data['tanggal_transfer'],4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Bank Pengirim :",2);
                        buat_col($data['bank_pengirim'],4);
                        buat_label("Rekening Pengirim :",2);
                        buat_col($data['no_rek_pengirim'],4);
                    buat_rowtabstutup();
                    buat_tag("Catatan :", $data['catatan']);
                    buat_tag("Bukti Transfer :", '<img id="myImg" src="../images/bukti_tf/'.$data['bukti_transfer'].'" alt="Bukti Transfer" style="width:100%;max-width:300px">');
                    echo "<hr>";
                    echo'
                        <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                    ';
                    echo'
                    <script>
                        // Get the modal
                        var modal = document.getElementById("myModal");

                        // Get the image and insert it inside the modal - use its "alt" text as a caption
                        var img = document.getElementById("myImg");
                        var modalImg = document.getElementById("img01");
                        var captionText = document.getElementById("caption");
                        img.onclick = function(){
                        modal.style.display = "block";
                        modalImg.src = this.src;
                        captionText.innerHTML = this.alt;
                        }

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() { 
                        modal.style.display = "none";
                        }
                    </script>
                    ';

                    $bt = $data['bank_tujuan'];
                    $pecah = explode("-",$bt);
                    $nama_bank = $pecah[0];
                    $no_rek = $pecah[1];
                    $nama_pemilik = $pecah[2];
                    buat_tag("Bank Tujuan :", $nama_bank." (".$no_rek.") a/n ".$nama_pemilik,6);

                    $list = array();
                    $list[] = array('val'=>'N', 'cap'=>'Belum Dikonfirmasi');
                    $list[] = array('val'=>'Y', 'cap'=>'Konfirmasi');
                    buat_combobox_biasa("Edit Status","status",$list, $data['konfirmasi']);
                    tutup_form($link);
        

        echo '
                    </div>
                </div>
            </div>
            
        </section>';
    break;

    case "action":
        $status	= $_POST['status'];
    
    
        $query  = $mysqli->query ( "UPDATE konfirmasi_pembayaran SET
        konfirmasi    = '$status'
        WHERE id_pesanan='$_POST[id]'
        ");
        $query2  = $mysqli->query ( "UPDATE pembelian SET
        status    = 'success'
        WHERE id_pesanan='$_POST[id]'
        ");

        
        header('location:'.$link);
      break;
      
      //Menghapus data di database
      case "delete":
  
        $query = $mysqli->query("DELETE FROM konfirmasi_pembayaran WHERE id_pesanan='$_GET[id]'");
  
        header('location:'.$link);
      break;
}
?>