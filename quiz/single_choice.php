<?php
require_once("../../../config.php");
global $DB;

class Single_Choice{

    private $labels;
    private $values = array(0, 0, 0, 0, 0);

    function setData($question_attemps){
        var_dump($question_attemps);
        $chart = new Chart();
        foreach ($question_attemps as $summary) {
            $this->labels = $summary->getQuestionsummary();
            $responsesummary = $summary->getResponsesummary();
            $this->values = $chart->countValue($this->labels, $this->values, $responsesummary);
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




