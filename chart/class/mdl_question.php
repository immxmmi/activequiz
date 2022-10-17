<?php
require_once("../../../config.php");
global $DB;
class mdl_question
{
    private $id;
    private $category;
    private $name;
    private $questiontext;


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
    public function __construct($questionid){
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :questionid';
        $params = array('questionid' => $questionid);
        $session = $DB->get_records_sql($sql, $params);

        //$this->id = $session[$sessionid]->id;
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

