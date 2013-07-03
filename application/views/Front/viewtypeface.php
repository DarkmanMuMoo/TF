<?= $this->load->view('include/header'); ?>
<div class="wraper">
    <h1>Font Code : <?= $typeface->FontCode ?>   </h1>
    <p> <strong>Lastedited-Time </strong>:  <?= $typeface->Lasteditedtime ?>  </p>
    <?php echo validation_errors('<div style="margin-top: 20px;" class="alert alert-error">', '</div>'); ?>
    <div class="detail">
      

        <form  class="form-horizontal view" method="POST"  action="<?= site_url('typeface/editfontinfo') ?>" >
            <fieldset>
                <!-- Form Name -->
                <legend>Font detail</legend>
                <!-- Text input-->
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <input id="fontname"  value="" name="fontname" type="text" placeholder="Name" class="input-xlarge" required>
                    </div>
                </div>

                <!-- File Button --> 

                <!-- Textarea -->
                <div class="control-group">
                    <label class="control-label">Description</label>
                    <div class="controls">                     
                        <textarea id="description" name="description"  style="margin: 0px; width: 335px; height: 151px;" ></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="control-group view">
                    <label class="control-label "></label>
                    <div class="controls">
                        <button id="Edited"  type="button" onclick="App.swaptoEdit();" class="btn btn-warning">Edited</button>
                    </div>
                </div>
                <div class="control-group edited" >
                    <label class="control-label"></label>
                    <div class="controls">
                        <button  type="submit" class="btn btn-success">Apply</button>
                        <button  type="button"  onclick="App.swaptoView();"  class="btn btn-danger">Cancle</button>
                    </div>
                </div>
                <input type="hidden" name="FontID" value="<?= $typeface->FontID ?>"  />
            </fieldset>
        </form>

  <form  class="well edited" action="<?= site_url('typeface/changefile'); ?>" method="post"   enctype="multipart/form-data" id="uploadpic" >
            <input type="file" name="fontfile"  required/>
            <input type="submit"  class="btn btn-warning" value="upload">
            <input type="hidden" name="FontID" value="<?= $typeface->FontID ?>"  />
        </form>

    </div>
    <iframe class="showpdf"  src="<?= site_url('typeface/rendertypeface/' . $typeface->FontID) ?>"  ></iframe>



</div>
<?= $this->load->view('include/footer'); ?>
<script>
   
    var meta={fontname:'<?= $typeface->Fontname ?>'
        ,description:'<?= $typeface->Description ?>'};
    App.validate_addform();
    App.swaptoView();      
    
</script>