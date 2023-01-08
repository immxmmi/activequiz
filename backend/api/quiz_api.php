<?php
require_once("../../../../config.php");
require_once("../class/mdl_question_data.php");
require_once("../class/mdl_activequiz_attempt.php");
require_once("../class/mdl_activequiz_sessions.php");
require_once("../class/mdl_question_attempts.php");
require_once("../builder/quiz_builder.php");
global $DB;

// PARAMETER
$sessionid = optional_param('sessionid', false, PARAM_TEXT);

// ARRAY OF ALL QUIZDATA
$quizdata = array();
// ARRAY OF QUESTIONS
$qu = array();
// ARRAY OF ANSWERS
$aw = array();
// ARRAY OF ANSWERS
$right = array();
//QUIZ BUILDER
$quiz_build = new quiz_builder();

# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################
$quablayout = $activequiz_attempt->getActiveAttemps()[0]->getQubalayout();
echo '<pre>';
print_r(sizeof(explode(",", $quablayout)));
echo '</pre>';


/*

# # # # # # # # # #  -QUESTION DATA- # # # # # # # # # #
if ($allquestionengids != null) {
    foreach ($allquestionengids as $id) {
        array_push($quizdata, new question_data($id));
    }
}
#######################################################

// split quizdata in question array and answer array
foreach ($quizdata as $qd) {
    array_push($qu, $qd->getQuestion());
    array_push($aw, $qd->getAnswers());
    array_push($right, $qd->getRightanswer());
}

// build JSON-DATA with Builder
$data = $quiz_build->build_quiz_data($qu, $aw, $right);


http_response_code($quiz_build->getResponseCode());
header('Content-Type: application/json');
/*
echo json_encode($data, JSON_PRETTY_PRINT);
exit;

*/




