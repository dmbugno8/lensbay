
<div class="wrapper wrapper-content">
    <div class="row">
    <?php
        $customers   =   $this->db->get_where('customer' , array('customer_id' => $param2))->result_array();
        foreach ($customers as $row):
    ?>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Customer Info</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img class="img-responsive" 
                            src="<?php echo $this->crud_model->get_image_url('customer' , $row['customer_id']);?>">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?php echo $row['name'];?></strong></h4>
                        <p>
                            <i class="fa fa-code-fork"></i> <?php echo $row['customer_code'];?> 
                        </p>
                        <br>
                        <p>
                            <i class="fa fa-paper-plane"></i> <?php echo $row['email'];?> 
                        </p>
                        <p>
                            <i class="fa fa-phone"></i> <?php echo $row['phone'];?> 
                        </p>
                        <p>
                            <i class="fa fa-map-marker"></i> <?php echo $row['ship_to_street'];?> 
                        </p>
                        <p>
                            </i> <?php echo $row['ship_to_city'];?> </i> <?php echo $row['ship_to_state'];?> , </i> <?php echo $row['ship_to_zip'];?> 
                        </p>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Information details about <?php echo $row['name'];?></h5>
                </div>
                <div class="ibox-content">
                
                    <div class="panel blank-panel">

                        <div class="panel-heading">
                            <div class="panel-options">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Order history</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Payment history</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $orders_of_customer =   $this->db->get_where('order' , array('customer_id' => $param2))->result_array();
                                            foreach ($orders_of_customer as $row2):
                                        ?>
                                            <tr>
                                                <td><?php echo $row2['order_number'];?></td>
                                                <td>
                                                    <?php echo $this->db->get_where('product' , array('product_id' => $row2['product_id']))->row()->name;?>
                                                </td>
                                                <td><?php echo $row2['quantity'];?></td>
                                                <!-- ORDER STATUS CHECK -->
                                                <?php if ($row2['order_status'] == 0): ?>
                                                    <td><label class="label label-warning"><i class="fa fa-spinner"></i> Pending</label></td>
                                                <?php endif;?>
                                                <?php if ($row2['order_status'] == 1): ?>
                                                    <td><label class="label label-primary"><i class="fa fa-check"></i> Approved</label></td>
                                                <?php endif;?>
                                                <?php if ($row2['order_status'] == 2): ?>
                                                    <td><label class="label label-danger"><i class="fa fa-times"></i> Rejected</label></td>
                                                <?php endif;?>
                                                <!-- ORDER STATUS CHECK -->
                                                <td><?php echo date('dS M, Y' , $row2['timestamp']);?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                        </tbody>
                                </table>
                                </div>

                                <div id="tab-2" class="tab-pane">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Invoice Code</th>
                                                <th>Payment Method</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $payments =   $this->db->get_where('payment' , array('customer_id' => $row['customer_id']))->result_array();
                                            foreach ($payments as $row3):
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $this->db->get_where('invoice' , array('customer_id' => $row['customer_id']))->row()->invoice_code;?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['method'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['amount'];?>
                                                </td>
                                                <td><?php echo date('dS M, Y' , $row3['timestamp']);?></td>
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

<!-- Calls data table -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true
            });
        });

    </script>

