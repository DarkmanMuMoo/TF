<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form  action="<?=  site_url('test/testupload')  ?>"  method="post" class="form-horizontal"  enctype="multipart/form-data"  >
<fieldset>

<!-- Form Name -->
<legend>Add Font</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Name</label>
  <div class="controls">
    <input id="fontname" name="fontname" type="text" placeholder="Name" class="input-xlarge" required>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label">Description</label>
  <div class="controls">                     
      <textarea id="description" name="description"  style="margin: 0px; width: 335px; height: 151px;" ></textarea>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label"></label>
  <div class="controls">
      <input type="submit" value="upload" class="btn btn-primary">
  </div>
</div>

</fieldset>
</form>
        
        <form  class="well" action="<? echo site_url('test/testupload'); ?>" method="post" enctype="multipart/form-data" id="uploadpic" >
                <input type="file" name="pic" />
                <input type="submit" value="upload">
            </form>
    </body>
</html>
