<!-- Report by categories -->
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
	jQuery(function () {
        jQuery('#gcon').highcharts({
            chart: {
                height: 600,
                type: 'areaspline'
            },
            title: {
                text: 'Розподіл витрат за період [По датам]'
            },

            subtitle: {
                text: 'Кількість днів (транзакцій*): <?php echo $daysNumber?>'
            },

            xAxis: {
                categories: [
                <?php
                $avg = 0; 
                foreach ($sumOfMoney as $date => $sum) {
					echo "'{$date}'".",";
					$avg += $sum;
				}
				$avg = round(($avg / count($sumOfMoney)), 2);
                ?>
                ],
                gridLineWidth: 1,
                labels: {
    				step: 5,
    				staggerLines: 1
    			},
    			title: {
        			text: 'Дата'
    			}                
            },

            yAxis: {
                title: {
                    text: 'Сума'
                },
                plotLines:[{
                    value: <?php echo $avg?>,
                    color: 'green',
                    dashStyle: 'shortdash',
                    width: 2,
                    zIndex: 1000,
                    label: {
                        text: '<b>AVG: <?php echo $avg?></b>',
                    },
                }],
            },

            tooltip: {
            	pointFormat: 'Сума: <b>{point.y}</b>'
            },

            
			
            series: [{
                name: 'babules',
                marker: {
                    symbol: 'circle',
                    lineColor: '#aabbcc',
                    fillColor: '#000000'
                },
                lineWidth: 3,
                lineColor: '#ff4000',
                fillColor: '#00bfff',
                data: [<?php
                foreach ($sumOfMoney as $date => $sum) 
				{
					echo "{$sum},";                	
                }
 
                ?>]
            }]
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
<!-- /Report by dates -->