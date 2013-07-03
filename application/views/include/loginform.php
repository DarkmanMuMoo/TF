<form method="post"  action="<?= site_url('usercontrol/login') ?>" class="login-form"  >
    <div class="clearfix grpelem" id="pu250-4"><!-- column -->
        <img class="colelem" id="u250-4" src="<?= base_url('asset/images/u250-4.png') ?>" alt="ลงชื่อเข้าระบบ" width="104" height="21"><!-- rasterized frame -->
        <input required  class="shadow colelem"  id="u248" type="text"  name="username"  value=""  />
        <a href="<?= site_url('home/application') ?>"   ><img class="colelem" id="u254-4" src="<?= base_url('asset/images/u254-4.png') ?>" alt="ลงทะเบียน" width="71" height="15"></a><!-- rasterized frame -->
    </div>
    <div class="clearfix grpelem" id="pu247"><!-- column -->
        <input required class="shadow colelem" id="u247" type="password"  name="password"  value=""  />
        <a href="<?= site_url('home/resetpassword') ?>"   > <img class="colelem" id="u251-4" src="<?= base_url('asset/images/u251-4.png') ?>" alt="ลืมรหัสผ่าน" width="74" height="15"></a><!-- rasterized frame -->
    </div>

    <button  style="width:70px;" class="rounded-corners clearfix grpelem" id="u249" type="submit" >
        <div class="nonblock nontext grpelem" id="u253-4">
            <img  id="u253-4_img" src="<?= base_url('asset/images/u253-4.png') ?>" alt="log in" width="38" height="17">
        </div>
    </button>
</form>    