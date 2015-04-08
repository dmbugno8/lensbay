<div class="col-sm-12"><h3 class="m-t-none m-b">Add New Material Manufacture</h3>

<br>
	<?php 
        echo form_open(base_url() . 'index.php?admin/material_manufacture_category/create/' , array(
            'id' => 'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>


		<div class="form-group">
	    	<label>Manufacture Name *</label>
	    		<input type="text" placeholder="Sub-category Name" class="form-control" name="name" required>
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