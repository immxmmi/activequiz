<?php
require_once("../../../config.php");
require_once("../classes/activequiz_session.php");
require_once ("session.php");
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
    public function __construct($id, $activequizid, $name, $anonymize_responses, $fully_anonymize, $sessionopen, $status, $currentquestion, $currentqnum, $classresult, $nextstarttime, $created)
    {
        $this->id = $id;
        $this->activequizid = $activequizid;
        $this->name = $name;
        $this->anonymize_responses = $anonymize_responses;
        $this->fully_anonymize = $fully_anonymize;
        $this->sessionopen = $sessionopen;
        $this->status = $status;
        $this->currentquestion = $currentquestion;
        $this->currentqnum = $currentqnum;
        $this->classresult = $classresult;
        $this->nextstarttime = $nextstarttime;
        $this->created = $created;
    }



    public function getSessionByID($sessionID){
        $sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
        $params = array('sessionid' => $sessionID);
        $result = $DB->get_records_sql($sql, $params);
        //var_dump($result);
        $sessions = array();

        foreach ($result as $session){
            array_push($sessions, new Session($session->id, $session->activequizid, $session->name, $session->anonymize_responses, $session->fully_anonymize, $session->sessionopen, $session->status, $session->currentquestion, $session->currentqnum, $session->classresult, $session->nextstarttime, $session->created));
        }
        return $sessions;
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








}

