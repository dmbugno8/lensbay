<?php
    $update = $this->db->get_where('order' , array('order_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit Order No. <?php echo $this->db->get_where('order' , array('order_id' => $param2))->row()->order_number;?></h3>

<br>
<?php foreach ($update as $row):?>
    
	<?php 
        echo form_open(base_url() . 'index.php?admin/order/edit/' . $row['order_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>
        
        <div class="form-group" id="datepicker">
            <label>Date *</label>
            <div class="input-group date ">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" name="timestamp"
                    value="<?php echo date('dS M, Y' , $row['timestamp']);?>" required>
            </div>
        </div>

        <div class="form-group">
	    	<label>Order Number *</label>
	    		<input type="text" class="form-control" name="order_number" readonly=""
	    			value="<?php echo $row['order_number'];?>" required>
	    </div>

        <div class="form-group">
	    	<label>Customer *</label>
	    		<select name="customer_id" class="form-control" required>
	    			<option value="">Select Customer</option>
	    			<?php 
	    				$customers	=	$this->db->get('customer')->result_array();
	    				foreach ($customers as $row2):
	    					?>
	    			<option value="<?php echo $row2['customer_id'];?>"
	    				<?php if ($row['customer_id'] == $row2['customer_id'])
	    					echo 'selected';?>>
	    						<?php echo $row2['name'];?>
	    			</option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Product *</label>
	    		<select name="product_id" class="form-control" required>
	    			<option value="">Select Product</option>
	    			<?php 
	    				$products	=	$this->db->get('product')->result_array();
	    				foreach ($products as $row3):
	    					?>
	    			<option value="<?php echo $row3['product_id'];?>"
	    				<?php if ($row['product_id'] == $row3['product_id'])
	    					echo 'selected';?>>
	    						<?php echo $row3['name'];?>
	    			</option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

        <div class="form-group">
	    	<label>Quantity *</label>
	    		<input type="text" placeholder="Product Quantity" class="form-control" name="quantity"
	    			value="<?php echo $row['quantity'];?>" required>
	    </div>

        <div class="form-group">
	    	<label>Order Status</label>
	    		<select name="order_status" class="form-control">
	    			<option value="">Select Status</option>
	    			<option value="0"<?php if ($row['order_status'] == 0) echo 'selected';?>>Pending</option>
	    			<option value="1"<?php if ($row['order_status'] == 1) echo 'selected';?>>Approved</option>
	    			<option value="2"<?php if ($row['order_status'] == 2) echo 'selected';?>>Rejected</option>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Payment Status</label>
	    		<select name="payment_status" class="form-control">
	    			<option value="">Select Payment Status</option>
	    			<option value="0"<?php if ($row['payment_status'] == 0) echo 'selected';?>>Unpaid</option>
	    			<option value="1"<?php if ($row['payment_status'] == 1) echo 'selected';?>>Paid</option>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Shipping Address</label>
	    		<textarea type="text"  class="form-control" name="shipping_address"><?php echo $row['shipping_address'];?></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Notes</label>
	    		<textarea type="text"  class="form-control" name="note"><?php echo $row['note'];?></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Notify Customer</label>
	    		<input type="checkbox" name="notify">
	    </div>

        <center>
            <div>
                <button class="btn btn-primary btn-rounded" type="submit">
                    <strong>Save</strong>
                        </button>
            </div>
        </center>
    <?php echo form_close();?>
<?php endforeach;?>
</div>
 
<script>
    $("#validated_form").validate();

    // FOR DATEPICKER
    $('#datepicker .input-group').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });
</script>                        
                    