<?= $this->load->view('include/header'); ?>
<div class="wraper" >
      <?php echo validation_errors('<div style="margin-top: 20px;" class="alert alert-error">', '</div>'); ?>
    <form method="post" action="<?= site_url('home/resetpassword') ?>"  class="form-horizontal">
        <fieldset>

            <!-- Form Name -->
            <legend>Reset Password</legend>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input id="Email" name="Email" type="email" placeholder="" class="input-xlarge" required>

                </div>    
            </div>
            <div class="control-group">
                <div class="controls">
                    <?= $captcha ?>
                </div> 
            </div>
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>

        </fieldset>
    </form>






</div>

<?= $this->load->view('include/footer'); ?>