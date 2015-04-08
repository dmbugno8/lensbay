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
    echo form_open(base_url() . 'index.php?admin/sale_add/do_add/' , array(
        'id' => 'sale' , 'onsubmit' => 'return check_sale()'
    ));
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r">
                            <h2 class="text-center">Create New Sale</h2>
                            <p class="text-center">
                                <a href=""><i class="fa fa-shopping-cart big-icon"></i></a>
                            </p>
                        </div>

                        <!-- INVOICE BASIC INFO INPUT -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Invoice Code</label>
                                    <input type="text" placeholder="" class="form-control" name="invoice_code" readonly
                                        value="<?php echo substr( md5 ( rand(100000 , 1000000)) , 0 , 15);?>">
                            </div>
                            <div class="form-group">
                                <label>Customer</label>
                                    <div class="input-group">
                                        <select data-placeholder="Select a customer" required 
                                            class="chosen-select" style="width: 458px;" tabindex="2" name="customer_id">
                                            <option value=""></option>
                                            <?php
                                            $customers  =   $this->db->get('customer')->result_array();
                                            foreach ($customers as $row):?>
                                                <option value="<?php echo $row['customer_id'];?>">
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
                                                value="<?php echo date('m/d/Y');?>">
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
                        <input type="text" placeholder="Click here & scan barcode" class="form-control" name="" autofocus
                            id="barcode"    onKeyPress="return barcode_input(event , this.value)" autocomplete="off">
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
                                <td class="text-right" id="sub_total">0</td>
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
                                <td class="text-right" id="grand_total"><b>0</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PAYMENT INPUT CALCULATION -->
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6" style="border-left: 1px dotted #e7eaec;">
                    
                        <table class="table">
                            <tbody>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <h4>Take payment</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td class="">
                                    <input type="text" name="amount" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Method</td>
                                <td class="text-right">
                                    <select name="method" class="form-control">
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="card">Card</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <input type="submit" value="Create new sale" class="btn btn-success">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="ibox-title">
            	    		<small>Please fill the informations carefully. <b>Completed sales can't be undone</b></small>
            	    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php echo form_close();?>