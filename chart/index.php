<?php
require_once("../../../config.php");
?>
<!doctype html>
<hthml>
    <head>
        <meta charset="utf-8">
        <title>Chart</title>
		<style type="text/css">
			.chartwrapper {
				width: 640px;
			}
		</style>
		<script src="<?php echo $CFG->wwwroot; ?>/lib/jquery/jquery-3.5.1.min.js"></script>
        <script src="<?php echo $CFG->wwwroot; ?>/mod/activequiz/js/chartjs/Chart.min.js"></script>





        <script src="../js/chart__api.js"></script>

    </head>




    <body>
		<div>
			<form action="javascript:void(0);">
                <label for="session">Session ID:</label>
                <input type="number" id="sessionid" name="session" value="5">




                <label for="slot">Question Slot:</label>
                <input type="number" id="slot" name="slot" value="1">


                <label for="type">Chart Type:</label>


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