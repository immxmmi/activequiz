<?php
require_once("../../../config.php");
require_once("../classes/activequiz_session.php");
require_once ("session.php");
global $DB;


// TABLE :: mdl_activequiz_sessions
// SESSION
$sessionID = 29;

$session = new Session();
$sessions = $session->getSessionByID($sessionID);

var_dump($sessions);

/*
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
//var_dump($result);
$sessions = array();

foreach ($result as $session){
    array_push($sessions, new Session($session->id, $session->activequizid, $session->name, $session->anonymize_responses, $session->fully_anonymize, $session->sessionopen, $session->status, $session->currentquestion, $session->currentqnum, $session->classresult, $session->nextstarttime, $session->created));
}

var_dump($sessions);

*/