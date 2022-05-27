<?php
require_once("../../../config.php");
require_once ("session.php");
require_once ("mdl_activequiz_attempts.php");
require_once ("mdl_question_attempts.php");
global $DB;


// TABLE :: mdl_activequiz_sessions
// SESSION
$sessionID = 29;

$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
//var_dump($sessions);



// TABLE :: mdl_activequiz_attempts
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => 29);
$result = $DB->get_records_sql($sql, $params);
//$active_attemps = $active_attemp->getAttemptsByID($result);
var_dump($result);












/*
echo "TEST QUIZ QUESTIONS:";
// TABLE :: mdl_question_attempts
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE questionid = :question;';
$params = array('question' => $questionID);
$questions = $DB->get_records_sql($sql, $params);

*/