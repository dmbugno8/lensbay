<?php
    $company_name = $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $company_name;?> | Login</title>
    <link rel="icon" href="uploads/logo/favicon.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

</head>

<body style="background-color: #22313F;">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <center>
                <img alt="image" class="img-responsive" src="<?php echo base_url();?>uploads/logo/logo.png"
                    style="width: 30%; margin-top: 100px;">
            </center>
            <br>
            <h3 style="color: white; font-weight: lighter;">Welcome to <?php echo $company_name;?></h3>
            <br>
            <?php 
                echo form_open(base_url() . 'index.php?login/do_login/' , array(
                    'class' => 'm-t'
                ));
            ?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <?php echo form_close();?>
            <a style="color: #fff; font-weight: lighter;" 
                href="<?php echo base_url();?>index.php?login/forgot_password">
                    Forgot password?
            </a>
            </br>
            
            <a style="color: #fff; font-weight: lighter;" 
                href='test'>
                    REGISTER HERE
            </a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- GITTER -->
    <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>
    <?php if ($this->session->flashdata('flash_message') != ""): ?>

        <script type="text/javascript">


            $.gritter.add({
                title: '<?php echo $this->session->flashdata("flash_message");?>',
                text: '',
                time: 4000
            });

        </script>

    <?php endif;?>

</body>

</html>

<!-- Localized -->