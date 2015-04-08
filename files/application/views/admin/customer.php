<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'customer') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/customer">Customers</a>
            </li>
        </ol>
    </div>
</div>

<br>

<!-- NEW CUSTOMER ADDITION LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/customer_add');"><i class="fa fa-plus"></i>
        Add New Customer
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Customers</h5>
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
                <th>Code</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Street Address</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($customers as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['customer_code'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['ship_to_street'];?></td>
                <td>
                <!-- CUSTOMER PROFILE LINK -->
                    <button type="button" class="btn btn-success btn-rounded btn-outline btn-xs" 
                        onclick="showLargeAjaxModal('<?php echo base_url();?>index.php?modal/popup/customer_profile/<?php echo $row['customer_id']; ?>');">
                            Profile
                    </button>
                <!-- CUSTOMER EDITING LINK -->
                    <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/customer_edit/<?php echo $row['customer_id']; ?>');">
                            Edit
                    </button>
                <!-- CUSTOMER DELETING LINK -->
                    <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                        onclick="showDeleteModal('<?php echo base_url();?>index.php?admin/customer/delete/<?php echo $row['customer_id']; ?>');">
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