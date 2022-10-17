<?php
require_once("../../../config.php");
global $DB;
class mdl_question
{
    private $id;
    private $category;
    private $name;
    private $questiontext;


    public function __construct($id)
    {
        global $DB;
        if ($id !== null) {

                $sql = 'SELECT * FROM "public"."mdl_question" WHERE id = :id';
                $params = array('id' => $id);
                $result = $DB->get_records_sql($sql, $params);

                foreach ($result as $answer){
                    $this->id = $answer->id;
                    $this->category = $answer->category;
                    $this->name=$answer->name;
                    $this->questiontext=$answer->questiontext;
                }

        }

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
    public function getCategory()
    {
        return $this->category;
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
    public function getQuestiontext()
    {
        return strip_tags($this->questiontext);
    }





}

