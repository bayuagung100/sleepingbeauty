<?php 
include "website/header.php";
?>
<div class="container p-t-20 p-b-20">
    <div class="p-lr-40 p-t-30 p-b-40">
        <div class="row bor10 p-t-20 p-b-20">
            <div class="col-lg-8 col-xl-8 m-lr-auto m-b-50">
                <div class="text-center">
                    <h3>Lupa Password</h3>
                    <p>Anda dapat mengatur ulang kata sandi Anda di sini</p>
                </div>
                <hr/>
                <!-- <div class="alert alert-danger" role="alert"><b>Sorry!</b> Bukti Transfer yang Anda upload tidak didukung.</div> -->
                <form action="<?php echo $set['url']; ?>member/auth" method="post">
                    <input type="hidden" name="auth" value="lupa-password">
                    <p>Email (Wajib diisi)</p>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="email" class="stext-111 cl2 plh3 size-116 p-l-10 p-r-10" type="email" name="email" placeholder="Email" required>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">Reset Password</button>
                   
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include "website/footer.php";
?>