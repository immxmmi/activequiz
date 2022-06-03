<?php
require_once("../../../config.php");
global $DB;

class attempt_steps
{
    private $id;
    private $questionattemptid;
    private $sequencenumber;
    private $state;
    private $fraction;
    private $timecreated;
    private $userid;

    /**
     * @param $id
     * @param $questionattemptid
     * @param $sequencenumber
     * @param $state
     * @param $fraction
     * @param $timecreated
     * @param $userid
     */


    public function __construct($questionattemptid)
    {
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid';
        $params = array('questionattemptid' => $questionattemptid);
        $result = $DB->get_records_sql($sql, $params);
        echo"<pre>";
        print_r($result);
        echo"</pre>";
        /*
        $this->id = $result->id;
        $this->questionattemptid = $result->questionattemptid;
        $this->sequencenumber = $result->sequencenumber;
        $this->state = $result->state;
        $this->fraction = $result->fraction;
        $this->timecreated = $result->timecreated;
        $this->userid = $result->userid;
        */
    }


}