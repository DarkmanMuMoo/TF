
<!DOCTYPE html>
<link href="<?= base_url("asset/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/bootstrap/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TFace</title>
        <style>
            #login{

                margin-top: 10%;
            }

        </style>

    </head>
    <body>   <script>    var sitepath='<?= site_url() ?>'; </script>
        <div class="container">
            <div id="login" class="row">
                <div class="span4 offset4 well">
                    <legend>  TF Login</legend>
                    <?= validation_errors(' <div class="alert alert-error">
                        <a class="close" data-dismiss="alert" href="#">×</a>', ' </div>') ?>


                    <form method="POST" action="<?= site_url('Backend/usercontrol/login') ?>" >
                        <input type="text"  required="required"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('กรอก username')" 
                               id="username" class="span4" name="username" placeholder="Username">
                        <input type="password" required="required" oninput="this.setCustomValidity('')"  oninvalid="this.setCustomValidity('กรอก password')"
                               id="password" class="span4" name="password" placeholder="Password">
                        <button type="submit" name="submit" class="btn btn-info btn-block">Login</button>
                    </form>    
                </div>
            </div>

        </div>
    </body>
</html>
<script src="<?= base_url("asset/javascripts/jquery-1.8.3.min.js"); ?>" >  </script>

<script src="<?= base_url("asset/bakApp.js"); ?>"> </script>
