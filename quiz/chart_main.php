<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
require_once("single_choice.php");
global $DB;
global $chart_values;
global $chart_label;

// SESSION
$sessionID = 39;


// CHART BUILDER
$chart = new Chart();
// CHART HEAD
$chart->startTag();


# # # # # # # # -SESSION- # # # # # # # #
echo "SESSION DATA:</br>";
echo "TABLE :: mdl_activequiz_sessions</br>";
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
//var_dump($sessions);
##########################################


# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
echo "ACTIVE-QUIZ ATTEMPTS</br>";
echo "TABLE :: mdl_activequiz_attempts</br>";
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $sessions[0]->getId());
$result = $DB->get_records_sql($sql, $params);
$active_attemps = $active_attemp->getAttemptsByID($result);
//var_dump($active_attemps);
#######################################################

# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
echo "QUESTION ATTEMPTS</br>";
echo "TABLE :: mdl_question_attempts</br>";
$question_attemp = new question_attempts();
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid;';
$params = array('questionusageid' => $active_attemps[0]->getQuestionengid());
$result = $DB->get_records_sql($sql, $params);
$question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
//var_dump($question_attemps);
####################################################




$chartType = 0;
$questionType = "singel";

/*
$labels = $summary->getQuestionsummary();
//var_dump($labels);
$responsesummary = $summary->getResponsesummary();
*/

$single = new Single_Choice();

switch ($questionType){
    case "singel": $single->setData($question_attemps);break;
    default: echo "no Type";
}


/*
switch ($chartType){
    case 0: $chart->buildBarChart($chart_label,$chart_values);break;
    case 1: $chart->buildDoughnutChart();break;
    case 2: $chart->buildPieChart();break;
    default: $chart->buildBarChart();break;
}

*/