<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Surya Raya Sentosa </title>
        <link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/css/bootstrap-datepicker3.standalone.css" rel="stylesheet" type="text/css" />
        
        

        <script src="<?= base_url(); ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>

        <link href='<?php echo base_url(); ?>assets/css/jquery.autocomplete.css' rel='stylesheet' />
        
        <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.autocomplete.js'></script>

        <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/bootstrap-datepicker-1.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
        

        <script src = "<?= base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type = "text/javascript" ></script>

        <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/font/fonts.googleapis.css" rel="stylesheet">


        <script src='<?= base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>

        <script src="<?= base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>

        <script src="<?= base_url(); ?>assets/dist/js/demo.js" type="text/javascript"></script>


        <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url(); ?>assets/img/favicon.ico" type="image/x-icon">

    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="skin-blue layout-top-nav">
        <div class="wrapper">

            <?php echo $_sidebar ?>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->


                    <!-- Main content -->
                    <section class="content">
                        <?php echo $_content ?>
                    </section><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.content-wrapper -->
            <?php echo $_footer ?>      
        </div><!-- ./wrapper -->


    </body>


    <script>
        $("#sukses").fadeOut(4000);
        function formatNumber(num) // meru
        {
            num = num.toString().replace(/\$|\,/g, '');
            if (isNaN(num))
                num = "0";
            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            cents = num % 100;
            num = Math.floor(num / 100).toString();
            if (cents < 10)
                cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                num = num.substring(0, num.length - (4 * i + 3)) + ',' +
                        num.substring(num.length - (4 * i + 3));
            return (((sign) ? '' : '-') + num);
        }

        function getNumber(value = '') //fungsi utk merubah string menjadi integer
        {
            var currency = value;
            var number = Number(currency.replace(/[^-0-9\.]+/g, ""));
                    return number;
        }

    </script>
</html>


