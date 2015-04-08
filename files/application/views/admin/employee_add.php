<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Employee</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?admin/employee/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Employee Name" class="form-control" name="name" required>
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
	    	<label>Employee Type *</label>
	    		<select name="type" class="form-control" required>
	    			<option value="">Select Employee Type</option>
	    			<option value="1">Sales Staff</option>
	    			<option value="2">Purchase Staff</option>
	    		</select>
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
	$("#validated_form").validate();
</script>                      
                    