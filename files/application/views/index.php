<?php
    $account_type   =   $this->session->userdata('login_type');
    $company_name   =   $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;
?>

<!DOCTYPE html>
<html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $company_name;?> | <?php echo $page_title;?></title>


<head>
    <?php
        // side effect: loads all css styles 
        include 'includes_top.php';
    ?>
</head>

<body class="pace-done">
    <div id="wrapper">
        <?php
            // side effect: loads the navigation menu of the pages 
            include $account_type . '/navigation.php';
        ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php
            // side effect: loads the header of the pages 
            include 'header.php';
        ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                <?php
                    // side effect: loads the main content of pages
                    include $account_type . '/' . $page_name . '.php';
                ?>      
                </div>
                <?php
                    // side effect: loads the footer of the pages 
                    include 'footer.php';
                ?>
            </div>
        </div>

        </div>
    </div>

    <?php
        // side effect: loads the javascripts 
        include 'includes_bottom.php';
        // side effect: loads the modal for pages 
        include 'modal.php';
    ?>
    
</body>
</html>

<!-- Localized -->