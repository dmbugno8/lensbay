
<div class="wrapper wrapper-content">
    <div class="row">
    <?php
        $suppliers   =   $this->db->get_where('supplier' , array('supplier_id' => $param2))->result_array();
        foreach ($suppliers as $row):
    ?>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Supplier Info</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img class="img-responsive"
                            src="<?php echo $this->crud_model->get_image_url('supplier' , $row['supplier_id']);?>">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $row['name'];?></strong></h4>
                        <h4><strong><?php echo $row['company'];?></strong></h4>
                        <br>
                        <p>
                            <i class="fa fa-paper-plane"></i> <?php echo $row['email'];?> 
                        </p>
                        <p>
                            <i class="fa fa-phone"></i> <?php echo $row['phone'];?>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Information Details about <?php echo $row['name'];?></h5>
                </div>
                <div class="ibox-content">
                
                    <div class="panel blank-panel">

                        <div class="panel-heading">
                            <div class="panel-options">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Purchase history</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Purchase code</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $purchase_from_supplier =   $this->db->get_where('purchase' , array('supplier_id' => $param2))->result_array();
                                            foreach ($purchase_from_supplier as $row2):
                                        ?>
                                            <tr>
                                                <td><?php echo $row2['purchase_code'];?></td>
                                                <td>
                                                    <?php echo $this->db->get_where('product' , array('product_id' => $row2['product_id']))->row()->name;?>
                                                </td>
                                                <td><?php echo $row2['quantity'];?></td>
                                                <td><?php echo $row2['unit_price'];?></td>
                                                <td><?php echo $row2['total_amount'];?></td>
                                                <td><?php echo date('dS M, Y' , $row2['timestamp']);?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                        </tbody>
                                </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</div>