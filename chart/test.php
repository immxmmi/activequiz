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
//$charttype = optional_param('type', false, PARAM_TEXT); //
//$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
$sessionid = 2; //$sessionID = 46;
$charttype = "bar"; //

# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################

# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
$slot = 1;//$session->getCurrentquestion(); // SLOT
// $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT
$question_attemp = new question_attempts($allquestionengids, $slot);
#####################################################

$answers = $question_attemp->getListOfAnswers();

$ListOfAllquestion = [];


foreach ( $allquestionengids as $questionID){
    array_push( $ListOfAllquestion, $questionID);
}

print_r($ListOfAllquestion);



echo"<pre>";
var_dump($answers[0][0]);
echo"<pre>";

