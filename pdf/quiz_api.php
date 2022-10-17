<?php
require_once("../../../config.php");
require_once("../chart/class/mdl_activequiz_sessions.php");
require_once("../chart/class/mdl_activequiz_attempt.php");
require_once("../chart/class/mdl_question_attempts.php");
require_once("../chart/class/mdl_question_attempt_steps.php");
require_once("../chart/class/mdl_question_attempt_step_data.php");
require_once("../chart/class/quiz_builder.php");
require_once("../chart/class/single_choice.php");
require_once("../chart/class/truefalsechoice.php");
global $DB;

// Parameter

$question = optional_param('question', false, PARAM_TEXT); //
$quiz = new quiz_builder();


$data = null;
$quiz->setInfo("no Question Type Found!");
$quiz = $quiz->build_quiz_data("test");


http_response_code(200);
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;




