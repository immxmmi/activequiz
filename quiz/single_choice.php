<?php
require_once("../../../config.php");
global $DB;

class single_choice
{

    private $labels = array();
    private $values = array();
    private $data = array();

    public function load_quiz_data($answers)
    {


        echo "<pre>";
        print_r($answers[0][questionsummary]);
        //print_r($answers[0]->getQuestionsummary());
        echo "</pre>";


      // for ($i = 0; $i < sizeof($answers[0]->getQuestionsummary()); $i++) {
      //     $current_data = array($answers[0]->getQuestionsummary()[$i]=>0);
      //     $this->data = array_merge($this->data, $current_data);
      // }


        echo "<pre>";
        print_r($this->data);
        echo "</pre>";

        /*
                foreach ($answers as $summary) {
                    $responsesummary = $summary->getResponsesummary();
                    $this->data = $this->addValue($this->data, $responsesummary);
                }


        echo "<pre>";
        print_r($this->data);
        echo "</pre>";


        $this->labels = array_keys($this->data);
        $this->values = array_values($this->data);
*/
        return $this->data;
    }

    private function addValue($data, $responsesummary)
    {
        if ($responsesummary == null) {
            return $data;
        }
        print_r($responsesummary);
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




