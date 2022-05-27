<?php
require_once("../../../config.php");
require_once ("session.php");
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
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $sessionID);
$questions = $DB->get_records_sql($sql, $params);













/*
echo "TEST QUIZ QUESTIONS:";
// TABLE :: mdl_question_attempts
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE questionid = :question;';
$params = array('question' => $questionID);
$questions = $DB->get_records_sql($sql, $params);

*/