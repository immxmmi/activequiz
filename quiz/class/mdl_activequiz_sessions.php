<?php
require_once("../../../../config.php");
global $DB;
class Session
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAnonymizeResponses()
    {
        return $this->anonymize_responses;
    }

    /**
     * @return mixed
     */
    public function getFullyAnonymize()
    {
        return $this->fully_anonymize;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCurrentquestion()
    {
        return $this->currentquestion;
    }

    /**
     * @return mixed
     */
    public function getCurrentqnum()
    {
        return $this->currentqnum;
    }

    /**
     * @return mixed
     */
    public function getClassresult()
    {
        return $this->classresult;
    }

    /**
     * @return mixed
     */
    public function getNextstarttime()
    {
        return $this->nextstarttime;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $activequizid
     */
    public function setActivequizid($activequizid)
    {
        $this->activequizid = $activequizid;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $anonymize_responses
     */
    public function setAnonymizeResponses($anonymize_responses)
    {
        $this->anonymize_responses = $anonymize_responses;
    }

    /**
     * @param mixed $fully_anonymize
     */
    public function setFullyAnonymize($fully_anonymize)
    {
        $this->fully_anonymize = $fully_anonymize;
    }

    /**
     * @param mixed $sessionopen
     */
    public function setSessionopen($sessionopen)
    {
        $this->sessionopen = $sessionopen;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $currentquestion
     */
    public function setCurrentquestion($currentquestion)
    {
        $this->currentquestion = $currentquestion;
    }

    /**
     * @param mixed $currentqnum
     */
    public function setCurrentqnum($currentqnum)
    {
        $this->currentqnum = $currentqnum;
    }

    /**
     * @param mixed $classresult
     */
    public function setClassresult($classresult)
    {
        $this->classresult = $classresult;
    }

    /**
     * @param mixed $nextstarttime
     */
    public function setNextstarttime($nextstarttime)
    {
        $this->nextstarttime = $nextstarttime;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


}

