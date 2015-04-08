<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'purchase_add') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/purchase_add">New Purchase</a>
            </li>
        </ol>
    </div>
</div>

<br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Purchases</h5>
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
                <th>Purchase Code</th>
                <th>Supplier</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Payment</th>
                <th>Method</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($purchases as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['purchase_code'];?></td>
                <td>
                    <button class="btn btn-default btn-outline btn-xs"
                        onclick="showLargeAjaxModal('<?php echo base_url();?>index.php?modal/popup/supplier_profile/<?php echo $row['supplier_id']; ?>');">
                        <?php echo $this->db->get_where('supplier' , array('supplier_id' => $row['supplier_id']))->row()->name;?> 
                            <i class="fa fa-external-link"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-default btn-outline btn-xs"
                        onclick="showLargeAjaxModal('<?php echo base_url();?>index.php?modal/popup/product_details/<?php echo $row['product_id']; ?>');">
                            <?php echo $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->name;?>
                                <i class="fa fa-external-link"></i>
                    </button>
                </td>
                <td><?php echo $row['quantity'];?></td>
                <td><?php echo $row['unit_price'];?></td>
                <td><?php echo $row['total_amount'];?></td>
                <td>
                    <?php echo $this->db->get_where('payment' , array('purchase_id' => $row['purchase_id']))->row()->method;?>
                </td>
                <td><?php echo date('d-m-Y' , $row['timestamp']);?></td>
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