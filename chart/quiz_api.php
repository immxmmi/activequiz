<?php
require_once("../../../config.php");
require_once("class/mdl_activequiz_sessions.php");
require_once("class/mdl_activequiz_attempt.php");
require_once("class/mdl_question_attempts.php");
require_once("class/mdl_question_attempt_steps.php");
require_once("class/mdl_question_attempt_step_data.php");
require_once("class/chart_builder.php");
require_once("class/single_choice.php");
require_once("class/truefalsechoice.php");
global $DB;

// Parameter
$charttype = optional_param('type', false, PARAM_TEXT); //
//$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
//$chart = new chart_builder();

console.log("Hello ");
echo json_decode($charttype, JSON_PRETTY_PRINT);

//echo json_encode($data, JSON_PRETTY_PRINT);
exit;




