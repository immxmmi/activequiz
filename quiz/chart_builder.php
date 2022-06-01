<?php
require_once("../../../config.php");
require_once("mdl_question_attempts.php");

class Chart
{
    private $label1;
    private $label2;
    private $label3;
    private $label4;

    private $value1;
    private $value2;
    private $value3;
    private $value4;

    private $currentID;


    public function __construct()
    {

    }

    /**
     * @param mixed $currentID
     */
    public function setCurrentID($currentID)
    {
        $this->currentID = $currentID;
    }


    public function startTag()
    {
        echo "
        <head>
            <meta charset='utf-9'>
            <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>-->
            <script src='../js/chartjs/Chart.min.js'></script>
        </head>
        <body>
        ";
    }

    public function countValue($labels, $values, $responsesummary)
    {
        $delete = new question_attempts;
        if ($responsesummary == null) {
            return $values;
        }
        var_dump($responsesummary);
        var_dump($labels);
        $labels[0] = $delete->deleteCharAT($labels[0], 0);
        $labels[1] = $delete->deleteCharAT($labels[1], 0);
        $labels[2] = $delete->deleteCharAT($labels[2], 0);


        $index = 0;
        foreach ($labels as $label) {
            // compare answers
            if ($label !== $responsesummary) {
                $values[$index]++;
            }

            $index++;
        }
        return $values;
    }


    public function buildPieChart(){

    }
    public function buildDoughnutChart(){

    }
    public function buildBarChart($label, $values)
    {
        $this->label1 = $label[0];
        $this->label2 = $label[1];
        $this->label3 = $label[2];
        $this->label4 = $label[0];


        $this->value1 = $values[0];
        $this->value2 = $values[1];
        $this->value3 = $values[2];
        $this->value4 = $values[3];





        echo "
            <div class='container'>
                <canvas id=$this->currentID></canvas>
            </div>
        
   
            <script>
            const massPopChart = new Chart($this->currentID, {
                        type: 'bar',
                        data: {
                            labels: ['$this->label1', '$this->label2', '$this->label3', '$this->label4'],
                            datasets: [{
                                label: '# of Votes',
                                data: [$this->value1, $this->value2, $this->value3, $this->value4],
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
            </script>";

    }



    public function buildNewBar($labels,$values){
        return $data = array(
            'labels' => array('Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'),
            'datasets' => array(
                array(
                    'label' => '# of Votes',
                    'data' => array(12, 19, 3, 5, 2, 3),
                    'backgroundColor' => array(
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ),
                    'borderColor' => array(
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ),
                    'borderWidth' => 1
                )
            )
        );
        $options = array(
            'scales' => array(
                'y' => array(
                    'beginAtZero' => true
                )
            )
        );
    }
}