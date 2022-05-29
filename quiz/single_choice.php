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
$sessionID = 39;

// TABLE :: mdl_activequiz_sessions
echo "</br>";
echo "TABLE :: mdl_activequiz_sessions";
echo "</br>";
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
//var_dump($sessions);
echo "</br>";
echo "</br>";
var_dump($sessions);
//echo "</br>";
//echo "ActiveQuiz ID:".$sessions[0].getActivequizid();
//echo "</br>";
//echo "Current Question ID:".$sessions[0].getCurrentquestion();

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
var_dump($active_attemps);


// TABLE :: mdl_question_attempts
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_question_attempts";
echo "</br>";
$question_attemp = new question_attempts();
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid;';
$params = array('questionusageid' => $active_attemps[0]->getQuestionengid());
$result = $DB->get_records_sql($sql, $params);
$question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
var_dump($question_attemps);


    $values = array(0,0,0,0,0);
    echo $index = 0;
foreach($question_attemps as $summary){
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "CHART:".$index;
    echo "</br>";
    $labels = $summary->getQuestionsummary();
    var_dump($labels);
    $responsesummary = $summary->getResponsesummary();
    var_dump($responsesummary);
    $chart->setCurrentID("test".strval($index));
    echo "</br>";
    echo "DATA::::";
    $values = $chart->countValue($labels,$values,$responsesummary);
    $chart->output($labels,$values);
    $index++;
}




