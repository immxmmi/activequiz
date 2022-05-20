<?php
require_once("../../config.php");

echo  "Hello";
global $DB;
$course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);;
var_dump($course);
// SELECT * FROM "public"."mdl_activequiz_attempts";
echo "<script>console.log('test')</script>";

echo " <head> <script src='js/chartjs/Chart.min.js'></script></head>";

echo "
<html>
 <body>
        <div class='container'>
            <canvas id='doughnutChart'></canvas>
        </div>
<script>
            var barChart = document.getElementById('barChart').getContext('2d');

            const massPopChart = new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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
        </html>
        ";