<!-- Dynamic Year (Years) Order -->
<div class="page-header">
	<h3>Звіт за період: <?php echo $startDate ?> - <?php echo $endDate?></h3>
	<h4><?php echo "{$operationTypes[$operationType]}"?>
	<?php 
		if ($category_name != "") {
			echo ": <span>[{$category_name}]</span>\n";
		}
	?>
	</h4>
</div>

<script src="<?php echo URL::base()?>public/js/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo URL::base()?>public/js/highcharts/modules/exporting.js" type="text/javascript"></script>
<!-- <script src="http://code.highcharts.com/highcharts-3d.js"></script>-->

<div class="row-fluid">
		
	<!--  JS Insertion for HC -->
	<script type="text/javascript">
	jQuery(function() {
		jQuery("#gcon").highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'Динаміка витрат в році (по рокам)'
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				crosshair: true
			},
			yAxis: {
				min: 0.0,
				title: {
					text: 'Сума'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.2f} грн.</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [
				<?php
				for ($i = 0;$i < $years_count;$i++) {
					echo "{\n";
					echo "name: '".(intval($startDate) + $i)."',\n";
					echo "data: [\n";
					foreach ($sumOfMoney[$i] as $k => $v) {
						echo "{$v},";
					}
					echo "]},";
				}
				?>		
			]
		});
	});
	</script>
	
	<!-- Right Row -->
	<div class="span12">
		<div id="gcon">
			
		</div>
	</div>
	<!-- /Right Row -->
</div>
<!-- /Dynamic Year (Years) Order -->