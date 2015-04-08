
<div class="col-sm-12"><h3 class="m-t-none m-b">Add New patient</h3>

<br>
	<?php 
		echo form_open(base_url() . 'index.php?admin/patient/create/' , array(
			'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
		));
	?>

		<div class="form-group">
	    	<label>patient Code</label>
	    		<input type="text" class="form-control" name="patient_code" readonly=""
	    			value="<?php echo rand() . "\n";?>" required>
	    </div>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="patient Name" class="form-control required" name="name" required>
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

		<div class="form-group">
	    	<label>Address</label>
	    		<input type="text" placeholder="Enter Address" class="form-control" name="address">
	    </div>

	    <div class="form-group">
	    	<label>Gender</label>
	    		<select name="gender" class="form-control">
	    			<option value="">Select Gender</option>
	    			<option value="Male">Male</option>
	    			<option value="Female">Female</option>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Age</label>
	    		<input type="text" placeholder="Enter Age" class="form-control" name="age">
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
      