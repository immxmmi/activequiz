<?php
require_once("../../../config.php");
require_once("class/mdl_activequiz_sessions.php");
require_once("class/mdl_activequiz_attempt.php");
require_once("class/mdl_question_attempts.php");
require_once("class/mdl_question_attempt_steps.php");
require_once("class/mdl_question_attempt_step_data.php");
require_once("class/quiz_builder.php");
require_once("class/single_choice.php");
require_once("class/truefalsechoice.php");
global $DB;

// Parameter
$charttype = optional_param('type', false, PARAM_TEXT); //
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
$quiz = new quiz_builder();

# # # # # # # # -SESSION- # # # # # # # #
$session = new activequiz_session($sessionid);
##########################################

# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################

# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
$slot = $session->getCurrentquestion(); // SLOT
// $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT
$question_attemp = new question_attempts($allquestionengids, $slot);
#####################################################

$answers = $question_attemp->getListOfAnswers();

$steps = new attempt_steps($answers);
$steps = $steps->getAttemptstepids();

$steps_data = new attempt_step_data($steps);
$steps_data = $steps_data->getStepDataList();




$questionType = "singel";
$single = new single_choice();
$trueFalse = new true_false_choice();
$data = null;

$data = $quiz->build_quiz_data("test");











http_response_code($quiz->getResponseCode());
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;




