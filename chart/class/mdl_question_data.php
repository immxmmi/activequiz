<?php
require_once("../../../config.php");
global $DB;

class question_data
{

    private $summary;
    private $question;
    private $answers;
    private $rightanswer;

    public function __construct($questionusageid)
    {
        global $DB;
        if ($questionusageid !== null) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid';
            $params = array('questionusageid' => $questionusageid);
            $result = $DB->get_records_sql($sql, $params);
            $this->summary = $result[$questionusageid]->questionsummary;
            $text = explode(':', $this->summary);
            $this->question = $text[0];
            $this->answers = $text[1]; //explode(';', $text[1]);
            $this->rightanswer = $result[$questionusageid]->rightanswer;
        }

    }

    /**
     * @return mixed
     */
    public function getSummary()
    {


        return strip_tags($this->summary);
    }

    /**
     * @return mixed
     */
    public function getRightanswer()
    {
        return $this->rightanswer;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return false|string[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

}