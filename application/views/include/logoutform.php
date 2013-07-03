
<form method="post"  action="<?= site_url('usercontrol/logout') ?>" class="login-form"  >
    <div style="width: auto;" class="clearfix grpelem" id="pu250-4">
        
        Hello  <?= $_SESSION['user']->Name ?>   <?= $_SESSION['user']->Lastname ?>   
    </div>
    <div class="clearfix grpelem" id="pu247">   
    
        <button type="submit" class="btn btn-danger" >Logout</button>
    </div>
</form>