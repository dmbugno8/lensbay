<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'profile_settings') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/profile_settings">Profile</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
    <?php foreach($patient as $row): ?>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" class="img-responsive" 
                            src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $row['name'];?></strong></h4>
                        <p>
                            <i class="fa fa-paper-plane"></i>
                                <?php echo $row['email'];?> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        endforeach;
        ?>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update Profile Informations</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                <!-- PROFILE SETTINGS FORM -->
                
                    <?php foreach($patient as $row): ?>
                    <div>

                        <?php 
                            echo form_open(base_url() . 'index.php?patient/profile_settings/update/' , array(
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>

                                <div class="form-group">
                                    <label>Name</label>
                                        <input type="text" placeholder="patient Name" class="form-control" name="name"
                                            value="<?php echo $row['name'];?>">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                        <input type="email" placeholder="patient email" class="form-control" name="email"
                                            value="<?php echo $row['email'];?>">
                                </div>

                                <div class="form-group">
                                    <label>Upload Profile Picture</label>
                                        <input type="file" class="form-control" name="userfile">
                                </div>
        

                                <center>
                                    <div>
                                        <button class="btn btn-primary btn-rounded" type="submit">
                                            <strong>Update Profile</strong>
                                        </button>
                                    </div>
                                </center>
                        <?php echo form_close();?>
                    </div>
                    <?php
                    endforeach;
                    ?>

                </div>
            </div>


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Change Password</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                <?php foreach($patient as $row): ?>
                    <div>
                        
                        <?php 
                            echo form_open(base_url() . 'index.php?patient/profile_settings/change_password/' , array(
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>

                            <div class="form-group">
                                <label>Previous Password</label>
                                    <input type="password" placeholder="Enter previous password" class="form-control" name="previous_password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                    <input type="password" placeholder="Enter new password" class="form-control" name="new_password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm new password" class="form-control" name="confirm_password">
                            </div>

                            <center>
                                <div>
                                    <button class="btn btn-primary btn-rounded" type="submit">
                                        <strong>Update Password</strong>
                                    </button>
                                </div>
                            </center>
                        <?php echo form_close();?>
                        
                    </div>
                <?php
                endforeach;
                ?>    
                </div>
            </div>
                        

        </div>
    </div>
</div>
    


