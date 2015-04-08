<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/product">Products</a>
            </li>
            <li class="<?php if ($page_name == 'damaged_product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/damaged_product">Damaged Products</a>
            </li>
        </ol>
    </div>
</div>

<br>

<!-- NEW DAMAGED PRODUCT ADDITION LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/damaged_product_add');"><i class="fa fa-plus"></i>
        Add Damaged Product
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Damaged Products</h5>
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
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Purchase Price</th>
                    <th>Quantity</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>

            
            <?php 
                $count = 1;
                foreach($damaged_products as $row):
            ?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td>
                        <?php
                            echo $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->serial_number;
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->name;
                        ?>
                    </td>
                    <td>
                        <?php
                            $category_id = $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->category_id;
                                echo $this->db->get_where('category' , array('category_id' => $category_id))->row()->name;
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $this->db->get_where('product' , array('product_id' => $row['product_id']))->row()->purchase_price;
                        ?>
                    </td>
                    <td><?php echo $row['quantity'];?></td>
                    <td><?php echo $row['note'];?></td>
                    <td><?php echo date('dS M, Y' , $row['timestamp']);?></td>
                    <td>
                    <!-- DAMAGED PRODUCT EDITING LINK -->
                    <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/damaged_product_edit/<?php echo $row['damaged_product_id']; ?>');">
                            Edit
                    </button>
                    <!-- DAMAGED PRODUCT DELETING LINK -->
                        <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                            onclick="showDeleteModal('<?php echo base_url();?>index.php?admin/damaged_product/delete/<?php echo $row['damaged_product_id']; ?>');">
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