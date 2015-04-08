<?php
$invoice_details	=	$this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->result_array();
foreach ($invoice_details as $row):
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Invoice</h2>
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'purchase_history') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/purchase_history">Purchase History</a>
            </li>
            <li class="<?php if ($page_name == 'invoice_view') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?customer/invoice_view">View Invoice</a>
            </li>
        </ol>
     </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="#" onClick="PrintElem('#invoice_print')" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
        </div>
    </div>
</div>
<div class="row" id="invoice_print">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>From:</h5>
                            <address>
                                <strong>
                                	<?php
										echo $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;
									?>
                                </strong><br>
                                <?php
									echo $this->db->get_where('settings' , array('type' => 'address'))->row()->description;
								?>
                                <br>
                                <?php
									echo $this->db->get_where('settings' , array('type' => 'phone'))->row()->description;
								?>
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Invoice No.</h4>
                            <h4 class="text-navy"><?php echo $row['invoice_code'];?></h4>
                            <span>To:</span>
                            <address>
                                <strong>
                                	<?php echo $this->db->get_where('customer',array('customer_id'=>$row['customer_id']))
															->row()->name;?>
                                </strong><br>
                                	<?php echo $this->db->get_where('customer',array('customer_id'=>$row['customer_id']))
															->row()->address;?><br>
                                
                                	<?php echo $this->db->get_where('customer',array('customer_id'=>$row['customer_id']))
															->row()->phone;?>
                            </address>
                            <p>
                                <span><strong>Invoice Date:</strong> <?php echo date('d M, Y' , $row['timestamp']);?></span><br/>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th width="50">Serial Number</th>
                                <th>Product List</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php 
								$sub_total			=	0;
								$invoice_entries	=	json_decode($row['invoice_entries']);
								foreach ($invoice_entries as $row2):
								?>
                                    <tr>
                                        <td><?php echo $this->db->get_where('product',array('product_id'=>$row2->product_id))
                                                            ->row()->serial_number;?></td>
                                        <td>
                                            <?php echo $this->db->get_where('product',array('product_id'=>$row2->product_id))
                                                            ->row()->name;?></td>
                                        <td><?php echo $row2->total_number;?></td>
                                        <td><?php echo $row2->selling_price;?></td>
                                        <td>
											<?php 
												$sub_total	+=	($row2->total_number * $row2->selling_price);
												echo ($row2->total_number * $row2->selling_price);
											?>
                                        </td>
                                    </tr>
                            	<?php endforeach;?>
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->
                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td><?php echo $sub_total;?></td>
                        </tr>
                        <tr>
                            <td><strong>Discount Percentage :</strong></td>
                            <td><?php echo $row['discount_percentage'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Vat Percentage :</strong></td>
                            <td><?php echo $row['vat_percentage'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total :</strong></td>
                            <td>
                            	<?php
									$sub_total		=	$sub_total - ( $sub_total * ($row['discount_percentage'] / 100) );
									$grand_total	=	$sub_total + ( $sub_total * ($row['vat_percentage'] / 100) );
									echo $grand_total;
								?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <!-- PAYMENT HISTORY OF THIS INVOICE -->
                    <h4>Payment History</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Amount</td>
                                <td>Method</td>
                                <td>Date</td>
                                <td>Customer</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $payment_history    =   $this->db->get_where('payment' , array('invoice_id' => $row['invoice_id']))->result_array();
                            foreach ($payment_history as $row2):
                            ?>
                                <tr>
                                    <td> <?php echo $row2['amount'];?> </td>
                                    <td> <?php echo $row2['method'];?> </td>
                                    <td> <?php echo date("d M, Y" , $row2['timestamp']);?> </td>
                                    <td> <?php echo $this->db->get_where('customer' , array('customer_id' => $row2['customer_id']))->row()->name;?> </td>
                                </tr>

                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>


</div>
<?php endforeach;?>

<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
       
        mywindow.document.write('<link rel="stylesheet" href="assets/css/style.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>