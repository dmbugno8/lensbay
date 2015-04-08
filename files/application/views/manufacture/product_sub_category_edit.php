<?php
	$update = $this->db->get_where('sub_category' , array('sub_category_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit <?php echo $this->db->get_where('sub_category' , array('sub_category_id' => $param2))->row()->name;?></h3>

<br>
<?php foreach ($update as $row):?>
	<?php 
        echo form_open(base_url() . 'index.php?admin/product_sub_category/edit/' . $row['sub_category_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

		<div class="form-group">
			<div style="width: 30%; height: 30%;">
	            <div class="text-center">
	                <img class="img m-t-xs img-responsive" 
	                	src="<?php echo $this->crud_model->get_image_url_object('product_sub_category' , $row['sub_category_id']);?>">
	            </div>
	        </div>
	    </div>

		<div class="form-group">
	    	<label>Name *</label>
	    		<input type="text" placeholder="Sub-category Name" class="form-control" name="name"
	    			value="<?php echo $row['name'];?>" required>
	    </div>
	    
	    <div class="form-group">
	    	<label>Category *</label>
	    		<select name="category_id" class="form-control" required>
	    			<option value="">Select Product Category</option>
	    			<?php 
	    				$categories = $this->db->get('category')->result_array();
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
	    	<label>Description</label>
	    		<textarea type="text" placeholder="Category Description" class="form-control" name="description"><?php echo $row['description'];?></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Update Product Sub-category Image</label>
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