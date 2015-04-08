<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'employee') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/employee">Employees</a>
            </li>
        </ol>
    </div>
</div>

<br>

<!-- NEW CUSTOMER ADDITION LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/employee_add');"><i class="fa fa-plus"></i>
        Add New Employee
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Employees</h5>
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
                <th>Email</th>
                <th>Type</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($employees as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <?php if($row['type'] == 0) :?>
                    <td></td>
                <?php endif;?>
                <?php if($row['type'] == 1):?>
                    <td>Sales Staff</td>
                <?php endif;?>
                <?php if($row['type'] == 2):?>
                    <td>Purchase Staff</td>
                <?php endif;?>
                <td>
                <!-- EMPLOYEE PROFILE LINK -->
                    <button type="button" class="btn btn-success btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/employee_profile/<?php echo $row['employee_id']; ?>');">
                            Profile
                    </button>
                <!-- EMPLOYEE EDITING LINK -->
                    <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/employee_edit/<?php echo $row['employee_id']; ?>');">
                            Edit
                    </button>
                <!-- EMPLOYEE DELETING LINK -->
                    <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                        onclick="showDeleteModal('<?php echo base_url();?>index.php?admin/employee/delete/<?php echo $row['employee_id']; ?>');">
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