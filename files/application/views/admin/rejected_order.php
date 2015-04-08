
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'rejected_order') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/rejected_order">Rejected Orders</a>
            </li>
        </ol>
    </div>
</div>

<br>



<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Rejected Orders</h5>
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
                <th>Customer</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Shipping</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($rejected_orders as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['order_number'];?></td>
                <td>
                    <?php 
                        echo $this->db->get_where('customer' , array('customer_id' => $row['customer_id']))->row()->name;
                    ?>
                </td>
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
                <td><label class="label label-danger"><i class="fa fa-times"></i> Rejected</label></td>
                <!-- PAYMENT STATUS CHECK -->
                <?php if ($row['payment_status'] == 0): ?>
                    <td><label class="label label-danger"><i class="fa fa-money"></i> Unpaid</label></td>
                <?php endif;?>
                <?php if ($row['payment_status'] == 1): ?>
                    <td><label class="label label-primary"><i class="fa fa-money"></i> Paid</label></td>
                <?php endif;?>
                <!-- PAYMENT STATUS CHECK -->

                <td><?php echo date('dS M, Y' , $row['timestamp']);?></td>
                <td>
                <!-- ORDER EDITING LINK -->
                <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/order_edit/<?php echo $row['order_id']; ?>');">
                        Edit
                </button>
                <!-- ORDER DELETING LINK -->
                    <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                        onclick="showDeleteModal('<?php echo base_url();?>index.php?admin/order/delete/<?php echo $row['order_id']; ?>');">
                            Delete
                    </button>
                </td>
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

