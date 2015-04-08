<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Customers</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $this->db->count_all('customer');?></h1>
                <small>Total customers</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
            <?php
                $this->db->like('order_status' , 0);
                $this->db->from('order');
                $pending_orders =   $this->db->count_all_results();
            ?>
                <span class="label label-info pull-right">Pending : <?php echo $pending_orders;?></span>
                <h5>Orders</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><?php echo $this->db->count_all('order');?></h1>
                <small>Total orders</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sales</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">
                    <?php
                        $total = 0;
                        $payment_as_income = $this->db->get_where('payment' , array('type' => 'income'))->result_array();
                        foreach ($payment_as_income as $row)
                        {
                            $total  +=  $row['amount'];
                        }
                        echo $total;
                    ?> 
                </h1>
                <small>Total Selling Amount</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Purchase</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">
                    <?php
                        $payment_as_expense = $this->db->get_where('payment' , array('type' => 'expense'))->result_array();
                        foreach ($payment_as_expense as $row)
                        {
                            $total  +=  $row['amount'];
                        }
                        echo $total;
                    ?> 
                </h1>
                <small>Total Purchasing Amount</small>
            </div>
        </div>
    </div>
</div>
<!-- FLOT CHARTS -->
<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Payment Report (last 30 days)</h5>
            </div>
            <div class="ibox-content">
            	<div id="payment_pie_diagram"  style="width:100%; height:300px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Customer Payment Report (last 30 days)</h5>
            </div>
            <div class="ibox-content">
            	<div id="customer_bar_diagram"  style="width:100%; height:300px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
var chart = AmCharts.makeChart("payment_pie_diagram",{
	"type"			: "pie",
	"titleField"	: "payment_type",
	"valueField"	: "amount",
	"innerRadius"	: "40%",
	"angle"			: "0",
	"depth3D"		: 0,
	"pathToImages"	: "<?php echo base_url();?>assets/js/amcharts/images/",
	"amExport": {
					"top": 0,
                    "right": 0,
                    "buttonColor": '#EFEFEF',
                    "buttonRollOverColor":'#DDDDDD',
					"imageFileName"	: "Payment Report",
                    "exportPNG":true,
                    "exportJPG":true,
                    "exportPDF":true,
                    "exportSVG":true
	},
	"dataProvider"	: [
		<?php
		$timestamp_start=	strtotime('-29 days', time());
		$timestamp_end	=	strtotime(date("m/d/Y"));
		$income			=	0;
		$expense		=	0;
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
			"payment_type": "Income",
			"amount": <?php echo $income;?>
		},
		{
			"payment_type": "Expense",
			"amount": <?php echo $expense;?>
		},
	]
});
</script>


<script>

var chart = AmCharts.makeChart("customer_bar_diagram", {
    "theme": "none",
    "type": "serial",
	"startDuration": 2,
    "dataProvider": [
	<?php
		$this->db->select_sum('amount');
		$this->db->group_by('customer_id'); 
		$this->db->order_by('timestamp' , 'desc');
		$this->db->select('timestamp, customer_id, method, type');
		
		$this->db->where('timestamp >=' , $timestamp_start);
		$this->db->where('timestamp <=' , $timestamp_end);
		$this->db->where('customer_id !=' , 0);
		$payments	=	$this->db->get('payment')->result_array();
		foreach ($payments as $row):
			?>
				{
                    "customer": "<?php echo $this->db->get_where('customer',
										array('customer_id' => $row['customer_id']))->row()->name ;?>",
                    "amount": <?php echo $row['amount'];?>,
                    "color": "#455064"
                },
	<?php endforeach;?> 
	],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "amount"
    }],
    "depth3D": 0,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },    
    "categoryField": "customer",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 30
    },
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
	}
});
</script>
