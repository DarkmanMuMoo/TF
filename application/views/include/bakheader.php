<!DOCTYPE html>
<link href="<?= base_url("asset/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/bootstrap/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/css/chosen.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/bakstyle.css"); ?>" rel="stylesheet">
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TFace</title>


    </head>
    <body>  
        <script>    var sitepath='<?= site_url() ?>'; </script>
        <div class="container-fluid">   

            <div class="masthead">
                <h3 class="muted pull-left">TF Backend</h3>

                <div class="pull-right right-bar"  >
                    <span style="
                          margin-right: 10px;
                          ">
                        <strong><?= $_SESSION['commitee']->Loginname ?></strong>
                    </span>
                    SelectionRemain
                    <span  style="margin-right: 10px;"class="badge badge-important"><?= $_SESSION['commitee']->SelectionRemain ?></span>
                    <a class="btn btn-danger" href="<?= site_url('Backend/usercontrol/logout') ?> " > Logout</a>
                </div>
            </div>


            <hr/>
            <div class="row-fluid">
                <div class="span2" >
                    <div class="well sidebar-nav">
                        <ul  id="sidemenu" class="nav nav-list">
                            <li class="nav-header">Menu</li>
                            <li id="typeface" ><a href="<?= site_url('Backend/typeface')  ?>">Typeface</a></li>
                            <li id="user"><a href="<?= site_url('Backend/user')  ?>">User</a></li>
                            <li id="scoreReport" ><a href="<?= site_url('Backend/scoreReport')  ?>">ScoreReport</a></li>
                            <li><a href="#">Link</a></li>

                        </ul>
                    </div>

                </div>