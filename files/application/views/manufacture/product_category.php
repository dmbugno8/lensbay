<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/product">Manage Products</a>
            </li>
            <li class="<?php if ($page_name == 'product_category') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/product_category">Product Categories</a>
            </li>
        </ol>
    </div>
</div>

<br>

<!-- NEW PRODUCT CATEGORY ADDITION LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/product_category_add');"><i class="fa fa-plus"></i>
        Add New Product Category
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Categories</h5>
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
                <th>Name</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($categories as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['description'];?></td>
                <td>
                <!-- PRODUCT CATEGORY EDITING LINK -->
                    <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/product_category_edit/<?php echo $row['category_id']; ?>');">
                            Edit
                    </button>
                <!-- PRODUCT CATEGORY DELETING LINK -->
                    <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                        onclick="showDeleteModal('<?php echo base_url();?>index.php?admin/product_category/delete/<?php echo $row['category_id']; ?>');">
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