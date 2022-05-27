<?php
require_once("../../../config.php");


class activequiz_attempts
{
private $id;
private $sessionid;
private $userid;
private $attemptnum;
private $questionengid;
private $status;
private $preview;
private $responded;
private $responded_count;
private $forgroupid;
private $timestart;
private $timefinish;
private $timemodified;


public function __construct(){}

public function getAttemptsByID($result)
{
$attempts = array();
$currentAttempt= new activequiz_attempts();
foreach ($result as $attempt) {
echo "</br>";
echo  $attempt;
// $currentAttempts->id = $attempt->id;
// $currentAttempts->sessionid = $attempt->sessionid;
// $currentAttempts->userid = $attempt->userid;
// $currentAttempts->attemptnum = $attempt->attemptnum;
// $currentAttempts->questionengid = $attempt->questionengid;
// $currentAttempts->status = $attempt->status;
// $currentAttempts->preview = $attempt->preview;
// $currentAttempts->responded = $attempt->responded;
// $currentAttempts->responded_count = $attempt->responded_count;
// $currentAttempts->forgroupid = $attempt->forgroupid;
// $currentAttempts->timestart = $attempt->timestart;
// $currentAttempts->timefinish = $attempt->timefinish;
// $currentAttempts->timemodified = $attempt->timemodified;
//
// if ($currentAttempts != null) {
//     array_push($attempts, $currentAttempts);
// }
// $currentAttempts = null;
}
return $attempts;
}

}