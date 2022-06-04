<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;
class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;

    public function __construct($steps)
    {
        global $DB;

        foreach ($steps as $step) {
            foreach ($step as $class) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
            $params = array('attemptstepid' => $class->getId());
           // $result = $DB->get_records_sql($sql, $params);
                //      array_push($this->attemptstepids,$result);
                //   }
                echo "<pre>";
                print_r($class);
                echo "</pre>";
            }
        }
    }

}