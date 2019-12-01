<?php
include "website/header.php";
if(isset($_SESSION['log'])==0){
    header('location:'.$set['url']);
} else {
?>
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    <span class=" cl4">
        Dashboard
    </span>
</div>
<div class="container p-t-20 p-b-20">
    <div class="p-lr-40 p-t-30 p-b-40">
        <div class="row p-t-20 p-b-20">
            <div class="col-lg-4 col-xl-4 m-lr-auto m-b-50">
                <div class="m-b-50">
                    <img src="<?php echo $set['url'];?>images/icons/avatar.png" alt="avatar"><span class="m-l-20"><b><?php echo $_SESSION['nama_lengkap'];?></b></span>
                    <a href="<?php echo $set['url'];?>member/logout" class="m-t-30 flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Logout
                    </a>
                </div>
                <div class="menu">
                    <h3 class="m-b-15 menu-title">Menu Anda</h3>
                    <ul>
                        <li>
                        <a href="<?php echo $set['url'];?>member/dashboard">> Dashboard</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/pesanan">> Pesanan</a>
                        </li>
                        <li>
                        <a href="<?php echo $set['url'];?>member/profile">> Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                <h3 class="p-b-20">Selamat datang, <?php echo $_SESSION['nama_lengkap'];?></h3>
                <p>Di panel ini Anda dapat melihat pesanan terbaru Anda, mengelola pengiriman dan alamat penagihan Anda, dan mengedit kata sandi dan detail akun Anda.</p>
                <div class="row">
                    <div class="col-lg-4 col-xl-4">
                        <a href="<?php echo $set['url'];?>member/pesanan" class="m-t-30 flex-c-m stext-101 cl0 size-107 bg3 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Pesanan
                        </a>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <a href="<?php echo $set['url'];?>member/profile" class="m-t-30 flex-c-m stext-101 cl0 size-107 bg3 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
<?php
include "website/footer.php";
?>