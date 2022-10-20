<?php
global $DB;
class activequiz_session
{
    private $id;
    private $activequizid;
    private $name;
    private $anonymize_responses;
    private $fully_anonymize;
    private $sessionopen;
    private $status;
    private $currentquestion;
    private $currentqnum;
    private $classresult;
    private $nextstarttime;
    private $created;

    /**
     * @param $id
     * @param $activequizid
     * @param $name
     * @param $anonymize_responses
     * @param $fully_anonymize
     * @param $sessionopen
     * @param $status
     * @param $currentquestion
     * @param $currentqnum
     * @param $classresult
     * @param $nextstarttime
     * @param $created
     */
    public function __construct($sessionid){
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
        $params = array('sessionid' => $sessionid);
        $session = $DB->get_records_sql($sql, $params);

        $this->id = $session[$sessionid]->id;
        $this->activequizid = $session[$sessionid]->activequizid;
        $this->name = $session[$sessionid]->name;
        $this->anonymize_responses = $session[$sessionid]->anonymize_responses;
        $this->fully_anonymize = $session[$sessionid]->fully_anonymize;
        $this->sessionopen = $session[$sessionid]->sessionopen;
        $this->status = $session[$sessionid]->status;
        $this->currentquestion = $session[$sessionid]->currentquestion;
        $this->currentqnum = $session[$sessionid]->currentqnum;
        $this->classresult = $session[$sessionid]->classresult;
        $this->nextstarttime = $session[$sessionid]->nextstarttime;
        $this->created = $session[$sessionid]->created;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getActivequizid()
    {
        return $this->activequizid;
    }

    /**
     * @return mixed
     */
    public function getSessionopen()
    {
        return $this->sessionopen;
    }


    /**
     * @return mixed
     */
    public function getCurrentquestion()
    {
        return $this->currentquestion;
    }

}

