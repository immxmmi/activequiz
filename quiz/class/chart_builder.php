<?php
require_once("../../../config.php");
require_once("./mdl_question_attempts.php");

class chart_builder
{
    private $response_code = 200;
    private $status = 'success';
    private $msg = 'Chartdata successfully fetched';
    private $data = array();
    private $options = array();
    private $chartType;
    private $info = '-';


    public function __construct()
    {
    }
    public function startTag()
    {
        echo '<head>
            <meta charset="utf-9">
            <title>CHART</title>
            	<style type="text/css">
			.chartwrapper {
				width: 640px;
			}
		</style>
            <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>-->
            <style type="text / css">.chartwrapper {width: 500px;}</style>
            <script src="../js/chartjs/Chart.min.js"></script>
            <script src="../../../lib/jquery/jquery-3.5.1.min.js"></script>
        </head>';
    }

    public function countValue($labels, $values, $responsesummary)
    {
        $delete = new question_attempts;
        if ($responsesummary == null) {
            return $values;
        }
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

    public function buildNewChart($chartType, $labels, $values)
    {
        $this->chartType = $chartType;
        //$color =  dec2hex(rand(0,255)).dec2hex(rand(0,255)).dec2hex( rand(0,255));


        switch ($chartType) {
            case "bar":
                $this->data = array(
                    'labels' => $labels,
                    'datasets' => array(
                        array(
                            'label' => '# of Votes',
                            'data' => $values,
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
                $this->options = array(
                    'scales' => array(
                        'y' => array(
                            'beginAtZero' => true
                        )
                    )
                );
                break;
            case 'pie':
                $this->data = array(
                    'labels' => $labels,
                    'datasets' => array(
                        array(
                            'label' => 'Point',
                            'backgroundColor' => array(
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ),
                            'data' => $values,
                        )
                    )
                );
                $this->options = array(
                    'animation' => array(
                        'animateScale' => true
                    )
                );
                break;
            case 'doughnut':
                $this->data = array(
                    'labels' => $labels,
                    'datasets' => array(
                        array(
                            'label' => 'Point',
                            'backgroundColor' => array(
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ),
                            'data' => $values,
                        )
                    )
                );
                $this->options = array(
                    'animation' => array(
                        'animateScale' => true
                    )
                );
                break;
            default:
                $this->response_code = 404;
                $this->status = 'error';
                $this->msg = "TEST ERROR";
                break;
        }
        return $this->createJSON();

    }

    private function createJSON()
    {
        http_response_code($this->response_code);
        //header('Content-Type: application/json');
        $response = array(
            'meta' => array(
                'status' => $this->status,
                'msg' => $this->msg,
                'info' => $this->info
            ),
            'data' => array(
                'charttype' => $this->chartType,
                'chartdata' => $this->data,
                'chartoptions' => $this->options
            )
        );
        return $response;
    }

    /**
     * @param int $response_code
     */
    public function setResponseCode($response_code)
    {
        $this->response_code = $response_code;
    }


    /**
     * @param string $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->response_code;
    }


    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

}