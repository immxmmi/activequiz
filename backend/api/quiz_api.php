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
$slot = optional_param('slot', false, PARAM_TEXT);

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
$max_slots = sizeof(explode(",", $activequiz_attempt->getActiveAttemps()[0]->getQubalayout()));

if($slot > 0 ){

    # # # # # # # # # #  -QUESTION DATA- # # # # # # # # # #
    $curretnQuiz = new question_data($allquestionengids[0], $slot);
    #######################################################
}


// build JSON-DATA with Builder
$data = $quiz_build->build_quiz_data($curretnQuiz->getQuestion(), $curretnQuiz->getAnswers(), $curretnQuiz->getRightanswer(), $max_slots, $slot);

http_response_code($quiz_build->getResponseCode());
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;







