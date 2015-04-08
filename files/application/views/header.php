<?php
    $logged_in_user_type    =   $this->session->userdata('login_type');
?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>

        <div class="col-md-4" style="margin-top: 18px;">
            <h3>
                <?php
                    echo $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;
                ?>
            </h3>
        </div>
            
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome <?php echo $this->session->userdata('name');?></span>
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php?<?php echo $logged_in_user_type;?>/message">
                    <i class="fa fa-envelope"></i>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                <?php if ($logged_in_user_type == 'admin'):?>
                    <li>
                        <a href="<?php echo base_url();?>index.php?admin/profile_settings">
                            <div>
                                <i class="fa fa-user"></i> Profile
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo base_url();?>index.php?admin/settings">
                            <div>
                                <i class="fa fa-cogs"></i> Settings
                            </div>
                        </a>
                    </li>
                <?php endif;?>
                <?php if ($logged_in_user_type != 'admin'):?>
                    <li>
                        <a href="<?php echo base_url();?>index.php?<?php echo $logged_in_user_type;?>/profile_settings">
                            <div>
                                <i class="fa fa-user"></i> Profile
                            </div>
                        </a>
                    </li>
                <?php endif;?>
                </ul>
            </li>


            <li>
                <a href="<?php echo base_url();?>index.php?login/logout">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </nav>
</div>