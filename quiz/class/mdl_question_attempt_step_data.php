<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;

class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;
    private $value;

    private $step_data_list = array();

    public function __construct($steps_attempts)
    {
        global $DB;
        if ($steps_attempts !== null) {

            foreach ($steps_attempts as $steps) {
                foreach ($steps as $step) {
                    $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
                    $params = array('attemptstepid' => $step->id);
                    $step_data = $DB->get_records_sql($sql, $params);
                    foreach ($step_data as $data) {
                        array_push($this->step_data_list, $data);
                    }
                }
            }
        }
    }

    public function build_step_data($id, $attemptstepid, $name, $value)
    {
        $this->id = $id;
        $this->attemptstepid = $attemptstepid;
        $this->name = $name;
        $this->value = $value;
    }


}