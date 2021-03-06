
<div class="col-sm-12"><h3 class="m-t-none m-b">Create New Order</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?customer/order/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>


		<div class="form-group" id="datepicker">
			<label>Date *</label>
			<div class="input-group date ">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" class="form-control" name="timestamp" required>
			</div>
		</div>

		<div class="form-group">
            <label>Select Product *</label>
                <select name="product_id" class="form-control" required>
                    <option value="">Select Product</option>
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

        <div class="form-group">
            <label>Quantity *</label>
                <input type="text" class="form-control" name="quantity" placeholder="Product Quantity" required>
        </div>

	    <div class="form-group">
	    	<label>Shipping Address</label>
	    		<textarea type="text"  class="form-control" name="shipping_address"></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Notes</label>
	    		<textarea type="text"  class="form-control" name="note"></textarea>
	    </div>
	    

	    <center>
	        <div>
	            <button class="btn btn-primary btn-rounded" type="submit">
	            	<strong>Send</strong>
	            		</button>
	        </div>
	    </center>
	<?php echo form_close();?>
</div>

<script type="text/javascript">

	// FOR FORM VALIDATION
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
      