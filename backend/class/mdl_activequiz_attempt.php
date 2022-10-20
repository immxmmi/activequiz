<?php
global $DB;

class activequiz_attempt
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
    private $qubalayout;

    // array with all SESSION -> active_attemps
    private $active_attemps = array();
    // array with all md_question -> ID
    private $all_questionengids = array();


    public function __construct($sessionid)
    {
        if ($sessionid !== null) {
            global $DB;
            $sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
            $params = array('sessionid' => $sessionid);
            $result = $DB->get_records_sql($sql, $params);
            $this->sessionid = $sessionid;
            $this->active_attemps = $this->get_attempts_by_id($result);
            $this->all_questionengids = $this->filter_questionengids($this->active_attemps);
        }
    }

    private function get_attempts_by_id($result)
    {
        $attempts = array();
        foreach ($result as $attempt) {
            $currentAttempt = new activequiz_attempt(null);
            $currentAttempt->id = $attempt->id;
            $currentAttempt->sessionid = $attempt->sessionid;
            $currentAttempt->userid = $attempt->userid;
            $currentAttempt->attemptnum = $attempt->attemptnum;
            $currentAttempt->questionengid = $attempt->questionengid;
            $currentAttempt->status = $attempt->status;
            $currentAttempt->preview = $attempt->preview;
            $currentAttempt->responded = $attempt->responded;
            $currentAttempt->responded_count = $attempt->responded_count;
            $currentAttempt->forgroupid = $attempt->forgroupid;
            $currentAttempt->timestart = $attempt->timestart;
            $currentAttempt->timefinish = $attempt->timefinish;
            $currentAttempt->timemodified = $attempt->timemodified;
            $currentAttempt->qubalayout = $attempt->qubalayout;

            if ($currentAttempt != null) {
                array_push($attempts, $currentAttempt);
            }
        }

        return $attempts;
    }

    private function filter_questionengids($attemps)
    {
        $qid = array();
        foreach ($attemps as $attempt) {
            if ($attempt->questionengid != null) {
                array_push($qid, $attempt->questionengid);
            }
        }
        return $qid;
    }


    /**
     * @return array return all questionengids of a session
     */
    public function getAllQuestionengids()
    {
        return $this->all_questionengids;
    }
}