<?php
	$update = $this->db->get_where('patient' , array('patient_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit <?php echo $this->db->get_where('patient' , array('patient_id' => $param2))->row()->name;?></h3>

<br>
<?php foreach ($update as $row):?>
	
	<?php 
		echo form_open(base_url() . 'index.php?admin/patient/edit/' . $row['patient_id'] , array(
			'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
		));
	?>

		<div class="form-group">
			<div style="width: 30%; height: 30%;">
	            <div class="text-center">
	                <img class="img m-t-xs img-responsive" 
	                	src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>">
	            </div>
	        </div>
	    </div>

		<div class="form-group">
	    	<label>patient Code</label>
	    		<input type="text" class="form-control" name="patient_code" readonly=""
	    			value="<?php echo $row['patient_code'];?>" required>
	    </div>	    

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="patient Name" class="form-control" name="name"
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

	    <div class="form-group">
	    	<label>Address</label>
	    		<input type="text" placeholder="Enter Address" class="form-control" name="address"
	    			value="<?php echo $row['address'];?>">
	    </div>

	    <div class="form-group">
	    	<label>Gender</label>
	    		<select name="gender" class="form-control">
	    			<option value="">Select Gender</option>
	    			<option value="Male"<?php if ($row['gender'] == 'Male') echo 'selected';?>>Male</option>
	    			<option value="Female"<?php if ($row['gender'] == 'Female') echo 'selected';?>>Female</option>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Age</label>
	    		<input type="text" placeholder="Enter Age" class="form-control" name="age"
	    			value="<?php echo $row['age'];?>">
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
                    