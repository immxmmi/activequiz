<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;
class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;

    public function __construct($steps_attempts)
    {
        global $DB;

        foreach ($steps_attempts as $steps) {
            foreach ($steps as $step) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
            $params = array('attemptstepid' => $step->id);
            $step_data= $DB->get_records_sql($sql, $params);
                foreach($step_data as $data){
                    echo "<pre>";
                    print_r($data);
                    echo "</pre>";
                }
                //      array_push($this->attemptstepids,$result);
                //   }
            }
        }
    }

}