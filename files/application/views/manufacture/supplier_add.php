<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Supplier</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?admin/supplier/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
	    	<label>Company *</label>
	    		<input type="text" placeholder="Company" class="form-control" name="company" required>
	    </div>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Supplier Name" class="form-control" name="name" required>
	    </div>

	    <div class="form-group">
	    	<label>Email *</label>
	    		<input type="email" placeholder="Enter supplier email" class="form-control" name="email" required>
	    </div>

	    <div class="form-group">
	    	<label>Phone</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="phone">
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
                        
<script>
    $("#validated_form").validate();
</script>                  