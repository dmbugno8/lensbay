<?php 
	$employee	=	$this->db->get_where('employee' , array('employee_id' => $param2))->result_array();
 ?>

<?php foreach ($employee as $row):?>
<div>
    <div class="contact-box">
        <div class="col-sm-4">
            <div class="text-center">
                <img class="img m-t-xs img-responsive" 
                	src="<?php echo $this->crud_model->get_image_url('employee' , $row['employee_id']);?>">
            </div>
        </div>
        <div class="col-sm-8">
            <h3><strong><?php echo $row['name'];?></strong></h3>
            <p><strong><?php echo $row['email'];?></strong></p>
            <?php if ($row['type'] == 1):?>
                <p><strong>Sales Staff</strong></p>
            <?php endif;?>
            <?php if ($row['type'] == 2):?>
                <p><strong>Purchase Staff</strong></p>
            <?php endif;?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php endforeach;?>