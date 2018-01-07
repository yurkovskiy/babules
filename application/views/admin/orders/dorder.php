<!-- Report by categories -->
<div class="page-header">
	<h1>Звіт за період: <?php echo $startDate ?> - <?php echo $endDate?></h1>
	<h3><?php echo "{$operationTypes[$operationType]}"?>
	<?php 
		if ($category_name != "") {
			echo ": <span>[{$category_name}]</span>\n";
		}
	?>
	</h3> 
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
                height: 600                
            },
            title: {
                text: 'Розподіл витрат за період [По датам]'
            },

            tooltip: {
            	
            },
            
            xAxis: {
                categories: [
                <?php 
                foreach ($sumOfMoney as $date => $sum) {
					echo "'{$date}'".",";
				}
                ?>
                ],
                gridLineWidth: 1,
                labels: {
    				step: 5,
    				staggerLines: 1
    			}                
            },
			
            series: [{
                name: 'babules',
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