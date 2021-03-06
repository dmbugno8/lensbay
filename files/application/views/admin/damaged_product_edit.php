<?php
    $update = $this->db->get_where('damaged_product' , array('damaged_product_id' => $param2))->result_array();
?>

<div class="col-sm-12"><h3 class="m-t-none m-b">Edit Damaged Product</h3>

<br>
<?php foreach ($update as $row):?>

    <?php 
        echo form_open(base_url() . 'index.php?admin/damaged_product/edit/' . $row['damaged_product_id'] , array(
            'id' =>'validated_form' , 'enctype' => 'multipart/form-data'
        ));
    ?>

        <div class="form-group" id="datepicker">
            <label>Date *</label>
            <div class="input-group date ">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" name="timestamp"
                    value="<?php echo date('dS M, Y' , $row['timestamp']);?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Select Product *</label>
                <select name="product_id" class="form-control" required>
                    <option value="">Select Damaged Product</option>
                    <?php 
                        $products   =   $this->db->get('product')->result_array();
                        foreach ($products as $row2):
                    ?>
                        <option value="<?php echo $row2['product_id'];?>"
                            <?php if ($row['product_id'] == $row2['product_id'])
                                echo 'selected';?>>
                                    <?php echo $row2['name'];?>
                        </option>
                    <?php
                    endforeach;
                    ?>  
                </select>
        </div>

        <div class="form-group">
            <label>Damaged Quantity *</label>
                <input type="text" placeholder="Damaged Product Quantity" class="form-control" name="quantity"
                    value="<?php echo $row['quantity'];?>" required>
        </div>

        <div class="form-group">
            <label>Notes</label>
                <textarea type="text" placeholder="Notes" class="form-control" name="note"><?php echo $row['note'];?></textarea>
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

    // FOR DATEPICKER
    $('#datepicker .input-group').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });
</script>                        
                    