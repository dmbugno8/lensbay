
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'order') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/order">Orders</a>
            </li>
        </ol>
    </div>
</div>

<br>
<!-- NEW ORDER CREATING LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/order_add');"><i class="fa fa-plus"></i>
        Create new order
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Orders</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="ibox-content">

            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>#</th>
                <th>Order No.</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Shipping</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($orders as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['order_number'];?></td>
                <td>
                    <?php 
                        echo $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->name;
                    ?>
                </td>
                <td>
                    <?php
                        $category_id    =   $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->category_id;
                            echo $this->db->get_where('category' , array('category_id' => $category_id))->row()->name;
                    ?>
                </td>
                <td><?php echo $row['quantity'];?></td>
                <td><?php echo $row['shipping_address'];?></td>

                <!-- ORDER STATUS CHECK -->
                <?php if ($row['order_status'] == 0): ?>
                    <td><label class="label label-warning"><i class="fa fa-spinner"></i> Pending</label></td>
                <?php endif;?>
                <?php if ($row['order_status'] == 1): ?>
                    <td><label class="label label-primary"><i class="fa fa-check"></i> Approved</label></td>
                <?php endif;?>
                <?php if ($row['order_status'] == 2): ?>
                    <td><label class="label label-danger"><i class="fa fa-times"></i> Rejected</label></td>
                <?php endif;?>
                <!-- ORDER STATUS CHECK -->

                <!-- PAYMENT STATUS CHECK -->
                <?php if ($row['payment_status'] == 0): ?>
                    <td><label class="label label-danger"><i class="fa fa-money"></i> Unpaid</label></td>
                <?php endif;?>
                <?php if ($row['payment_status'] == 1): ?>
                    <td><label class="label label-primary"><i class="fa fa-money"></i> Paid</label></td>
                <?php endif;?>
                <!-- PAYMENT STATUS CHECK -->

                <td><?php echo date('dS M, Y' , $row['timestamp']);?></td>
            </tr>
        <?php 
        endforeach;
        ?>
            </tbody>
            </table>

            </div>

        </div>
    </div>
</div>

