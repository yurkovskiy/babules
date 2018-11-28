<!-- Full Report By Years -->
<div class="page-header">
	<h3><?php echo __("Full Report By Years Operations")?></h3>
</div>

<script src="<?php echo URL::base()?>public/js/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo URL::base()?>public/js/highcharts/modules/exporting.js" type="text/javascript"></script>

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
			$graph_arr = array(); // two-dim array for graph
			$categories = "";
			
			foreach ($data as $obj)
			{
				$graph_arr[0][$obj->Y] = $graph_arr[1][$obj->Y] = 0.0;
				if ($obj->operation_type == 0) $categories.= "{$obj->Y},";
			}
			
			foreach ($data as $obj)
			{
				($obj->operation_type == 0) ? $class = "error" : $class = "info";
				echo "<tr class=\"{$class}\">\n<td>{$obj->Y}</td>\n<td>{$obj->FullSum}</td>\n</tr>\n";
				$total += doubleval($obj->FullSum);
				$graph_arr[$obj->operation_type][$obj->Y] = $obj->FullSum;
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
                type: 'column',
                height: 600
                //inverted: true
            },
            title: {
                text: 'Сума операцій по рокам'
            },

            xAxis: {
                categories: [<?php echo $categories?>]
            },

            tooltip: {
            	pointFormat: '<b>{point.y} грн.</b>'
            },
            
            plotOptions: {
                column: {
                	pointPadding: 0.1,
                	borderWidth: 1
                }                    
            },
            series: [
                <?php
                foreach ($graph_arr as $k => $v) {
                	echo "{\n";
                	echo "name: '{$operationTypes[$k]}',\n";
                	echo "data: [\n";
                	foreach ($v as $key => $val) {
                		echo "{$val},";
                	}
                	echo "]},";
                }
                ?>     
            ]
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