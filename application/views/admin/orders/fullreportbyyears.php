<!-- Full Report By Years -->
<div class="page-header">
	<h3><?php echo __("Full Report By Years")?></h3>
</div>

<script src="<?php echo URL::base()?>public/js/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo URL::base()?>public/js/highcharts/modules/exporting.js" type="text/javascript"></script>
<!-- <script src="http://code.highcharts.com/highcharts-3d.js"></script>-->

<div class="row-fluid">
	<!-- Left Row -->
	<div class="span3">
		<div class="well">
			<table id="report" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Рік</th>
					<th>Сума</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$total = 0;
			$years = "";
			$sums = "";
			
			foreach ($data as $obj)
			{
				echo "<tr>\n<td>{$obj->Y}</td>\n<td>{$obj->FullSum}</td>\n</tr>\n";
				$total += doubleval($obj->FullSum);
				$years.= "'".$obj->Y."'".",";
				$sums.= $obj->FullSum.",";
			}
			echo "<tr class=\"success\">\n<td colspan=\"2\"><strong>Всього: {$total}&nbsp;грн.</strong></td>\n</tr>\n"; 
			?>
			</tbody>
			</table>
		</div>
	</div>
	<!-- /Left Row -->
	
	<!--  JS Insertion for HC -->
	<script type="text/javascript">
	jQuery(function () {
        jQuery('#gcon').highcharts({
            chart: {
                type: 'pie',
                height: 600
                //inverted: true
            },
            title: {
                text: 'Сума операцій по рокам'
            },

            tooltip: {
            	pointFormat: '<b>{point.percentage:.2f}%  => {point.y} грн.</b>'
            },
            
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    /*dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.2f} %</b>',
                    }*/
                }
            },
            series: [{
                type: 'pie',
                name: 'babules',
                data: [<?php
                foreach ($data as $obj) 
				{
					echo "['{$obj->Y}', {$obj->FullSum}],\n";                	
                }
 
                ?>]
            }]
        });
    });
    
			
	</script>
	
	<!-- Right Row -->
	<div class="span9">
		<div id="gcon"></div>
	</div>
	<!-- /Right Row -->
</div>
<!-- /Full Report By Years -->