<?= $this->load->view('include/bakheader'); ?>
<div class="span10" >
    <div style="display: table;
         width: 100%;">
        <div class="pull-left" style="width: 50%;">
             <h1>Username : <?= $user->Username ?>   </h1>
            <div style="display: table;
         width: 100%;">   
            <div class="pull-left">
        
        <h4> Name</h4>
    <p><?= $user->Name . '  ' . $user->Lastname ?>   </p>
    <h4> Age</h4>
    <p><?= $user->Age ?>   </p>
    <h4> Sex</h4>
    <p><?= ($user->Sex == 'M' ) ? 'Male' : 'Female' ?>   </p>
            </div>
            <div class="pull-right">
    <h4> ID Number</h4>
    <p><?= $user->IDnumber ?>   </p>
    <h4> ID Number</h4>
    <p><?= $user->IDnumber ?>   </p>
     <h4>University</h4>
    <p><?= $user->University ?>   </p>
            </div>
    </div>
     <h4>Address</h4>
     <address>
         <?= $user->Address ?><br/>
         Phone: <?= $user->Telephone ?><br/>
         Mobile phone: <?= $user->Mobile ?><br/>
         Company: <?= $user->Company ?><br/>
         Facebook: <?= $user->Facebook ?><br/>
     </address>
        
        
        </div>
        <div class="pull-right">
            <img  style="height: 300px; width: 300px; " src="<?= base_url('uploads/user_img/' . $user->Photo) ?>" class="img-polaroid">
        </div>  
    </div>
    












</div>
<?= $this->load->view('include/bakfooter'); ?>