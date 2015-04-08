<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <h2><?php echo $page_title;?></h2>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li class="<?php if ($page_name == 'dashboard') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/dashboard">Dashboard</a>
            </li>
            <li class="<?php if ($page_name == 'product') echo 'active';?>">
                <a href="<?php echo base_url();?>index.php?admin/product_barcode">Product Barcode</a>
            </li>
        </ol>
    </div>
</div>

<br>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Product Barcodes</h5>
                <div class="ibox-tools">
                    <a href="#" onClick="PrintElem('#barcode_print')" class="btn btn-primary btn-sm">
            			<i class="fa fa-print"></i> Print Barcodes 
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" id="barcode_print" >

            <table class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th>#</th>
                <th>Serial No.</th>
                <th>Name</th>
                <th>Barcode</th>
            </tr>
            </thead>
            <tbody>

            
				<?php 
                    $count = 1;
                    foreach($products as $row):
                ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['serial_number'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td>
                            <center>
                                <img src="<?php echo base_url();?>index.php?admin/product_barcode/create_barcode/<?php echo $row['serial_number'];?>" 
                                style="height: 60px;">
                            </center>
                        </td>
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


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=700,width=900');
        mywindow.document.write('<html><head><title>Invoice</title>');
       
        mywindow.document.write('<link rel="stylesheet" href="assets/css/style.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

		setTimeout(function() {
			mywindow.print();
			mywindow.close();
		}, 500);
        
        

        return true;
    }

</script>
