<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'patient') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/message">Messaging</a>
            </li>

            <li class="<?php if ($page_name == 'patient') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?patient/message_new">New Message</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" 
                            href="<?php echo base_url();?>index.php?patient/message_new">
                                Compose New Message
                        </a>
                        <div class="space-25"></div>
                        <ul class="folder-list m-b-md" style="padding: 0">
                        <?php
                            $current_user   =   $this->session->userdata('login_type') . '-' . $this->session->userdata('user_id');
                            
                            $this->db->where('sender' , $current_user);
                            $this->db->or_where('receiver' , $current_user);
                            $message_threads    =   $this->db->get('message_thread')->result_array();
                            foreach ($message_threads as $row):
                            // defining the user to show
                            if ($row['sender'] == $current_user)
                                $user_to_show   =   explode('-' , $row['receiver']);
                            if ($row['receiver'] == $current_user)
                                $user_to_show   =   explode('-' , $row['sender']);

                            $user_to_show_type      =   $user_to_show[0];
                            $user_to_show_id        =   $user_to_show[1];
                            $message_thread_code    =   $row['message_thread_code'];

                        ?>
                            <li>
                                <a href="<?php echo base_url();?>index.php?patient/message_read/<?php echo $message_thread_code;?>"> 
                                    <i class="fa fa-angle-right"></i>
                                    <?php echo $this->db->get_where($user_to_show_type , array($user_to_show_type.'_id' => $user_to_show_id))->row()->name;?>
                                    <span class="label label-default pull-right"><?php echo $user_to_show_type;?></span>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        ?>    
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a class="btn btn-danger btn-sm"
                        href="<?php echo base_url();?>index.php?patient/message_new">
                            <i class="fa fa-times"></i> 
                                Discard
                    </a>
                </div>
                <h2>
                    Send a new message
                </h2>
            </div>
            <div class="mail-box">
                <?php 
                    echo form_open(base_url() . 'index.php?patient/message_new/send_new_message/' , array(
                        'class' => 'from-horizontal' ,'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
                    ));
                ?>
                    <div class="mail-body">
                        <div class="form-group">
                            <select name="receiver" class="form-control">
                                <option value="admin-1">
                                    <?php echo $this->db->get_where('admin' , array('admin_id' => 1))->row()->name;?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mail-text h-200">
                        <div>
                            <textarea class="summernote input-block-level" id="content" name="message_body" rows="18"></textarea>
                        </div>
                    <div class="clearfix"></div>
                    </div>

                    <div class="mail-body text-right tooltip-demo" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> Send</button>
                    </div>
                <?php echo form_close();?>
                <div class="clearfix"></div>

            </div>
        </div>

    </div>
</div>

