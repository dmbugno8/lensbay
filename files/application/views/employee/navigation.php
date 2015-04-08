<?php
    $employee_type  =   $this->db->get_where('employee' , array('employee_id' => $this->session->userdata('user_id')))->row()->type;
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
            <center>
                <div class="dropdown profile-element">
                    <span>
                        <img class="img-circle" 
                            src="<?php echo  $this->crud_model->get_image_url('employee' , $this->session->userdata('user_id'));?>"
                                style="width: 40%;"/>
                    </span>
                        <a href="<?php echo base_url();?>index.php?employee/profile_settings">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?php echo $this->session->userdata('name');?>
                                    </strong>
                                </span>
                            </span>
                        </a>
                        
                    </div>
                </center>
                    <div class="logo-element">
                        
                    </div>
                </li>

                <!-- EMPLOYEE DASHBOARD -->
                <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?employee/dashboard">
                        <i class="fa fa-dashboard"></i> 
                            <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                
            <?php if ($employee_type == 2):?>
                <!-- PURCHASES -->
                <li class="<?php if ($page_name == 'purchase_add' ||
                                        $page_name == 'purchase_history')
                                            echo 'active';?>">
                    <a href="#">
                        <i class="fa fa-money"></i> 
                            <span class="nav-label">Purchase</span>
                            <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                    <!-- NEW PURCHASES -->
                        <li class="<?php if ($page_name == 'purchase_add') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?employee/purchase_add">New Purchase</a>
                        </li>
                    <!-- PURCHASE HISTORY -->
                        <li class="<?php if ($page_name == 'purchase_history') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?employee/purchase_history">Purchase History</a>
                        </li>
                    </ul>
                </li>
            <?php endif;?>

            <?php if ($employee_type == 1):?>
                <!-- SALES -->
                <li class="<?php if ($page_name == 'sale_add' ||
                                        $page_name == 'sale_invoice' ||
                                            $page_name  ==  'sale_invoice_view')
                                                echo 'active';?>">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i> 
                            <span class="nav-label">Sale</span>
                            <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                    <!-- NEW PURCHASES -->
                        <li class="<?php if ($page_name == 'sale_add') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?employee/sale_add">New Sale</a>
                        </li>
                    <!-- PURCHASE HISTORY -->
                        <li class="<?php if ($page_name == 'sale_invoice') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?employee/sale_invoice">Sale Invoices</a>
                        </li>
                    </ul>
                </li>
            <?php endif;?>
                <!-- MESSAGING -->
                <li class="<?php if ($page_name == 'message') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?employee/message">
                        <i class="fa fa-paper-plane-o"></i> 
                            <span class="nav-label">Messaging</span>
                    </a>
                </li>
            </ul>
    </div>
</nav>