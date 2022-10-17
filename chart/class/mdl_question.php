<?php
require_once("../../../config.php");
global $DB;
class mdl_question
{
    private $id;
    private $category;
    private $name;
    private $questiontext;


    public function __construct($questionId)
    {
        global $DB;
        if ($questionId !== null) {

            foreach ($questionId as $id) {
                $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE id = :id';
                $params = array('id' => $id);
                $result = $DB->get_records_sql($sql, $params);
                $this->id = $result->id;
                $this->category = $result->category;
                $this->name->name;
                $this->questiontext->questiontext;

            }
        }

    }




}

