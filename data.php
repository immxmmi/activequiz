<?php

require_once("../../config.php");
global $DB;
$course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);;
// SELECT * FROM "public"."mdl_activequiz_attempts";
echo "<script>console.log('test')</script>";





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
            <canvas id='doughnutChart'></canvas>
        </div>
        <script>
            var doughnutChart = document.getElementById('doughnutChart');
            const skillChart = new Chart(doughnutChart, {
    type: 'doughnut',
                    data: {
        labels: ['Strength', 'Skill', 'Health', 'Speed', 'Luck'],

                        datasets: [{
            label: 'Point',
                            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
                            data: [10, 20, 35, 30, 10],              
                        }]
                    },
                    options: {
        animation: {
            animateScale: true
                        }
    }
            });
        </script>
    </body>
</html> ";