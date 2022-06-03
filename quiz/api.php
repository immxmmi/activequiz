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
    $list_of_question_attemps = array(); // LIST ATTEMPS
    $slot = $session->getCurrentquestion(); // SLOT
    $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT


    foreach ($allquestionengids as $questionengids) {
        $question_attemp = new question_attempts();
        $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid AND slot= :slot';
        $params = array('questionusageid' => $questionengids, 'slot' => $slot);
        $result = $DB->get_records_sql($sql, $params);
        $question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
        //var_dump($question_attemps);
        ####################################################
        array_push($list_of_question_attemps, $question_attemps);
    }


    $questionType = "singel";
    $single = new single_choice();
    $trueFalse = new true_false_choice();
    $data = null;
    switch ($questionType) {
        case "singels":
            $single->load_quiz_data($list_of_question_attemps[0]);
            $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues());
            break;
        case "true/false":
            $trueFalse->setData($list_of_question_attemps[0]);
            $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues());
        default:
            $data = $chart->build_new_chart(null, null,null);
            $chart->setInfo("no Question Type Found!");
    }





    http_response_code($chart->getResponseCode());
    //header('Content-Type: application/json');

    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;




