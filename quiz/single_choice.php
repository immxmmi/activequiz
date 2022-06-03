<?php
require_once("../../../config.php");
global $DB;

class single_choice
{

    private $labels = array();
    private $values = array();

    function setData($question_attemps)
    {
        //var_dump($question_attemps);
        $chart = new chart_builder();
        // $this->values = array_pad(array(), $question_attemps[0]->getQuestionsummary(), 0);


        $data = array();
        for ($i = 0; $i < sizeof($question_attemps[0]->getQuestionsummary()); $i++) {
            $current_data = array($question_attemps[0]->getQuestionsummary()[$i]=>0);
            $data = array_merge($data, $current_data);
           // array_push($data[$question_attemps[0]->getQuestionsummary()[$i]],0);
        }


        $data = $this->addValue($data, $question_attemps[0]->getResponsesummary());
        $this->labels = array_keys($data);
        echo "<pre>";
        print_r($this->labels);
        echo "</pre>";
                foreach ($question_attemps as $summary) {
                    $responsesummary = $summary->getResponsesummary();
                    $this->addValue($data, $responsesummary);
                    //$this->values = $chart->count_value($this->labels, $this->values, $responsesummary);
                }
    }


    private function addValue($data, $responsesummary)
    {
        if ($responsesummary == null) {
            return $data;
        }
        $data[' '.$responsesummary]++;
    }


    public function getLabels()
    {
        return $this->labels;
    }

    public function getValues()
    {
        return $this->values;
    }

}




