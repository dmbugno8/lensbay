
<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Customer</h3>

<br>
	<?php 
		echo form_open(base_url() . 'index.php?admin/customer/create/' , array(
			'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
		));
	?>

		<div class="form-group">
	    	<label>Customer Code</label>
	    		<input type="text" class="form-control" name="customer_code" readonly=""
	    			value="<?php echo rand() . "\n";?>" required>
	    </div>

		<div class="form-group">
	    	<label>Company Name *</label>
	    		<input type="text" placeholder="Customer Name" class="form-control required" name="name" required>
	    </div>

	    <div class="form-group">
	    	<label>Email *</label>
	    		<input type="email" placeholder="Enter email" class="form-control" name="email" required>
	    </div>

	    <div class="form-group">
	    	<label>Password *</label>
	    		<input type="password" placeholder="Password" class="form-control" name="password" required>
	    </div>

	    <div class="form-group">
	    	<label>Phone</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="phone">
	    </div>

		<h3>BILL TO:</h3>

	    <div class="form-group">
	    	<label>Company Name</label>
	    		<input type="text" placeholder="Company Name" class="form-control" name="bill_to_name"
	    </div>

	    <div class="form-group">
	    	<label>Street Address</label>
	    		<input type="text" placeholder="Street Address" class="form-control" name="bill_to_street"
	    </div>

	    <div class="form-group">
	    	<label>City</label>
	    		<input type="text" placeholder="City" class="form-control" name="bill_to_city"
	    </div>

	    <div class="form-group">
	    	<label>State</label>
	    		<input type="text" placeholder="State" class="form-control" name="bill_to_state"
	    </div>

	    <div class="form-group">
	    	<label>Zipcode</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="bill_to_zip"
	    </div>

		<h3>SHIP TO:</h3>
		
	    <div class="form-group">
	    	<label>Company Name</label>
	    		<input type="text" placeholder="Company Name" class="form-control" name="ship_to_name"
	    </div>

	    <div class="form-group">
	    	<label>Street Address</label>
	    		<input type="text" placeholder="Street Address" class="form-control" name="ship_to_street"
	    </div>

	    <div class="form-group">
	    	<label>City</label>
	    		<input type="text" placeholder="City" class="form-control" name="ship_to_city"
	    </div>

	    <div class="form-group">
	    	<label>State</label>
	    		<input type="text" placeholder="State" class="form-control" name="ship_to_state"
	    </div>

	    <div class="form-group">
	    	<label>Zipcode</label>
	    		<input type="text" placeholder="Zipcode" class="form-control" name="ship_to_zip"
	    </div>


	   	<div class="form-group">
	    	<label>Upload Profile Picture</label>
	    		<input type="file" class="form-control" name="userfile">
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

<script type="text/javascript">
	// FOR FORM VALIDATION
	$("#validated_form").validate();
</script>
      