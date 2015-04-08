<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'order_add') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/order_add">New Order</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	    <div class="ibox float-e-margins">
	        <div class="ibox-content">

	        	<?php 
			        echo form_open(base_url() . 'index.php?admin/order/create/' , array(
			            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
			        ));
			    ?>

	                <div class="form-group">
	                    <label>Order Number *</label>
	                        <input type="text" class="form-control" name="order_number" readonly=""
	                        	value="<?php echo rand() . "\n";?>" required>
	                </div>

	                <div class="form-group">
	                    <label>Select Customer *</label>
	                    <div class="input-group">
	                        <select data-placeholder="Select a customer" name="customer_id" 
	                        	class="chosen-select" style="width: 620px;" tabindex="2" required>
	                            <option value=""></option>
	                            <?php 
	                                $customers   =   $this->db->get('customer')->result_array();
	                                foreach ($customers as $row):
	                            ?>
	                                <option value="<?php echo $row['customer_id'];?>"><?php echo $row['name'];?></option>
	                            <?php
	                            endforeach;
	                            ?>  
	                        </select>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label>Select Product *</label>
	                    <div class="input-group">
	                        <select data-placeholder="Select a product" name="product_id" 
	                        	class="chosen-select" style="width: 620px;" tabindex="2" required>
	                            <option value=""></option>
	                            <?php 
	                                $products   =   $this->db->get('product')->result_array();
	                                foreach ($products as $row):
	                            ?>
	                                <option value="<?php echo $row['product_id'];?>"><?php echo $row['name'];?></option>
	                            <?php
	                            endforeach;
	                            ?>  
	                        </select>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label>Quantity *</label>
	                        <input type="text" class="form-control" name="quantity" placeholder="Product Quantity" required>
	                </div>

	                <div class="form-group">
				    	<label>Order Status</label>
				    		<select name="order_status" class="form-control">
				    			<option value="">Select Status</option>
				    			<option value="0">Pending</option>
				    			<option value="1">Approved</option>
				    			<option value="2">Rejected</option>
				    		</select>
				    </div>

				    <div class="form-group">
				    	<label>Payment Status</label>
				    		<select name="payment_status" class="form-control">
				    			<option value="">Select Payment Status</option>
				    			<option value="0">Unpaid</option>
				    			<option value="1">Paid</option>
				    		</select>
				    </div>

				    <div class="form-group">
				    	<label>Shipping Address</label>
				    		<textarea type="text"  class="form-control" name="shipping_address"></textarea>
				    </div>

				    <div class="form-group">
				    	<label>Notes</label>
				    		<textarea type="text"  class="form-control" name="note"></textarea>
				    </div>

	                <div class="form-group" id="data_1">
	                    <label>Date *</label>
	                        <div class="input-group date col-lg-8">
	                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                <input  type="text" class="form-control" name="timestamp" required>
	                        </div>
	                </div>

	                <center>
	                    <div>
	                        <button class="btn btn-primary btn-rounded" type="submit">
	                            <strong>Save</strong>
	                                </button>
	                    </div>
	                </center>   

				<?php echo form_close();?>

	        </div>
	    </div>
	</div>
	<div class="col-md-2"></div>
</div>
<script type="text/javascript">
	$("#validated_form").validate();
</script>

                                          