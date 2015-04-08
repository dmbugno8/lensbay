<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'customer') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/message">Messaging</a>
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
                            href="<?php echo base_url();?>index.php?customer/message_new">
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

                            $user_to_show_type           =   $user_to_show[0];
                            $user_to_show_id             =   $user_to_show[1];
                            $message_list_thread_code    =   $row['message_thread_code'];

                        ?>
                            <li>
                                <a href="<?php echo base_url();?>index.php?customer/message_read/<?php echo $message_list_thread_code;?>"> 
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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Messages</h5>
                </div>
                <div class="ibox-content">


                    <div>
                        <?php
                            $messages  =   $this->db->get_where('message' , array('message_thread_code' => $message_thread_code))->result_array();
                            foreach ($messages as $row):

                            $sender                 =   explode('-' , $row['sender']);
                            $sender_account_type    =   $sender[0];
                            $sender_id              =   $sender[1]; 
                        ?>
                        
                        <div class="feed-element">
                            <img alt="image" class="img-circle pull-left" 
                                src="<?php echo $this->crud_model->get_image_url($sender_account_type , $sender_id);?>">
                            <div class="media-body">
                                <small class="pull-right"><b><?php echo date("d M, Y" , $row['timestamp']);?></b></small>
                                <strong>
                                    <?php echo $this->db->get_where($sender_account_type , array($sender_account_type.'_id' => $sender_id))->row()->name;?>
                                </strong><br>
                                <p><?php echo $row['message_body'];?></p>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="feed-element" style="border-top: 4px #e7eaec solid;">
                    <br>
                        <?php 
                            echo form_open(base_url() . 'index.php?customer/message_reply/' . $message_thread_code , array(
                                'class' => 'from-horizontal' ,'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
                            ));
                        ?>

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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

