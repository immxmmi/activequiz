<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
global $DB;

class Single_Choice{

    private $labels;
    private $values = array(0, 0, 0, 0, 0);

    function setData($question_attemps){
        $chart = new Chart();
        foreach ($question_attemps as $summary) {
            $this->labels = $summary->getQuestionsummary();
            $responsesummary = $summary->getResponsesummary();
            $this->values = $chart->countValue($this->labels, $this->values, $responsesummary);
            break;
        }
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @return int[]
     */
    public function getValues()
    {
        return $this->values;
    }



}




