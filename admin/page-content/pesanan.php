<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=pesanan";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pesanan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Data Pesanan</h3>
                    
                </div>
    ';
        buka_datatables(array("ID Pesanan","Tanggal","Nama","Email","Hp","Status"));
        $no = 1;
        $query = $mysqli->query("SELECT DISTINCT id_pesanan, date, nama, email, tel, status FROM pembelian ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id_pesanan = $data['id_pesanan'];
            $tanggal = $data['date'];
            $nama = $data['nama'];
            $email = $data['email'];
            $hp = $data['tel'];
            $status = ucwords($data['status']);
            detail_datatables($no, array($id_pesanan, $tanggal,$nama,$email,$hp,$status), $link, $id_pesanan);
            $no++;
        }

        tutup_datatables(array("ID Pesanan","Tanggal","Nama","Email","Hp","Status"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if(isset($_GET['id'])){
        $query  = $mysqli->query ( "SELECT * FROM pembelian WHERE id_pesanan='$_GET[id]'");
        $data= $query->fetch_array();
        $aksi   = "Detail";
        }
      
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">'.$aksi.' Pesanan</h3>
                        <a href="' . $link . '" class="btn btn-primary btn-icon-split" style="float: right!important;">
                            <span class="icon text-white-50">
                                <i class="fas fa-angle-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                    <div class="card-body">';
                    // buka_form($link, $data['id_pesanan'], strtolower($aksi));
                    buat_notag("ID Pesanan :", $data['id_pesanan'], 4);
                    buat_rowtabsbuka();
                        buat_label("Nama :",2);
                        buat_col($data['nama'],4);
                        buat_label("Tanggal :",2);
                        buat_col($data['date'],4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Email :",2);
                        buat_col($data['email'],4);
                        buat_label("Hp :",2);
                        buat_col($data['tel'],4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Provinsi :",2);
                        buat_col($data['provinsi'],4);
                        buat_label("Kota / Kabupaten :",2);
                        buat_col($data['kabupaten'],4);
                    buat_rowtabstutup();
                    buat_rowtabsbuka();
                        buat_label("Kecamatan :",2);
                        buat_col($data['kecamatan'],4);
                        buat_label("Kode Pos :",2);
                        buat_col($data['kode_pos'],4);
                    buat_rowtabstutup();
                    buat_tag("Alamat :", $data['address']);
                    echo "<hr>";
                    $service = $data['service'];
                    $pecah = explode("-",$service);
                    $ekspedisi = ucwords($pecah[0]);
                    $layanan = $pecah[1];
                    $ongkir = $pecah[2];
                    buat_tag("Pengiriman :", $ekspedisi." (".$layanan.")");
                    echo "<hr>";

                            // $list = array();
                            // $list[] = array('val'=>'pending', 'cap'=>'Pending');
                            // $list[] = array('val'=>'success', 'cap'=>'Success');
                    // buat_combobox_biasa("Status","status",$list, $data['status']);
                    buat_notag("Status :", $data['status'], 4);
                    if ($data['status']=="success") {
                        $confirm_query = $mysqli->query("SELECT * FROM konfirmasi_pembayaran WHERE id_pesanan='$data[id_pesanan]' ");
                        $confirm_data = $confirm_query->fetch_array();
                        buat_tag("Bukti Transfer :", '<img id="myImg" src="../images/bukti_tf/'.$confirm_data['bukti_transfer'].'" alt="Bukti Transfer" style="width:100%;max-width:300px">');
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
                    }
                    // tutup_form($link);
        echo'                
                    
        ';

            echo'
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th class="text-center">Ukuran</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Berat</th>
                <th class="text-right">Price</th>
                <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody>';
            
            $subtotal = 0;
            $total_berat = 0;
            $pemquery = $mysqli->query("SELECT * FROM pembelian WHERE id_pesanan='$_GET[id]'");
                    while ($dpem = $pemquery->fetch_array()) {
                        $ip = $dpem['id_product'];
                        $size = $dpem['size'];
                        $qty = $dpem['qty'];

                    $pquery = $mysqli->query("SELECT * FROM product WHERE id='$ip' ");
                        while ($data = $pquery->fetch_array()) {
                            $np = $data['product_name'];
                            $harga = $data['product_price'];
                            $berat = $data['product_weight'];
                            
                            $tb = $qty*$berat;
                            $total_berat += $tb;
                            $sub = $qty*$harga;
                            $subtotal += $sub;
                        echo'
                            <tr>
                                <td>'.$np.'</td>
                                <td align="center">'.$size.'</td>
                                <td align="center">'.$qty.'</td>
                                <td align="center">@'.$berat.' gram</td>
                                <td align="right">'.rupiah($harga).'</td>
                                <td align="right">'.rupiah($sub).'<br>@'.$tb.' gram</td>
                            </tr>
                        ';
                        }
                    }
            echo'
            <tr>
                <td colspan="4"></td>
                <td align="right"><b>Subtotal</b></td>
                <td align="right"><b>'.rupiah($subtotal).'</b></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td align="right"><b>Ongkir</b></td>
                <td align="right"><b>'.rupiah($ongkir).'</b></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td align="right"><b>Total</b></td>
                <td align="right"><b>'.rupiah($subtotal+$ongkir).'<br>@'.$total_berat.' gram</br></td>
            </tr>
            </tbody>
            </table>
            </div>
            ';

        echo '
                    <a href="' . $link . '" class="btn btn-primary btn-icon-split" style="float: left!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-angle-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    </div>
                    
                </div>
            </div>
            
        </section>';
    break;
}
?>