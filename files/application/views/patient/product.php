<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/product">Products</a>
            </li>
        </ol>
    </div>
</div>

<br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Products</h5>
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
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($products as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['serial_number'];?></td>
                <td>
                <center>
                    <img src="<?php echo $this->crud_model->get_image_url_object('product' , $row['product_id']);?>"
                        style="width: 60px;"/>
                </center>
                </td>
                <td><?php echo $row['name'];?></td>
                <td>
                    <?php if ($row['category_id'] > 0)
                            echo $this->db->get_where('category' , array('category_id' => $row['category_id']))->row()->name;
                                ?>
                </td>
                <td>
                <!-- PRODUCT DETAIL LINK -->
                    <button type="button" class="btn btn-success btn-rounded btn-outline btn-xs" 
                        onclick="showLargeAjaxModal('<?php echo base_url();?>index.php?modal/popup/product_details/<?php echo $row['product_id']; ?>');">
                            Details
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