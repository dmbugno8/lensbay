
<div class="row" style=" margin:100px 0px 200px;">

	<div class="col-md-6" style="text-align:center;">
    	<img src="<?php echo  $this->crud_model->get_image_url('employee' , $this->session->userdata('user_id'));?>" 
        	alt="" class="img-circle" style="height:60px;">
    	<h1 style="font-weight:100;margin:0px;">
    		<?php echo $this->session->userdata('name');?>
    	</h1>
	</div>
    
	<div class="col-md-6" style="text-align:center;">
    
    		<?php if ($employee_type == 1):?>
                <a type="button" class="btn btn-success col-md-5 col-xs-12"  style="margin:5px;"
                    href="<?php echo base_url();?>index.php?employee/sale_add">
                        Create new sale
                            <i class="fa fa-shopping-cart"></i>
                </a>
            <?php endif;?>
    
    		<?php if ($employee_type == 2):?>
                <a type="button" class="btn btn-success col-md-5 col-xs-12"  style="margin:5px;"
                    href="<?php echo base_url();?>index.php?employee/purchase_add">
                        Create new purchase
                            <i class="fa fa-money"></i>
                </a>
            <?php endif;?>
            
	        <a type="button" class="btn btn-primary col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?employee/message">
	        		Message
	        			<i class="fa fa-paper-plane"></i>
	        </a>
    
    
    
    
	</div>
</div>