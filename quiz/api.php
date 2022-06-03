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
    $charttype = optional_param('type', false, PARAM_TEXT); //
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
    $slot = $session->getCurrentquestion(); // SLOT
    $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT
    $question_attemp = new question_attempts($allquestionengids,$slot);
    #####################################################

    $answers = $question_attemp->getListOfAnswers();

echo "<pre>";
print_r($answers);
echo "</pre>";

$question = $answers[0][0]->getId();

echo "<pre>";
print_r($question);
echo "</pre>";


    $questionType = "singel";
    $single = new single_choice();
    $trueFalse = new true_false_choice();
    $data = null;
    switch ($questionType) {
        case "singel":
            $single->load_quiz_data($answers);
            $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues());
            break;
        case "true/false":
            $trueFalse->setData($answers[0]);
            $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues());
        default:
            $chart->setInfo("no Question Type Found!");
            $data = $chart->build_new_chart(null, null,null);
    }





    http_response_code($chart->getResponseCode());
    //header('Content-Type: application/json');

    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;




