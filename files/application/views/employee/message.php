<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?employee/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'employee') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?employee/message">Messaging</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" 
                            href="<?php echo base_url();?>index.php?employee/message_new">
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
                                <a href="<?php echo base_url();?>index.php?employee/message_read/<?php echo $message_thread_code;?>"> 
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
        <div class="col-lg-8 animated fadeInRight">
        <div class="mail-box-header">
            <h2>
                Messages
            </h2>
        </div>
            <div class="mail-box">

                <table class="table table-hover table-mail">
                    <tbody>
                    <tr class="unread">
                        <td class="mail-subject" style="text-align:center; background-color: #ffffff;">
                            <p class="text-center">
                                <i class="fa fa-envelope big-icon"></i>
                            </p>
                            <h2>Please select a message to read</h2>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
