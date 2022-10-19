<?php
require_once("../../../config.php");
?>
<!doctype html>
<hthml>
    <head>
        <meta charset="utf-8">
        <title>DataAPI Test</title>
		<style type="text/css">
			.chartwrapper {
				width: 640px;
			}
		</style>
		<script src="<?php echo $CFG->wwwroot; ?>/lib/jquery/jquery-3.5.1.min.js"></script>
        <script src="<?php echo $CFG->wwwroot; ?>/mod/activequiz/js/chartjs/Chart.min.js"></script>
		<script>
			var apiChart = null;
			var skillChart = null;
			
			jQuery(document).ready(function () {
				apiChart = jQuery('#apiChart');
				jQuery('#charttype').bind('change', changeChartTypeHandler);
			});
			
			var changeChartTypeHandler = function() {
				var charttype = jQuery('#charttype').val();
				if( charttype !== 'none' ) {
					var url = './dataapi.php';
					var params = {
						type: charttype
					};
					jQuery.get(url, params, redrawChart).fail(function(data) {
						destroyChart();
						alert(data.responseJSON.meta.msg);
					});
				}
			};
			
			var destroyChart = function() {
				if( skillChart !== null ) {
					skillChart.destroy();
				}	
			};
			
			var redrawChart = function(data) {
				if( data.meta.status === 'error' ) {
					alert(data.meta.msg);
					return;
				}
				
				destroyChart();
				skillChart = new Chart(apiChart, {
					type: data.data.charttype,
					data: data.data.chartdata,
					options: data.data.chartoptions
				});
			};
        </script>
    </head>
    <body>
		<div>
			<form action="javascript:void(0);">
				<select id="charttype" name="type">
					<option value="none">--- choose a chart ---</option>
					<option value="pie">Pie-Chart</option>
					<option value="bar">Bar-Chart</option>
					<option value="doughnut">Doughnut-Chart</option>
					<option value="unknown">Unknown-Chart</option>
				</select>
			</form>
		</div>
        <div class="container">
			<div class="chartwrapper">
				<canvas id="apiChart"></canvas>
			</div>
        </div>
    </body>
</hthml>