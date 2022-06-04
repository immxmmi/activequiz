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
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
            $params = array('attemptstepid' => array_shift($step)->getId());
            $result = $DB->get_records_sql($sql, $params);

            echo"<pre>";
            print_r($result);
            echo"</pre>";

           // array_push($this->attemptstepids,$result);
        }

    }

}