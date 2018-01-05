<!-- Report by categories -->
<div class="page-header">
	<h1>Звіт за період: <?php echo $startDate ?> - <?php echo $endDate?></h1>
	<h3><?php echo "{$operationTypes[$operationType]}"?></h3>
</div>

<script src="<?php echo URL::base()?>public/js/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo URL::base()?>public/js/highcharts/modules/exporting.js" type="text/javascript"></script>
<!-- <script src="http://code.highcharts.com/highcharts-3d.js"></script>-->

<div class="row-fluid">
	<!-- Left Row -->
	<div class="span4">
		<div class="well">
			<table id="report" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Категорія</th>
					<th>Сума</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$total = 0;
			$categories = "";
			$sums = "";
			
			foreach ($sumOfMoney as $category => $sum)
			{
				echo "<tr>\n<td>{$category}</td>\n<td>{$sum}</td>\n</tr>\n";
				$total += $sum;
				$categories.= "'".$category."'".",";
				$sums.= $sum.",";
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
                //height: 600,
                //inverted: true
            },
            title: {
                text: 'Розподіл витрат за період'
            },

            tooltip: {
            	pointFormat: '<b>{point.percentage:.2f}%</b>'
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
                foreach ($sumOfMoney as $category => $sum) 
				{
					echo "['{$category}', {$sum}],\n";                	
                }
 
                ?>]
            }]
        });
    });
    
			
	</script>
	
	<!-- Right Row -->
	<div class="span8">
		<div id="gcon">
			
		</div>
	</div>
	<!-- /Right Row -->
</div>
<!-- /Report by categories -->