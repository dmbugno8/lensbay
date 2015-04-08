<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'patient') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/patient">Patient</a>
            </li>
        </ol>
    </div>
</div>

<br>

<!-- NEW patient ADDITION LINK -->
<button type="button" class="btn btn-primary btn-rounded pull-right" 
    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/patient_add');"><i class="fa fa-plus"></i>
        Add New patient
</button>

<br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All patients</h5>
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
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Birthday</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Street Address</th>
                <th>ECP</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($patients as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['patient_code'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['middle_name'];?></td>
                <td><?php echo $row['birthday'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['ship_to_street'];?></td>
                <td>
                    <?php if ($row['customer_id'] > 0)
                        echo $this->db->get_where('customer' , array('customer_id' => $row['customer_id']))->row()->name;
                            ?>
                </td>
                <td>
                <!-- patient PROFILE LINK -->
                    <button type="button" class="btn btn-success btn-rounded btn-outline btn-xs" 
                        onclick="showLargeAjaxModal('<?php echo base_url();?>index.php?patient_profile/<?php echo $row['patient_id']; ?>');">
                            Profile
                    </button>
                <!-- patient EDITING LINK -->
                    <button type="button" class="btn btn-info btn-rounded btn-outline btn-xs" 
                        onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/patient_edit/<?php echo $row['patient_id']; ?>');">
                            Edit
                    </button>
                <!-- patient DELETING LINK -->
                    <button type="button" class="btn btn-danger btn-rounded btn-outline btn-xs"
                        onclick="showDeleteModal('<?php echo base_url();?>index.php?customer/patient/delete/<?php echo $row['patient_id']; ?>');">
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