<?= $this->load->view('include/header'); ?>


<div class="wraper">
    <?= ($this->upload->display_errors()=='')?'':$this->upload->display_errors('<div style="margin-top: 20px;" class="alert alert-error">','</div>')   ?>
    <?php echo validation_errors('<div style="margin-top: 20px;" class="alert alert-error">', '</div>'); ?>
    <form id="application-form" action="<?=  site_url('home/register') ?>" method="post"  enctype="multipart/form-data"    class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Application</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Name</label>
  <div class="controls">
    <input id="Name" name="Name" type="text" placeholder="Name" class="input-xlarge" required>
   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Lastname</label>
  <div class="controls">
    <input id="Lastname" name="Lastname" type="text" placeholder="Lastname" class="input-xlarge" required>
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">ID Card</label>
  <div class="controls">
    <input id="ID_Card" name="ID_Card" type="text" placeholder="ID Card" class="input-xlarge" required>
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Email</label>
  <div class="controls">
      <div  class="input-append">  
    <input id="Email" name="Email" type="email" placeholder="Email" class="input-xlarge" required >
    
    <button class="btn" type="button" onclick="App.checkemail();" >
          Validate Email
          
        </button>
      
    </div>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="control-group">
  <label class="control-label">SEX</label>
  <div class="controls">
    <label class="radio inline">
      <input type="radio" name="sex" value="M" checked="checked">
      Male
    </label>
    <label class="radio inline">
      <input type="radio" name="sex" value="F">
      Female
    </label>
      
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Age</label>
  <div class="controls">
      <input id="age" name="age" type="number" placeholder="Age" class="input-xlarge" required>
  
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label">Educational institution</label>
  <div class="controls">
     <?=$univerdropdown ?>
      <input type="text"  id="otherU" name="otherU" style="display:none" >
  </div>
</div>

<!-- File Button --> 
<div class="control-group">
  <label class="control-label">Personal Photo</label>
  <div class="controls">
      <input id="photo" name="photo" class="input-file" type="file" required>
      
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label">Address</label>
  <div class="controls">                     
    <textarea  required  style="margin: 0px; height: 109px; width: 338px;" id="address" name="address"></textarea>
  
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Phone</label>
  <div class="controls">
    <input id="phone" name="phone" type="text" placeholder="Phone" class="input-xlarge" required>
   
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Mobile</label>
  <div class="controls">
    <input id="mphone" name="mphone" type="text" placeholder="Mobile" class="input-xlarge">
    
  </div>
</div>
<div class="control-group">
  <label class="control-label">Company</label>
  <div class="controls">
    <input id="company" name="company" type="text" placeholder="Company" class="input-xlarge">
    
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Facebook</label>
  <div class="controls">
    <input id="facebook" name="facebook" type="text" placeholder="Facebook" class="input-xlarge">
    
  </div>
</div>
<div class="control-group" style="margin-left: 160px;">
    <?=$captcha?>
    
</div>
<div class="control-group">
  <label class="control-label"></label>
  <div class="controls">
      <button id="" name="" type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</fieldset>
</form>    
</div> 
<?= $this->load->view('include/footer'); ?>
<script src="<?= base_url('asset/javascripts/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script>

App.validate_form();

</script>
