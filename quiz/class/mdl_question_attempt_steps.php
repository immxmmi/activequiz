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
        $this->id = $id;
        $this->questionattemptid = $questionattemptid;
        $this->sequencenumber = $sequencenumber;
        $this->state = $state;
        $this->fraction = $fraction;
        $this->timecreated = $timecreated;
        $this->userid = $userid;
        */
    }


}