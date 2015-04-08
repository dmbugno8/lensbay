<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Product</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?admin/product/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
	    	<label>Serial Number *</label>
	    		<input type="text" placeholder="Serial Number" class="form-control" name="serial_number" readonly=""
	    				value="<?php echo rand() . "\n";?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Product Name" class="form-control" name="name" required>
	    </div>

	    <div class="form-group">
	    	<label>Category</label>
	    		<select name="category_id" class="form-control">
	    			<option value="">Select Product Category</option>
	    			<?php 
	    				$categories	=	$this->db->get('category')->result_array();
	    				foreach ($categories as $row):
	    					?>
	    			<option value="<?php echo $row['category_id'];?>"><?php echo $row['name'];?></option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Sub-category</label>
	    		<select name="sub_category_id" class="form-control">
	    			<option value="">Select Product Sub-category</option>
	    			<?php 
	    				$sub_categories	=	$this->db->get('sub_category')->result_array();
	    				foreach ($sub_categories as $row):
	    					?>
	    			<option value="<?php echo $row['sub_category_id'];?>"><?php echo $row['name'];?></option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Purchase Price *</label>
	    		<input type="text" placeholder="Enter Purchase Price" class="form-control" name="purchase_price" required>
	    </div>

	    <div class="form-group">
	    	<label>Selling Price *</label>
	    		<input type="text" placeholder="Enter Selling Price" class="form-control" name="selling_price" required>
	    </div>

	   	<div class="form-group">
	    	<label>Notes</label>
	    		<textarea type="text"  class="form-control" name="note"></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Upload Product Image</label>
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
                    