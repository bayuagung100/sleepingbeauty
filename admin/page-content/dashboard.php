<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=product">
            <div class="info-box">
              
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-camera-retro"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Product</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM product");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
              
            </div>
            </a>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=pesanan">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pesanan</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT count(DISTINCT id_pesanan) as total FROM pembelian");
                $jml = $query->fetch_assoc();
                echo $jml['total'];
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=konfirmasi-pembayaran">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Konfirmasi Pembayaran</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM konfirmasi_pembayaran WHERE konfirmasi='N' ");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=member">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Members</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM member ");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
            </div>
          </a>
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
        <?php
        $link = "?content=pesanan";
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
