<?php
require_once("../../../config.php");
require_once("class/mdl_activequiz_sessions.php");
require_once("class/mdl_activequiz_attempt.php");
require_once("class/mdl_question_attempts.php");
require_once("class/mdl_question.php");
require_once("class/mdl_question_attempt_steps.php");
require_once("class/mdl_question_attempt_step_data.php");
require_once("class/chart_builder.php");
require_once("class/single_choice.php");
require_once("class/truefalsechoice.php");
global $DB;

// Parameter
$questuinid = optional_param('questionID', PARAM_TEXT);
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;

//QUIZ BUILDER
//$quiz = new quiz_builder();
# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################


$question= new mdl_question($questuinid);


echo "<pre>";
var_dump($allquestionengids);
echo "</pre>";
var_dump($question->getId());
var_dump($question->getName());
var_dump($question->getQuestiontext());
echo "</pre>";







