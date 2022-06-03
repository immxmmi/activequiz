<?php
require_once("../../../config.php");
global $DB;

class single_choice{

    private $labels = array();
    private $values = array();

    function setData($question_attemps){
        //var_dump($question_attemps);
        $chart = new chart_builder();
       // $this->values = array_pad(array(), $question_attemps[0]->getQuestionsummary(), 0);
        print_r($question_attemps);
        foreach ($question_attemps as $summary) {
            $this->labels = $summary->getQuestionsummary();
            $responsesummary = $summary->getResponsesummary();
            $this->values = $chart->count_value($this->labels, $this->values, $responsesummary);
        }
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




