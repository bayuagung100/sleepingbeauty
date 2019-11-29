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
            isi_datatables($no, array($id_pesanan, $tanggal,$nama,$email,$hp,$status), $link, $id_pesanan);
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
                    </div>
                    <div class="card-body">';
                    buka_form($link, $data['id_pesanan'], strtolower($aksi));
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

                            $list = array();
                            $list[] = array('val'=>'pending', 'cap'=>'Pending');
                            $list[] = array('val'=>'success', 'cap'=>'Success');
                    buat_combobox_biasa("Edit Status","status",$list, $data['status']);
                    tutup_form($link);
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
                <th class="text-right">Price</th>
                <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody>';
            
            $total=0;
            $pemquery = $mysqli->query("SELECT * FROM pembelian WHERE id_pesanan='$_GET[id]'");
                    while ($dpem = $pemquery->fetch_array()) {
                        $ip = $dpem['id_product'];
                        $size = $dpem['size'];
                        $qty = $dpem['qty'];

                    $pquery = $mysqli->query("SELECT * FROM product WHERE id='$ip' ");
                        while ($data = $pquery->fetch_array()) {
                            $np = $data['product_name'];
                            $harga = $data['product_price'];
                            
                            $sub = $qty*$harga;
                        $total += $sub;
                        echo'
                            <tr>
                                <td>'.$np.'</td>
                                <td align="center">'.$size.'</td>
                                <td align="right">'.$qty.'</td>
                                <td align="right">'.rupiah($harga).'</td>
                                <td align="right">'.rupiah($sub).'</td>
                            </tr>
                        ';
                        }
                    }
            echo'
            <tr>
                <td colspan="3"></td>
                <td align="right"><b>Total</b></td>
                <td align="right"><b>'.rupiah($total).'</b></td>
            </tr>
            </tbody>
            </table>
            </div>
            ';

        echo '
                    </div>
                </div>
            </div>
        </section>';
    break;
        
    case "action":
        $status	= $_POST['status'];
  
  
        $query  = $mysqli->query ( "UPDATE pembelian SET
        status    = '$status'
        WHERE id_pesanan='$_POST[id]'
        ");
        
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM pembelian WHERE id_pesanan='$_GET[id]'");
        header('location:'.$link);
        break;
}
?>