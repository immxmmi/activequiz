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
    private $answer_list = array();

    public function __construct($answers)
    {
        global $DB;

        foreach ($answers as $questionattemptid) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid AND sequencenumber != :sequencenumber';
            $params = array('questionattemptid' => $questionattemptid[0]->getid(), 'sequencenumber' => 0);
            $result = $DB->get_records_sql($sql, $params);

            echo"<pre>";
            print_r($result);
            echo"</pre>";

          // $currentstep = builder(
          //     $id,
          //     $questionattemptid,
          //     $sequencenumber,
          //     $state,
          //     $fraction,
          //     $timecreated,
          //     $userid,
          //     $step_list,
          //     $questionattemptid[0]->getQuestionsummary());
            array_push($this->attemptstepids,$result);
        }
        $this->id = null;
        $this->questionattemptid = null;
        $this->sequencenumber = null;
        $this->state = null;
        $this->fraction = null;
        $this->timecreated = null;
        $this->userid = null;
        $this->step_list = null;
        $this->answer_list = null;

    }


    private function builder($id, $questionattemptid, $sequencenumber, $state, $fraction, $timecreated, $userid, $step_list, array $answer_list)
    {
        $this->id = $id;
        $this->questionattemptid = $questionattemptid;
        $this->sequencenumber = $sequencenumber;
        $this->state = $state;
        $this->fraction = $fraction;
        $this->timecreated = $timecreated;
        $this->userid = $userid;
        $this->step_list = $step_list;
        $this->answer_list = $answer_list;
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