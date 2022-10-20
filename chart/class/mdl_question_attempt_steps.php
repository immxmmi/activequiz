<?php

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
        if ($answers !== null) {

            foreach ($answers as $questionattemptid) {
                $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid AND sequencenumber != :sequencenumber';
                $params = array('questionattemptid' => $questionattemptid[0]->getid(), 'sequencenumber' => 0);
                $result = $DB->get_records_sql($sql, $params);

                foreach ($result as $answer) {

                    $currentstep = $this->builder(
                        $answer->id,
                        $answer->questionattemptid,
                        $answer->sequencenumber,
                        $answer->state,
                        $answer->fraction,
                        $answer->timecreated,
                        $answer->userid,
                        $questionattemptid[0]->getQuestionsummary());
                    array_push($this->attemptstepids, $currentstep);
                }

            }
        }

    }


    private function builder($id, $questionattemptid, $sequencenumber, $state, $fraction, $timecreated, $userid, array $answer_list)
    {
        $current_step = new attempt_steps(null);
        $current_step->id = $id;
        $current_step->questionattemptid = $questionattemptid;
        $current_step->sequencenumber = $sequencenumber;
        $current_step->state = $state;
        $current_step->fraction = $fraction;
        $current_step->timecreated = $timecreated;
        $current_step->userid = $userid;
        $current_step->answer_list = $answer_list;
        return $current_step;
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

    /**
     * @return array
     */
    public function getAnswerList()
    {
        return $this->answer_list;
    }



}