
<div class="row" style=" margin:100px 0px 200px;">

	<div class="col-md-6" style="text-align:center;">
    	<img src="<?php echo  $this->crud_model->get_image_url('patient' , $this->session->userdata('user_id'));?>" 
        	alt="" class="img-circle" style="height:60px;">
    	<h1 style="font-weight:100;margin:0px;">
    		<?php echo $this->session->userdata('name');?>
    	</h1>
	</div>
    
	<div class="col-md-6" style="text-align:center;">
    
    		
        <a type="button" class="btn btn-success col-md-5 col-xs-12"  style="margin:5px;"
            href="<?php echo base_url();?>index.php?patient/product">
                Products
                    <i class="fa fa-shopping-cart"></i>
        </a>
            
        <a type="button" class="btn btn-info col-md-5 col-xs-12"  style="margin:5px;"
            href="<?php echo base_url();?>index.php?patient/order">
                Orders
                    <i class="fa fa-bars"></i>
        </a>

        <a type="button" class="btn btn-warning col-md-5 col-xs-12"  style="margin:5px;"
            href="<?php echo base_url();?>index.php?patient/purchase_history">
                Purchase History
                    <i class="fa fa-money"></i>
        </a>
            
        <a type="button" class="btn btn-primary col-md-5 col-xs-12"  style="margin:5px;"
			href="<?php echo base_url();?>index.php?patient/message">
        		Message
        			<i class="fa fa-paper-plane"></i>
        </a>
    
    
    
    
	</div>
</div>