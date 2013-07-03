<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
        <meta name="generator" content="4.1.8.204"/>
        <title>TFace</title>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/bootstrap/css/bootstrap.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/site_global.css?487789990') ?>"/>

        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/master_a-master.css?4262296399') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/index.css?437593284') ?>" id="pagesheet"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('asset/style.css') ?>" id="pagesheet"/>

        <!-- Other scripts -->
        <script type="text/javascript">
            var sitepath='<?= site_url() ?>';
            document.documentElement.className += ' js';
        </script>
    </head>
    <body>
        <div class="clearfix" id="page">
            <div class="position_content" id="page_position_content">
                <div class="clearfix colelem" id="u138"><!-- column -->
                    <div class="position_content" id="u138_position_content">
                        <div class="clearfix colelem" id="pu140-4"><!-- group -->
                            <div class="clearfix grpelem" id="u140-4"><!-- content -->
                                <p>TFace</p>
                            </div>
                            <?php if (isset($_SESSION['user'])): ?>
                                <?= $this->load->view('include/logoutform'); ?>
                            <?php else: ?>
                                <?= $this->load->view('include/loginform'); ?>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="clearfix colelem" id="u139"><!-- group -->
                        <ul class="MenuBar clearfix grpelem" id="menuu142"><!-- row -->
                            <li class="MenuItemContainer " id="home"><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu   colelem"  href="<?= site_url('home') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u153-4"><!-- content --><p>Home</p></div></a>
                            </li>
                            <li class="MenuItemContainer " id="sponsor"><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu  colelem"  href="<?= site_url('sponsor') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u186-4"><!-- content --><p>sponsor</p></div></a>
                            </li>
                            <li class="MenuItemContainer " id="rules"><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu  colelem"  href="<?= site_url('rules') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u177-4"><!-- content --><p>rules</p></div></a>
                            </li>
                            <li class="MenuItemContainer " id="prize"><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu  colelem"  href="<?= site_url('prize') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u147-4"><!-- content --><p>prize</p></div></a>
                            </li>
                             <?php if (isset($_SESSION['user'])): ?>
                            <li class="MenuItemContainer " id="typeface" ><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu  colelem"  href="<?= site_url('typeface') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u191-4"><!-- content --><p>typeface</p></div></a>
                            </li>
                    
                            <?php endif; ?>
                            <li class="MenuItemContainer clearfix grpelem" id="contact"><!-- vertical box -->
                                <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem"  href="<?= site_url('contact-us') ?>"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u220-4"><!-- content --><p>contact us</p></div></a>
                            </li>
                        </ul>
                    </div>
                </div>


