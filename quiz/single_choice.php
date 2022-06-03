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
       for($i = 0; $i < sizeof($question_attemps[0]->getQuestionsummary());$i++){
           array_push($data,array($question_attemps[0]->getQuestionsummary()[$i]=>0));
       }

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        $data = $this->countValue($data,$question_attemps[0]->getResponsesummary());

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




    private function countValue($data,$responsesummary){

            if ($responsesummary == null) {return $data;}

            $index = 0;
            foreach ($data as $label) {


                echo "<pre>";
                print_r( $label[' '.$responsesummary]);
                echo "</pre>";

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




