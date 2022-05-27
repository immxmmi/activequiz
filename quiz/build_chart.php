<?php
require_once("../../../config.php");

class Chart{
    private $label1;
    private $label2;
    private $label3; 
    private $label4;

    private $value1;
    private $value2;
    private $value3; 
    private $value4;
}


public load_chart(){

}


public output(){
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
                        labels: ['$label1', '$label2', '$label3', '$label4'],
                        datasets: [{
                            label: '# of Votes',
                            data: [$value1, $value2, $value3, $value4],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
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
}

