<?php
global $DB;

class question_data
{
    private $summary;
    private $question;
    private $answers;
    private $rightanswer;
    private $result_array = array();

    public function __construct($questionusageid, $slot)
    {
        global $DB;
        if ($questionusageid !== null) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid AND slot= :slot';
            $params = array('questionusageid' => $questionusageid, 'slot' => $slot);
            $result = $DB->get_records_sql($sql, $params);

            foreach ($result as $res) {
                array_push($result_array, $res);
            }
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";

            $this->summary = $result[$result->id]->questionsummary;

            $text = explode(':', $this->summary);
            $this->question = $text[0];
            $this->answers = $text[1]; //explode(';', $text[1]);
            $this->rightanswer = $result[$slot]->rightanswer;
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
