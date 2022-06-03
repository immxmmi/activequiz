<?php
require_once("../../../config.php");
global $DB;

class single_choice
{

    private $labels = array();
    private $values = array();
    private $data = array();

    function setData($question_attemps)
    {
        //var_dump($question_attemps);
        $chart = new chart_builder();
        // $this->values = array_pad(array(), $question_attemps[0]->getQuestionsummary(), 0);


        for ($i = 0; $i < sizeof($question_attemps[0]->getQuestionsummary()); $i++) {
            $current_data = array($question_attemps[0]->getQuestionsummary()[$i]=>0);
            $this->data = array_merge($this->data, $current_data);
           // array_push($data[$question_attemps[0]->getQuestionsummary()[$i]],0);
        }
        $this->labels = array_keys($this->data);

        echo "<pre>";
        print_r($this->data);
        echo "</pre>";


                foreach ($question_attemps as $summary) {
                    $responsesummary = $summary->getResponsesummary();
                    $this->data = $this->addValue($this->data, $responsesummary);
                    //$this->values = $chart->count_value($this->labels, $this->values, $responsesummary);
                }
        echo "<pre>";
        print_r($this->data);
        echo "</pre>";

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




