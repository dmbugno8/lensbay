<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
            <center>
                <div class="dropdown profile-element">
                    <span>
                        <img class="img-circle" 
                            src="<?php echo $this->crud_model->get_image_url('customer' , $this->session->userdata('user_id'));?>"
                                style="width: 40%;"/>
                    </span>
                        <a href="<?php echo base_url();?>index.php?customer/profile_settings">
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

            <!-- CUSTOMER DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/dashboard">
                    <i class="fa fa-dashboard"></i> 
                        <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <!-- PRODUCTS -->
            <li class="<?php if ($page_name == 'product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/product">
                    <i class="fa fa-shopping-cart"></i> 
                        <span class="nav-label">Products</span>
                </a>
            </li>
            
                <!-- PATIENTS -->
                <li class="<?php if ($page_name == 'patient') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?customer/patient">
                        <i class="fa fa-users"></i> 
                            <span class="nav-label">Patients</span>
                    </a>
                </li>
            

            <!-- ORDERS -->
            <li class="<?php if ($page_name == 'order') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/order">
                    <i class="fa fa-bars"></i> 
                        <span class="nav-label">Orders</span>
                </a>
            </li>

            <!-- PURCHASE HISTORY -->
            <li class="<?php if ($page_name == 'purchase_history') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/purchase_history">
                    <i class="fa fa-money"></i> 
                        <span class="nav-label">Purchase History</span>
                </a>
            </li>
            

            <!-- MESSAGING -->
            <li class="<?php if ($page_name == 'message') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/message">
                    <i class="fa fa-paper-plane-o"></i> 
                        <span class="nav-label">Messaging</span>
                </a>
            </li>
        </ul>
    </div>
</nav>