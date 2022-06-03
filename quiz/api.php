<?php
require_once("../../../config.php");
require_once("class/mdl_activequiz_sessions.php");
require_once("class/mdl_activequiz_attempt.php");
require_once("class/mdl_question_attempts.php");
require_once("class/chart_builder.php");
require_once("single_choice.php");
require_once("truefalsechoice.php");
global $DB;

// Parameter
$charttype  = optional_param('type', false, PARAM_TEXT); //
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
$chart = new chart_builder();

# # # # # # # # -SESSION- # # # # # # # #
$session = new activequiz_session($sessionid);
##########################################

# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################


# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
$list_of_question_attemps = array(); // LIST ATTEMPS
$current_slot = $session->getCurrentquestion(); // SLOT
$current_slot = 2; // SLOT
foreach ($allquestionengids as $questionengids) {
    $question_attemp = new question_attempts();
    $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid AND slot= :slot';
    $params = array('questionusageid' => $questionengids, 'slot' => $current_slot);
    $result = $DB->get_records_sql($sql, $params);
    $question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
    //var_dump($question_attemps);
    ####################################################
    array_push($list_of_question_attemps, $question_attemps);
}













$questionType = "singel";
$single = new single_choice();
$trueFalse = new true_false_choice();
switch ($questionType) {
    case "singel":
        $single->setData($list_of_question_attemps[0]);
        break;
    case "true/false":
        $trueFalse->setData($list_of_question_attemps[0]);
    default:
        echo "no Type";
}




$data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues());

http_response_code($chart->getResponseCode());
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;




