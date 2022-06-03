<?php
require_once("../../../config.php");
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
        //$this->get_session_by_id($result);
        echo "<pre>";
        print_r($session);
        echo "</pre>";

        $this->id = $session->46->id;
/*
        $this->activequizid = $session->activequizid;
        $this->name = $session->name;
        $this->anonymize_responses = $session->anonymize_responses;
        $this->fully_anonymize = $session->fully_anonymize;
        $this->sessionopen = $session->sessionopen;
        $this->status = $session->status;
        $this->currentquestion = $session->currentquestion;
        $this->currentqnum = $session->currentqnum;
        $this->classresult = $session->classresult;
        $this->nextstarttime = $session->nextstarttime;
        $this->created = $session->created;
*/
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






    private function get_session_by_id($result){
        $sessions = array();
        $currentSession = new Session(46);
        foreach ($result as $session) {
            $currentSession->id = $session->id;
            $currentSession->activequizid = $session->activequizid;
            $currentSession->name = $session->name;
            $currentSession->anonymize_responses = $session->anonymize_responses;
            $currentSession->fully_anonymize = $session->fully_anonymize;
            $currentSession->sessionopen = $session->sessionopen;
            $currentSession->status= $session->status;
            $currentSession->currentquestion= $session->currentquestion;
            $currentSession->currentqnum= $session->currentqnum;
            $currentSession->classresult= $session->classresult;
            $currentSession->nextstarttime= $session->nextstarttime;
            $currentSession->created= $session->created;
            if($currentSession != null){
                array_push($sessions, $currentSession);
            }
            $currentSession = null;
        }
        return $sessions[0];
    }




    public function getSessionByID($result)
    {
        $sessions = array();
        $currentSession = new Session(46);
        foreach ($result as $session) {
            $currentSession->id = $session->id;
            $currentSession->activequizid = $session->activequizid;
            $currentSession->name = $session->name;
            $currentSession->anonymize_responses = $session->anonymize_responses;
            $currentSession->fully_anonymize = $session->fully_anonymize;
            $currentSession->sessionopen = $session->sessionopen;
            $currentSession->status= $session->status;
            $currentSession->currentquestion= $session->currentquestion;
            $currentSession->currentqnum= $session->currentqnum;
            $currentSession->classresult= $session->classresult;
            $currentSession->nextstarttime= $session->nextstarttime;
            $currentSession->created= $session->created;
            if($currentSession != null){
                array_push($sessions, $currentSession);
            }
            $currentSession = null;
        }
       return $sessions[0];
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

