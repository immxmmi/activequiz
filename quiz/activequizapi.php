<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
require_once("single_choice.php");
require_once("trueFalse_choice.php");
global $DB;

// Parameter
$type  = optional_param('type', false, PARAM_TEXT); //
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
$chart = new Chart();



# # # # # # # # -SESSION- # # # # # # # #
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionid);
$result = $DB->get_records_sql($sql, $params);
$current_session = $session->getSessionByID($result);
##########################################


# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $current_session->getId());
$result = $DB->get_records_sql($sql, $params);
$active_attemps = $active_attemp->getAttemptsByID($result);
$chart->setInfo("test");
$current_attemp = $active_attemps[0];
$all_questionengids = $active_attemp->filterQID($active_attemps);
#######################################################


# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
$list_of_question_attemps = array(); // LIST ATTEMPS
$current_slot = $current_session->getCurrentquestion(); // SLOT
$current_slot = 2; // SLOT
foreach ($all_questionengids as $questionengids) {
    $question_attemp = new question_attempts();
    $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid AND slot= :slot';
    $params = array('questionusageid' => $questionengids, 'slot' => $current_slot);
    $result = $DB->get_records_sql($sql, $params);
    $question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
    //var_dump($question_attemps);
    ####################################################
    array_push($list_of_question_attemps, $question_attemps);
}

$chartType = "";
$questionType = "singel";


$single = new Single_Choice();
$trueFalse = new TrueFalse_Choice();

switch ($questionType) {
    case "singel":
        $single->setData($list_of_question_attemps[0]);
        break;
    case "true/false":
        $trueFalse->setData($list_of_question_attemps[0]);
    default:
        echo "no Type";
}








switch ($type) {
    case "bar":
        $chartType = "bar";
        break;
    case "doughnut":
        $chartType = "doughnut";
        break;
    case "pie":
        $chartType = "pie";
        break;
    default:
        $chartType = "";
        break;
}


$data = $chart->buildNewChart($chartType, $single->getLabels(), $single->getValues());
http_response_code($chart->getResponseCode());
header('Content-Type: application/json');


echo json_encode($data, JSON_PRETTY_PRINT);
exit;




