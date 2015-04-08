
<div class="wrapper wrapper-content">
    <div class="row">
    <?php
        $products   =   $this->db->get_where('product' , array('product_id' => $param2))->result_array();
        foreach ($products as $row):
    ?>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $row['name'];?></h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img class="img-responsive" 
                            src="<?php echo $this->crud_model->get_image_url_object('product' , $row['product_id']);?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Product Details</h5>
                </div>
                <div class="ibox-content">
                
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                               <td><b>Serial No.</b></td>
                               <td><?php echo $row['serial_number'];?></td>
                            </tr>
                            <tr>
                               <td><b>Category</b></td>
                               <td>
                                   <?php echo $this->db->get_where('category' , array('category_id' => $row['category_id']))->row()->name;?> 
                               </td>
                            </tr>
                            <tr>
                                <td><b>Sub-category</b></td>
                                <td>
                                   <?php echo $this->db->get_where('sub_category' , array('sub_category_id' => $row['sub_category_id']))->row()->name;?> 
                                </td>
                            </tr>
                            <tr>
                                <td><b>Purchase Price</b></td>
                                <td><?php echo $row['purchase_price'];?></td>
                            </tr>
                            <tr>
                                <td><b>Selling Price</b></td>
                                <td><?php echo $row['selling_price'];?></td>
                            </tr>
                            <tr>
                                <td><b>Stock Quantity</b></td>
                                <td><?php echo $row['stock_quantity'];?></td>
                            </tr>
                            <tr>
                                <td><b>Product Barcode</b></td>
                                <td>
                                    <img class="img-responsive" 
                                        src="<?php echo base_url();?>index.php?admin/product_barcode/create_barcode/<?php echo $row['serial_number'];?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php 
    endforeach;
    ?>
</div>