<script>

function check_sale()
{
    if (total_number < 1)
    {
        $("#product_area").focus();
        $.gritter.add({
                title: 'Please choose a product first',
                text: '',
                time: 4000
            });
        return false;
    }
}
</script>

<?php
$sale_details   =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->result_array();
foreach ($sale_details as $row1):
?>
<form action="<?php echo base_url();?>index.php?admin/sale_edit/do_edit/<?php echo $row1['invoice_id'];?>" method="post" onsubmit="return check_sale()">

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r">
                            <h2 class="text-center">Edit Sale</h2>
                            <p class="text-center">
                                <a href=""><i class="fa fa-shopping-cart big-icon"></i></a>
                            </p>
                        </div>

                        <!-- INVOICE BASIC INFO INPUT -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Invoice Code</label>
                                    <input type="text" placeholder="" class="form-control" name="invoice_code" readonly=""
                                        value="<?php echo $row1['invoice_code'];?>">
                            </div>
                            <div class="form-group">
                                <label>Customer</label>
                                    <div class="input-group">
                                        <select data-placeholder="Select a customer" 
                                            class="chosen-select" style="width: 458px;" tabindex="2" name="customer_id">
                                            <option value=""></option>
                                            <?php
                                            $customers  =   $this->db->get('customer')->result_array();
                                            foreach ($customers as $row):?>
                                                <option value="<?php echo $row['customer_id'];?>"
                                                    <?php if ($row1['customer_id'] == $row['customer_id']) echo 'selected';?>>
                                                    [<?php echo $row['customer_code'];?> ] - 
                                                        <?php echo $row['name'];?>
                                                    </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group" id="data_1">
                                <label>Date</label>
                                    <div class="input-group date col-lg-12">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" name="timestamp" required
                                                value="<?php echo date('m/d/Y' , $row1['timestamp']);?>">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="product_area" tabindex="1">
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
            
                <!-- INVOICE PRODUCT INPUT BY BARCODE -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Choose product by barcode
                    </div>
                    <div class="panel-body">
                        <input type="text" placeholder="Click here & scan barcode" class="form-control" name="">
                    </div>
                </div>

                <!-- INVOICE PRODUCT INPUT BY CATEGORY -->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Choose product by category
                    </div>
                    <div class="panel-body">
                        <select data-placeholder="Select a category" onchange="get_product('category' , this.value)" 
                            class="chosen-select" style="width: 240px;" tabindex="2" name="category_id">
                            <option value=""></option>
                            <?php
                            $categories  =   $this->db->get('category')->result_array();
                            foreach ($categories as $row):?>
                                <option value="<?php echo $row['category_id'];?>">
                                    <?php echo $row['name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <br><br>

                        <div id="sub_category_holder">
                        </div>
                    </div>

                    <!-- PRODUCT LIST, LOADS ON CATEGORY SELECTION -->
                    <div id="product_list_holder">
                    
                    </div>
                </div>

                                
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="ibox-title">
            <h5>Invoice Entries</h5>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Total</th>
                            <th><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody id="invoice_entry_holder">

                        <?php
                        $total_number   =   0;
                        $sub_total      =   0;
                        $invoice_entries = json_decode($row1['invoice_entries']);
                        foreach ($invoice_entries as $invoice_entry):
                            $total_number++;
                            ?>

                        <tr id="entry_row_<?php echo $total_number;?>">
                        <td id="serial_number_<?php echo $total_number;?>"><?php echo $total_number;?></td>
                        <td>
                            <?php echo $this->db->get_where('product',array('product_id'=>$invoice_entry->product_id))->row()->serial_number;?>
                        </td>
                        <td>
                            <?php echo $this->db->get_where('product',array('product_id'=>$invoice_entry->product_id))->row()->name;?>
                            <input type="hidden" name="product_id[]" value="<?php echo $invoice_entry->product_id;?>" size="3" style="width:50px;" 
                                id="single_entry_product_id_<?php echo $total_number;?>">
                        </td>
                        <td>
                            <input type="number" name="total_number[]" value="<?php echo $invoice_entry->total_number;?>" 
                                size="3" style="width:50px;" 
                                id="single_entry_quantity_<?php echo $total_number;?>"
                                    onkeyup="calculate_single_entry_total(<?php echo $total_number;?>)">
                        </td>
                        <td>
                            <input type="number" name="selling_price[]" value="<?php echo $invoice_entry->selling_price;?>"  
                                id="single_entry_selling_price_<?php echo $total_number;?>"
                                    onkeyup="calculate_single_entry_total(<?php echo $total_number;?>)">
                        </td>
                        <td id="single_entry_total_<?php echo $total_number;?>"> 
                            <?php 
                            echo ($invoice_entry->selling_price * $invoice_entry->total_number);
                            $sub_total  += ($invoice_entry->selling_price * $invoice_entry->total_number);
                            ?>
                        </td>
                        <td>
                            <i class="fa fa-trash-o" onclick="remove_row(<?php echo $total_number;?>)"
                                id="delete_button_<?php echo $total_number;?>"  style="cursor:pointer;"></i>
                                </td>
                        </tr>

                            <?php 
                        
                        endforeach;
                        ?>

                    </tbody>
                </table>

                <!-- SUB TOTAL, GRAND TOTAL CALCULATION -->
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6" style="border-left: 1px dotted #e7eaec;">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Sub-total</td>
                                <td class="text-right" id="sub_total"><?php echo $sub_total;?></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td class="text-right">
                                    <input type="number" name="discount_percentage" id="discount_percentage" onkeyup="calculate_grand_total()"
                                        value="<?php echo $this->db->get_where('settings',array('type'=>'discount_percentage'))->row()->description;?>"> %
                                </td>
                            </tr>
                            <tr>
                                <td>VAT</td>
                                <td class="text-right">
                                    <input type="number" name="vat_percentage" id="vat_percentage" onkeyup="calculate_grand_total()"
                                        value="<?php echo $this->db->get_where('settings',array('type'=>'vat_percentage'))->row()->description;?>"> %
                                </td>
                            </tr>
                            <tr>
                                <td><b>Grand total</b></td>
                                <td class="text-right" id="grand_total"><b>
                                    <?php 
                                    $sub_total              =   $sub_total - ($sub_total * ($row1['discount_percentage'] / 100));
                                    $grand_total            =   $sub_total + ($sub_total * ($row1['vat_percentage'] / 100));
                                    echo $grand_total;
                                    ?>
                                </b></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <input type="submit" value="Update this sale" class="btn btn-success">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PAYMENT INPUT CALCULATION -->
                <div class="row">
                    <div class="col-lg-12">
                    
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td colspan="4" style="text-align: center;">
                                    <h4>Payment history</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $counter=1;
                            $payment_history = $this->db->get_where('payment',array('invoice_id'=>$row1['invoice_id']))->result_array();
                            foreach ($payment_history as $row):
                                ?>
                                <tr>
                                    <td><?php echo $counter++;?></td>
                                    <td><?php echo $row['amount'];?></td>
                                    <td><?php echo $row['method'];?></td>
                                    <td><?php echo date('d M, Y' , $row['timestamp']);?></td>
                                </tr>
                                <?php 
                            endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

</form>
<?php endforeach;?>

