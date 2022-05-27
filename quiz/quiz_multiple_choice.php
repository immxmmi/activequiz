<?php
require_once("../../../config.php");
require_once ("session.php");
require_once ("mdl_activequiz_attempts.php");
require_once ("mdl_question_attempts.php");
require_once ("build_chart.php");
global $DB;

$chart = new Chart();

$chart->startTag();

// SESSION
$sessionID = 35;

// TABLE :: mdl_activequiz_sessions
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_activequiz_sessions";
echo "</br>";
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
var_dump($sessions);

// ACTIVE-QUIZ ATTEMPTS
// TABLE :: mdl_activequiz_attempts
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_activequiz_attempts";
echo "</br>";
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $sessions[0]->getId());
$result = $DB->get_records_sql($sql, $params);
$active_attemps = $active_attemp->getAttemptsByID($result);
var_dump($active_attemps[0]);


// TABLE :: mdl_question_attempts
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_question_attempts";
echo "</br>";
$question_attemp = new question_attempts();
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid;';
$params = array('questionusageid' => $active_attemps[0]->getQuestionengid());
$result = $DB->get_records_sql($sql, $params);
//var_dump($result);
$question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
var_dump($question_attemps);


    $id = 10;
foreach($question_attemps as $summary){
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "CHART:";
    echo "</br>";
    $labels = $summary->getQuestionsummary();
    $chart->setCurrentID("test");
    $chart->output($labels[0],$labels[1],$labels[2],$labels[0],2,3,4,5);
}

    //$chart->endTag();




