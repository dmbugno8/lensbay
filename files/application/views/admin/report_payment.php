<script>
var chart = AmCharts.makeChart("chartdiv",{
	"type"			: "pie",
	"titleField"	: "project",
	"valueField"	: "amount",
	"innerRadius"	: "40%",
	"angle"			: "15",
	"depth3D"		: 10,
	"pathToImages"	: "<?php echo base_url();?>assets/js/amcharts/images/",
	"amExport": {
					"top": 0,
                    "right": 0,
                    "buttonColor": '#EFEFEF',
                    "buttonRollOverColor":'#DDDDDD',
					"imageFileName"	: "Project Report",
                    "exportPNG":true,
                    "exportJPG":true,
                    "exportPDF":true,
                    "exportSVG":true
	},
	"dataProvider"	: [
		<?php
		$income		=	0;
		$expense	=	0;
		$this->db->order_by('timestamp' , 'desc');
		$this->db->where('timestamp >=' , $timestamp_start);
		$this->db->where('timestamp <=' , $timestamp_end);
		$payments	=	$this->db->get('payment')->result_array();
		foreach ($payments as $row)
		{
			if ($row['type'] == 'income')
				$income		+=	$row['amount'];
			if ($row['type'] == 'expense');
				$expense	+=	$row['amount'];
		}
		?>
		{
			"project": "Income",
			"amount": <?php echo $income;?>
		},
		{
			"project": "Expense",
			"amount": <?php echo $expense;?>
		},
	]
});
</script>

<div class="row">
	<center>
    <div class="col-md-4 col-md-offset-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
					<?php echo $page_title;?>
                </h5>
            </div>
            <div class="ibox-content">
            	<?php 
                    echo form_open(base_url() . 'index.php?admin/report/' . $report_type);
                ?>
                	<div class="form-group" id="data_5">
                        <label class="font-noraml">
                        	Date range
                        </label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="start" 
                            	value="<?php echo date('m/d/Y' , $timestamp_start);?>"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" name="end" 
                            	value="<?php echo date('m/d/Y' , $timestamp_end);?>"/>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">Go </button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    </center>
</div>
<div class="alert alert-info col-md-4 col-md-offset-4" style="text-align:center;">
	<?php echo date("d M, Y" , $timestamp_start) . " - " . date("d M, Y" , $timestamp_end);?>                                
</div>
<!-- FLOT CHARTS -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Payment comparison</h5>
            </div>
            <div class="ibox-content">
                    <div class="flot-chart">
						<div id="chartdiv" style="width:100%; height:100%;"></div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Payment report</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="ibox-content">

            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Method</th>
            </tr>
            </thead>
            <tbody>

            
        <?php 
            $count = 1;
            foreach($payments as $row):
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo date("d F, Y" , $row['timestamp']);?></td>
                <td><?php echo $row['amount'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['method'];?></td>
                
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