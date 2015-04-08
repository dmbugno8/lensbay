<?php
	$update = $this->db->get_where('product' , array('product_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit <?php echo $this->db->get_where('product' , array('product_id' => $param2))->row()->name;?></h3>

<br>
<?php foreach ($update as $row):?>
	<?php 
        echo form_open(base_url() . 'index.php?admin/product/edit/' . $row['product_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
			<div style="width: 30%; height: 30%;">
	            <div class="text-center">
	                <img class="img m-t-xs img-responsive" 
	                	src="<?php echo $this->crud_model->get_image_url_object('product' , $row['product_id']);?>">
	            </div>
	        </div>
	    </div>

		<div class="form-group">
	    	<label>Serial Number *</label>
	    		<input type="text" placeholder="Serial Number" class="form-control" name="serial_number" readonly=""
	    				value="<?php echo $row['serial_number'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Product Name" class="form-control" name="name"
	    			value="<?php echo $row['name'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Category</label>
	    		<select name="category_id" class="form-control">
	    			<option value="">Select Product Category</option>
	    			<?php 
	    				$categories	=	$this->db->get('category')->result_array();
	    				foreach ($categories as $row2):
	    					?>
	    			<option value="<?php echo $row2['category_id'];?>"
	    				<?php if ($row['category_id'] == $row2['category_id'])
	    					echo 'selected';?>>
	    						<?php echo $row2['name'];?>
	    			</option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Sub-category</label>
	    		<select name="sub_category_id" class="form-control">
	    			<option value="">Select Product Sub-category</option>
	    			<?php 
	    				$sub_categories	=	$this->db->get('sub_category')->result_array();
	    				foreach ($sub_categories as $row3):
	    					?>
	    			<option value="<?php echo $row3['sub_category_id'];?>"
	    				<?php if ($row['sub_category_id'] == $row3['sub_category_id'])
	    					echo 'selected';?>>
	    						<?php echo $row3['name'];?>
	    			</option>
	    		<?php endforeach;?>
	    		</select>
	    </div>

	    <div class="form-group">
	    	<label>Purchase Price *</label>
	    		<input type="text" placeholder="Enter Purchase Price" class="form-control" name="purchase_price"
	    			value="<?php echo $row['purchase_price'];?>" required>
	    </div>

	    <div class="form-group">
	    	<label>Selling Price *</label>
	    		<input type="text" placeholder="Enter Selling Price" class="form-control" name="selling_price"
	    			value="<?php echo $row['selling_price'];?>" required>
	    </div>

	   	<div class="form-group">
	    	<label>Notes</label>
	    		<textarea type="text"  class="form-control" name="note"><?php echo $row['note'];?></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Change Product Image</label>
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