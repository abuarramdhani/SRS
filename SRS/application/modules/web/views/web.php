<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login Aplikasi</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/font/fonts.googleapis.css" rel="stylesheet">


        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>assets/css/pages/signin.css" rel="stylesheet" type="text/css">


        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    </head>

    <!--<body style="background: url('<?= base_url() ?>assets/img/logo.jpg');background-size: 500px 500px;background-repeat:no-repeat;     background-position:400px 50px; ">-->
    <body style="background: url('<?= base_url() ?>assets/img/index.png')">
    

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="">
                        <img src="<?= base_url() ?>assets/img/logo.jpg" height="30" width="30"> 
                        PT. Surya Raya Sentosa
                    </a>		
                    <div class="nav-collapse">
                        <ul class="nav pull-right">

                            <li class="">						
                            </li>

                            <li class="">						
                                <a href="index.html" class="">

                                </a>

                            </li>
                        </ul>

                    </div><!--/.nav-collapse -->	

                </div> <!-- /container -->

            </div> <!-- /navbar-inner -->

        </div> <!-- /navbar -->


        <div class="account-container">

            <div class="content clearfix">

                <form action="<?php echo site_url('index.php/web/login'); ?>" method="post">

                    <h1>Login Aplikasi</h1>		
                    <div id="message" style="color:red;"><?php echo $this->session->flashdata('message'); ?></div>

                    <div class="login-fields">

                        <p>Isi Username dan Password</p>

                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
                        </div> <!-- /field -->

                        <div class="field">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
                        </div> <!-- /password -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">

                        <span class="login-checkbox">
                            <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                            <!--<label class="choice" for="Field">Keep me signed in</label>-->
                        </span>

                        <button class="button btn btn-success btn-large">Sign In</button>

                    </div> <!-- .actions -->
                </form>

            </div> <!-- /content -->

        </div> <!-- /account-container -->



        <div class="login-extra">

        </div> <!-- /login-extra -->


        <script src="<?= base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>

        <script src="<?= base_url(); ?>assets/js/signin.js"></script>

    </body>

</html>
<script>
    $("#message").fadeOut(4000);
</script>

