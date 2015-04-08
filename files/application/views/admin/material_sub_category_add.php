<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Sub-category</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?admin/material_sub_category/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

	    <div class="form-group">
	    	<label>Category *</label>
	    		<select name="material_manufacture_id" class="form-control" required>
	    			<option value="">Select Product Category</option>
	    			<?php 
	    				$categories = $this->db->get('material_manufacture')->result_array();
	    				foreach ($categories as $row):
	    					?>
	    			<option value="<?php echo $row['material_manufacture_id'];?>"><?php echo $row['name'];?></option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Sub-category Name" class="form-control" name="material_name" required>
	    </div>

		<div class="form-group">
	    	<label>DK Amount *</label>
	    		<input type="text" placeholder="Sub-category Name" class="form-control" name="dk_amount" required>
	    </div>

		<div class="form-group">
	    	<label>Button Size *</label>
	    		<input type="text" placeholder="Sub-category Name" class="form-control" name="material_button_size" required>
	    </div>


	    <div class="form-group">
	    	<label>Category *</label>
	    		<select name="category_id" class="form-control" required>
	    			<option value="">Select Product Category</option>
	    			<?php 
	    				$categories = $this->db->get('category')->result_array();
	    				foreach ($categories as $row):
	    					?>
	    			<option value="<?php echo $row['category_id'];?>"><?php echo $row['name'];?></option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Description</label>
	    		<textarea type="text" placeholder="Sub-category Description" class="form-control" name="description"></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Upload Product Sub-category Image</label>
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