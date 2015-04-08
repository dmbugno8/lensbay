<?php
	$update = $this->db->get_where('employee' , array('employee_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit <?php echo $this->db->get_where('employee' , array('employee_id' => $param2))->row()->name;?></h3>

<br>
<?php foreach ($update as $row):?>
	
	<?php 
        echo form_open(base_url() . 'index.php?admin/employee/edit/' . $row['employee_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
			<div style="width: 30%; height: 30%;">
	            <div class="text-center">
	                <img class="img m-t-xs img-responsive" 
	                	src="<?php echo $this->crud_model->get_image_url('employee' , $row['employee_id']);?>">
	            </div>
	        </div>
	    </div>
	    

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Employee Name" class="form-control" name="name"
	    			value="<?php echo $row['name'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Email *</label>
	    		<input type="email" placeholder="Enter email" class="form-control" name="email"
	    			value="<?php echo $row['email'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Employee Type *</label>
	    		<select name="type" class="form-control" required>
	    			<option value="">Select Employee Type</option>
	    			<option value="1"<?php if ($row['type'] == '1') echo 'selected';?>>Sales Staff</option>
	    			<option value="2"<?php if ($row['type'] == '2') echo 'selected';?>>Purchase Staff</option>
	    		</select>
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

<script type="text/javascript">
	$("#validated_form").validate();
</script>                        
                    