<?php
require_once("../../../config.php");
require_once("mdl_question_attempts.php");

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

    // COUNT VALUE AND RETURN VALUE ARRAY
    public function count_value($labels, $values, $responsesummary)
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

    //CREATE NEW CHART RETURN JSON
    public function build_new_chart($chartType, $labels, $values)
    {
        $this->chartType = $chartType;

        switch ($chartType) {
            case "bar":
                $color = $this->random_background_color_array(sizeof($labels));
                $this->data = array(
                    'labels' => $labels,
                    'datasets' => array(
                        array(
                            'label' => '# of Votes',
                            'data' => $values,
                            'backgroundColor' => $color,
                            'borderColor' => $color,
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
                            'backgroundColor' => $this->random_background_color_array(sizeof($labels)),
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
                            'backgroundColor' => $this->random_background_color_array(sizeof($labels)),
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
        return $this->convert_chart_to_json();

    }

    // CREATE JSON CODE
    private function convert_chart_to_json()
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

    // CHART COLOR GENERATOR
    private function random_color_generator()
    {
        sleep(1);
        return 'rgba(' . rand(0, 150) . ' , ' . rand(0, 255) . ' , ' . rand(0, 255) . ' , ' . rand(2, 10) / 10 . ')';
    }

    private function random_background_color_array($size)
    {
        $background_array = array();

        for ($i = 1; $i <= $size; $i++) {
            array_push($background_array, $this->random_color_generator());
            $background_array = array_unique($background_array);
            if(sizeof($background_array) === $size){
                break;
            }
        }
        return $background_array;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->response_code;
    }

    /**
     * @param string $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }



}