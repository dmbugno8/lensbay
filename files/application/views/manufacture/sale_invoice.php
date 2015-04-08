<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'sale_add') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/sale_add">New Sale</a>
            </li>
            <li class="<?php if ($page_name == 'sale_invoice') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/sale_invoice">Sale Invoices</a>
            </li>
        </ol>
    </div>
</div>

<br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sale Invoices</h5>
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
                <th>Invoice Code</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($invoices as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['invoice_code'];?></td>
                <td>
                    <?php echo $this->db->get_where('customer' , array('customer_id' => $row['customer_id']))->row()->name;?>
                </td>
                <td><?php echo date("jS F, Y", $row['timestamp']);?></td>
                <td>
                    <!-- Viewing LINK -->
                    <a href="<?php echo base_url();?>index.php?admin/sale_invoice_view/<?php echo $row['invoice_id'];?>">
                        <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs">
                            View sale invoice
                        </button>
                    </a>
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