<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
global $DB;

class Single_Choice{



$values = array(0, 0, 0, 0, 0);
echo $index = 0;
foreach ($question_attemps as $summary) {
    echo "</br>";
    echo "CHART:" . $index;
    echo "</br>";
    $labels = $summary->getQuestionsummary();
    var_dump($labels);
    $responsesummary = $summary->getResponsesummary();

    echo "</br>";
    var_dump($responsesummary);
    $chart->setCurrentID("test" . strval($index));
    echo "</br>";
    echo "DATA::::";
    $values = $chart->countValue($labels, $values, $responsesummary);
    $chart->buildBarChart($labels, $values);
    $index++;
}

}




