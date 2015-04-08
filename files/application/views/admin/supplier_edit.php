<?php
	$update = $this->db->get_where('supplier' , array('supplier_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit <?php echo $this->db->get_where('supplier' , array('supplier_id' => $param2))->row()->name;?></h3>

<br>
<?php foreach ($update as $row):?>
	<?php 
        echo form_open(base_url() . 'index.php?admin/supplier/edit/' . $row['supplier_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
			<div style="width: 30%; height: 30%;">
	            <div class="text-center">
	                <img class="img m-t-xs img-responsive" 
	                	src="<?php echo $this->crud_model->get_image_url('supplier' , $row['supplier_id']);?>">
	            </div>
	        </div>
	    </div>

		<div class="form-group">
	    	<label>Company *</label>
	    		<input type="text" placeholder="Company" class="form-control" name="company"
	    			value="<?php echo $row['company'];?>" required>
	    </div>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Supplier Name" class="form-control" name="name"
	    			value="<?php echo $row['name'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Email *</label>
	    		<input type="email" placeholder="Enter email" class="form-control" name="email"
	    			value="<?php echo $row['email'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Phone</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="phone"
	    			value="<?php echo $row['phone'];?>">
	    </div>

		<h3>BILL TO:</h3>

	    <div class="form-group">
	    	<label>Company Name</label>
	    		<input type="text" placeholder="Company Name" class="form-control" name="bill_to_name"
	    			value="<?php echo $row['bill_to_name'];?>">
	    </div>

	    <div class="form-group">
	    	<label>Street Address</label>
	    		<input type="text" placeholder="Street Address" class="form-control" name="bill_to_street"
	    			value="<?php echo $row['bill_to_street'];?>">
	    </div>

	    <div class="form-group">
	    	<label>City</label>
	    		<input type="text" placeholder="City" class="form-control" name="bill_to_city"
	    			value="<?php echo $row['bill_to_city'];?>">
	    </div>

	    <div class="form-group">
	    	<label>State</label>
	    		<input type="text" placeholder="State" class="form-control" name="bill_to_state"
	    			value="<?php echo $row['bill_to_state'];?>">
	    </div>

	    <div class="form-group">
	    	<label>Zipcode</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="bill_to_zip"
	    			value="<?php echo $row['bill_to_zip'];?>">
	    </div>

		<h3>SHIP TO:</h3>
		
	    <div class="form-group">
	    	<label>Company Name</label>
	    		<input type="text" placeholder="Company Name" class="form-control" name="ship_to_name"
	    			value="<?php echo $row['ship_to_name'];?>">
	    </div>

	    <div class="form-group">
	    	<label>Street Address</label>
	    		<input type="text" placeholder="Street Address" class="form-control" name="ship_to_street"
	    			value="<?php echo $row['ship_to_street'];?>">
	    </div>

	    <div class="form-group">
	    	<label>City</label>
	    		<input type="text" placeholder="City" class="form-control" name="ship_to_city"
	    			value="<?php echo $row['ship_to_city'];?>">
	    </div>

	    <div class="form-group">
	    	<label>State</label>
	    		<input type="text" placeholder="State" class="form-control" name="ship_to_state"
	    			value="<?php echo $row['ship_to_state'];?>">
	    </div>

	    <div class="form-group">
	    	<label>Zipcode</label>
	    		<input type="text" placeholder="Phone Number" class="form-control" name="ship_to_zip"
	    			value="<?php echo $row['ship_to_zip'];?>">
	    </div>

	   	<div class="form-group">
	    	<label>Change Profile Picture</label>
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
<?php endforeach;?>
</div>

<script>
    $("#validated_form").validate();
</script>                        
                    