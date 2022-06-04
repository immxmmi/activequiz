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
    private $step_list;
    private $attemptstepids = array();


    public function __construct($answers)
    {
        global $DB;

        foreach ($answers as $questionattemptid) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid AND sequencenumber != :sequencenumber';
            $params = array('questionattemptid' => $questionattemptid[0]->getid(), 'sequencenumber' => 0);
            $result = $DB->get_records_sql($sql, $params);
            array_push($this->attemptstepids,$result);
        }

    }

    /**
     * @return array
     */
    public function getAttemptstepids()
    {
        return $this->attemptstepids;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }




}