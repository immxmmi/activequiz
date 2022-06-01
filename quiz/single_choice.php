<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
global $DB;

class Single_Choice{

    function setData($question_attemps)
    {
        $chart = new Chart();
        $values = array(0, 0, 0, 0, 0);
        foreach ($question_attemps as $summary) {
            $labels = $summary->getQuestionsummary();
            $responsesummary = $summary->getResponsesummary();
            $values = $chart->countValue($labels, $values, $responsesummary);
            $chart->buildBarChart($labels, $values);
        }
    }

}




