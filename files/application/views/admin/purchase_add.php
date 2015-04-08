<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'order_add') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/purchase_add">New Purchase</a>
            </li>
        </ol>
    </div>
</div>

<br>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	    <div class="ibox float-e-margins">
	    	<div class="ibox-title">
	    		<small>Please fill the informations carefully. <b>Completed purchase can't be undone</b></small>
	    	</div>
	        <div class="ibox-content">
	        	<?php 
			        echo form_open(base_url() . 'index.php?admin/purchase_add/create/' , array(
			            'enctype' => 'multipart/form-data' , 'id' => 'validated_form'
			        ));
			    ?>

	                <div class="form-group">
                        <label>Purchase Code</label>
                            <input type="text" placeholder="" class="form-control" name="purchase_code" readonly
                                value="<?php echo substr( md5 ( rand(100000 , 1000000)) , 0 , 15);?>">
                    </div>

	                <div class="form-group">
                        <label>Supplier *</label>
                            <div class="input-group">
                                <select data-placeholder="Select a supplier" 
                                    class="chosen-select" style="width: 620px;" tabindex="2" name="supplier_id" required>
                                    <option value=""></option>
                                    <?php
                                    $suppliers  =   $this->db->get('supplier')->result_array();
                                    foreach ($suppliers as $row):?>
                                        <option value="<?php echo $row['supplier_id'];?>"> 
                                                <?php echo $row['name'];?>
                                            </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                    </div>

	                <div class="form-group">
                        <label>Product *</label>
                            <div class="input-group">
                                <select data-placeholder="Select a product" 
                                    class="chosen-select" style="width: 620px;" tabindex="2" name="product_id" required>
                                    <option value=""></option>
                                    <?php
                                    $products  =   $this->db->get('product')->result_array();
                                    foreach ($products as $row):?>
                                        <option value="<?php echo $row['product_id'];?>"> 
                                                <?php echo $row['name'];?>
                                            </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                    </div>

	                <div class="form-group">
	                    <label>Quantity *</label>
	                        <input type="text" class="form-control" name="quantity" placeholder="Product Quantity" id="quantity" 
	                        	value="" required onkeyup="return get_total()">
	                </div>

	                <div class="form-group">
	                    <label>Unit Price *</label>
	                        <input type="text" class="form-control" name="unit_price" placeholder="Product Unit Price" id="unit_price" 
	                        	value="" required onkeyup="return get_total()">
	                </div>

	                <div class="form-group">
	                    <label>Total Amount</label>
	                        <input type="text" class="form-control" name="total_amount" placeholder="Total amount" id="total" 
	                        	value="" required>
	                </div>

				    <div class="form-group">
				    	<label>Payment Method</label>
				    		<select name="method" class="form-control">
				    			<option value="">Select Payment Method</option>
				    			<option value="cash">Cash</option>
				    			<option value="cheque">Cheque</option>
				    			<option value="card">Card</option>
				    		</select>
				    </div>

	                <div class="form-group" id="data_1">
	                    <label>Date *</label>
	                        <div class="input-group date col-lg-12">
	                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                <input type="text" class="form-control" name="timestamp"
	                                	value="<?php echo date('m/d/Y');?>" required>
	                        </div>
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
	    </div>
	</div>
	<div class="col-md-2"></div>
</div>
<script type="text/javascript">
function get_total() {
	var quantity   		=  document.getElementById('quantity').value;
	var unitPrice  		=  document.getElementById('unit_price').value;
	var total      		=  quantity * unitPrice;
	var put_total  		=  document.getElementById('total');
	put_total.value  	= total;
	
	return true;
}	
</script>

                                          