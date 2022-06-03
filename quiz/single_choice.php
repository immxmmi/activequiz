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


        $data = array(array());
        for ($i = 0; $i < sizeof($question_attemps[0]->getQuestionsummary()); $i++) {
            array_push($data[0], $question_attemps[0]->getQuestionsummary()[$i]);
           // array_push($data[$question_attemps[0]->getQuestionsummary()[$i]],0);
        }

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        //$data = $this->countValue($data, $question_attemps[0]->getResponsesummary());

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        /*
                foreach ($question_attemps as $summary) {
                    $this->labels = $summary->getQuestionsummary();
                    $responsesummary = $summary->getResponsesummary();
                    $this->values = $chart->count_value($this->labels, $this->values, $responsesummary);
                }
        */
    }


    private function countValue($data, $responsesummary)
    {

        if ($responsesummary == null) {
            return $data;
        }

        $index = 0;


        echo "<pre>";
        $keys = array_keys($data);
        print_r($keys);
        //print_r( array_key_exists($responsesummary));
        echo "</pre>";


        foreach ($data as $label) {
            $index++;
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




