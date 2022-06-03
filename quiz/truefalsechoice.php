<?php
require_once("../../../config.php");
global $DB;

class true_false_choice{

    private $labels;
    private $values = array(0, 0, 0, 0, 0);

    function setData($question_attemps){
        $chart = new chart_builder();
        foreach ($question_attemps as $summary) {
            $this->labels = $summary->getQuestionsummary();
            $responsesummary = $summary->getResponsesummary();
            $this->values = $chart->count_value($this->labels, $this->values, $responsesummary);
            break;
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