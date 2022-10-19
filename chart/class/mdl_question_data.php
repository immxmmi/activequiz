<?php
require_once("../../../config.php");
global $DB;

class question_data
{

    private $summary;

    public function __construct($questionusageid)
    {
        global $DB;
        if ($questionusageid !== null) {
                $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid';
                $params = array('questionusageid' => $questionusageid);
                $result = $DB->get_records_sql($sql, $params);
                $this->summary = $result->id;
        }

    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }



}