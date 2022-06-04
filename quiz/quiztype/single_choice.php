<?php
require_once("../../../config.php");
require_once("class/mdl_question_attempt_step_data.php");
global $DB;

class single_choice
{

    private $labels = array();
    private $values = array();
    private $data = array();

    public function load_quiz_data($answers,$steps_data)
    {
        $question_one = $answers[0][0];

       for ($i = 0; $i < sizeof($question_one->getQuestionsummary()); $i++) {
           $current_data = array($question_one->getQuestionsummary()[$i]=>0);
           $this->data = array_merge($this->data, $current_data);
       }

/*
                foreach ($steps_data as $summary) {
                    $responsesummary = $summary[0]->getResponsesummary();
                    $this->data = $this->addValue($this->data, $responsesummary);
                }
*/



        foreach ($steps_data as $summary) {
 echo "<pre>";
        print_r($summary);
        echo "</pre>";
            $responsesummary = $summary->getAnswer();
/*
            $this->data = $this->addValue($this->data, $responsesummary);
*/
        }

        $this->labels = array_keys($this->data);
        $this->values = array_values($this->data);


        echo "<pre>";
        print_r($this->data);
        echo "</pre>";


        return $this->data;
    }

    private function addValue($data, $responsesummary)
    {
        if ($responsesummary == null) {
            return $data;
        }
        $data[' '.$responsesummary]++;
        return $data;
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




