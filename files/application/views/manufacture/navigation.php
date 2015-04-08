<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
            <center>
                <div class="dropdown profile-element">
                    <span>
                        <img class="img-circle" 
                            src="<?php echo  $this->crud_model->get_image_url('admin' , $this->session->userdata('user_id'));?>"
                                style="width: 40%;"/>
                    </span>
                        <a href="<?php echo base_url();?>index.php?admin/profile_settings">
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

                <!-- ADMIN DASHBOARD -->
                <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/dashboard">
                        <i class="fa fa-dashboard"></i> 
                            <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                <!-- CUSTOMERS -->
                <li class="<?php if ($page_name == 'customer') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/customer">
                        <i class="fa fa-users"></i> 
                            <span class="nav-label">Customers</span>
                    </a>
                </li>

                <!-- SUPPLIERS -->
                <li class="<?php if ($page_name == 'supplier') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/supplier">
                        <i class="fa fa-truck"></i> 
                            <span class="nav-label">Suppliers</span>
                    </a>
                </li>

                <!-- PRODUCTS -->
                <li class="<?php if ($page_name == 'product' ||
                                        $page_name == 'product_category' ||
                                            $page_name == 'product_sub_category' ||
                                                $page_name == 'product_barcode' ||
                                                    $page_name == 'damaged_product')
                                                        echo 'active';?>">
                    <a href="#">
                        <i class="fa fa-bank"></i> 
                            <span class="nav-label">Products</span>
                            <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                    <!-- MANAGE PRODUCTS -->
                        <li class="<?php if ($page_name == 'product') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/product">Manage Products</a>
                        </li>
                    <!-- PRODUCT BARCODE -->
                        <li class="<?php if ($page_name == 'product_barcode') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/product_barcode">Product Barcode</a>
                        </li>
                    <!-- CATEGORY -->
                        <li class="<?php if ($page_name == 'product_category') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/product_category">Category</a>
                        </li>
                    <!-- SUB CATEGORY -->
                        <li class="<?php if ($page_name == 'product_sub_category') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/product_sub_category">Sub-category</a>
                        </li>
                    <!-- DAMAGED PRODUCTS -->
                        <li class="<?php if ($page_name == 'damaged_product') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/damaged_product">Damaged Products</a>
                        </li>
                    </ul>
                </li>

                <!-- ORDERS -->
                <li class="<?php if ($page_name == 'order_add' ||
                                        $page_name == 'pending_order' ||
                                            $page_name == 'approved_order' ||
                                                $page_name == 'rejected_order')
                                                    echo 'active';?>">
                    <a href="#">
                        <i class="fa fa-bars"></i> 
                            <span class="nav-label">Orders</span>
                            <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                    <!-- NEW ORDER -->
                        <li class="<?php if ($page_name == 'order_add') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/order_add">Create New Order</a>
                        </li> 
                    <!-- PENDING -->
                        <li class="<?php if ($page_name == 'pending_order') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/pending_order">Pending</a>
                        </li>
                    <!-- APPROVED -->    
                        <li class="<?php if ($page_name == 'approved_order') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/approved_order">Approved</a>
                        </li>
                    <!-- REJECTED -->
                        <li class="<?php if ($page_name == 'rejected_order') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/rejected_order">Rejected</a>
                        </li>   
                    </ul>
                </li>

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
                            <a href="<?php echo base_url();?>index.php?admin/purchase_add">New Purchase</a>
                        </li>
                    <!-- PURCHASE HISTORY -->
                        <li class="<?php if ($page_name == 'purchase_history') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/purchase_history">Purchase History</a>
                        </li>
                    </ul>
                </li>


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
                    <!-- NEW SALE -->
                        <li class="<?php if ($page_name == 'new_sale') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/sale_add">New Sale</a>
                        </li>
                    <!-- SALE INVOICES -->
                        <li class="<?php if ($page_name == 'sale_invoice') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/sale_invoice">Sale Invoices</a>
                        </li>
                    </ul>
                </li>

                

                <!-- REPORTS -->
                <li class="<?php if ($page_name == 'report_payment' ||
                                        $page_name == 'report_customer')
                                            echo 'active';?>">
                    <a href="#">
                        <i class="fa fa-bar-chart-o"></i> 
                            <span class="nav-label">Reports</span>
                            <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                    <!-- PAYMENT REPORT -->
                        <li class="<?php if ($page_name == 'report_payment') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/report/payment">Payment report</a>
                        </li>
                    <!-- CUSTOMER REPORT -->
                        <li class="<?php if ($page_name == 'report_customer') echo 'active';?>">
                            <a href="<?php echo base_url();?>index.php?admin/report/customer">Customer report</a>
                        </li>
                    </ul>
                </li>

                <!-- EMPLOYEES -->
                <li class="<?php if ($page_name == 'employee') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/employee">
                        <i class="fa fa-users"></i> 
                            <span class="nav-label">Employees</span>
                    </a>
                </li>

                <!-- MESSAGING -->
                <li class="<?php if ($page_name == 'message') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/message">
                        <i class="fa fa-paper-plane-o"></i> 
                            <span class="nav-label">Messaging</span>
                    </a>
                </li>

                <!-- SETTINGS -->
                <li class="<?php if ($page_name == 'settings') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/settings">
                        <i class="fa fa-gears"></i> 
                            <span class="nav-label">Settings</span>
                    </a>
                </li>

                
                
            </ul>
    </div>
</nav>