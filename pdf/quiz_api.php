<?php
require_once("../../../config.php");
require_once("../chart/class/mdl_activequiz_sessions.php");
require_once("../chart/class/mdl_activequiz_attempt.php");
require_once("./class/mdl_question.php");
require_once("../chart/class/mdl_question_data.php");
require_once("./quiz_builder.php");
global $DB;


$quiz_build = new quiz_builder();
// Parameter
//$questuinid = optional_param('questionid', PARAM_TEXT);
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;

//QUIZ BUILDER
//$quiz = new quiz_builder();
# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################


if ($allquestionengids != null) {

    $quizdata = array();

    foreach ($allquestionengids as $id) {
        array_push($quizdata, new question_data($id));
    }
}

$qu = array();
$aw = array();


foreach ($quizdata as $qd) {
    $qu[] = $qd->getQuestion();
    $aw[] = $qd->getAnswers();
}

$data = $quiz_build->build_quiz_data($qu, $aw);

http_response_code($quiz_build->getResponseCode());
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;







