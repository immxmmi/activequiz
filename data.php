<?php

require_once("../../config.php");
global $DB;
$course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);;
// SELECT * FROM "public"."mdl_activequiz_attempts";
echo "<script>console.log('test')</script>";

$label1 = "Red";
$label2 = "Blue";
$label3 = "Yellow";
$label4 = "Green";
$label5 = "Purple";
$label6 = "Orange";

echo "
<!DOCTYPE html>
<hthml>
    <head>
        <meta charset='utf-9'>
        <title></title>
        <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>-->
        <script src='js/chartjs/Chart.min.js'></script>
    </head>
    <body>
        <div class='container'>
            <canvas id='barChart'></canvas>
        </div>
        <script>
      const massPopChart = new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: ['$label1', '$label2', '$label3', '$label4', '$label5', '$label6'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });
        </script>
    </body>
</html> ";