<?php
require_once("../../../config.php");
require_once("../classes/activequiz_session.php");
global $DB;


// TABLE :: mdl_activequiz_sessions
// SESSION
$sessionID = 29;

$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$sessions = $DB->get_records_sql($sql, $params);

var_dump($sessions);