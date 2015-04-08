<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'settings') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/settings">System Settings</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="row">
<div class="col-md-8">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Update System Informations</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div>
                <?php 
                    echo form_open(base_url() . 'index.php?admin/settings/update/');
                ?>

                    <div class="form-group">
                        <label>Company Name</label>
                            <input type="text" placeholder="Enter company name" class="form-control" name="company_name"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Email</label>
                            <input type="text" placeholder="Enter company email" class="form-control" name="company_email"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'company_email'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                            <input type="text" placeholder="Enter address" class="form-control" name="address"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'address'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                            <input type="text" placeholder="Enter phone numebr" class="form-control" name="phone"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'phone'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>Currency</label>
                            <input type="text" placeholder="Enter system currency" class="form-control" name="currency"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'currency'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>VAT Percentage</label>
                            <input type="text" placeholder="Enter VAT percentage (only the value)" class="form-control" name="vat_percentage"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'vat_percentage'))->row()->description;?>">
                    </div>
                    <div class="form-group">
                        <label>Discount Percentage</label>
                            <input type="text" placeholder="Enter discount percentage (only the value)" class="form-control" name="discount_percentage"
                                value="<?php echo $this->db->get_where('settings' , array('type' => 'discount_percentage'))->row()->description;?>">
                    </div>

                    <center>
                        <div>
                            <button class="btn btn-primary btn-rounded" type="submit">
                                <strong>Update Informations</strong>
                            </button>
                        </div>
                    </center>
                <?php echo form_close();?>
                
            </div>

        </div>
    </div>
</div>
    <div class="col-md-4">
        <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Company Logo</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                    <center>
                        <img alt="image" class="img-responsive" src="<?php echo base_url();?>uploads/logo/logo.png"
                            style="width: 70%;">
                    </center>
                    </div>
                    <div class="ibox-content profile-content">
                    <?php 
                        echo form_open(base_url() . 'index.php?admin/settings/upload_logo/' , array(
                            'enctype' => 'multipart/form-data'
                        ));
                    ?>

                        <div class="form-group">
                            <label>Upload Profile Picture</label>
                                <input type="file" class="form-control" name="userfile">
                        </div>
                        
                        <center>
                            <div>
                                <button class="btn btn-primary btn-rounded" type="submit">
                                    <strong>Update Logo</strong>
                                </button>
                            </div>
                        </center>
                    <?php echo form_close();?>
                    </div>
                </div>
            </div>
    </div>
<div class"clearfix"></div>
</div>