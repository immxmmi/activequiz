<?php
require_once("../../../config.php");
global $DB;

class attempt_steps
{
    private $id;
    private $questionattemptid;
    private $sequencenumber;
    private $state;
    private $fraction;
    private $timecreated;
    private $userid;
    private $step_list;


    public function __construct($answers)
    {
        global $DB;

        var_dump($answers);

        foreach ($answers as $questionattemptid) {
            $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid';
            $params = array('questionattemptid' => $questionattemptid[0]->getid());
            $result = $DB->get_records_sql($sql, $params);

            echo"<pre>";
            print_r($result);
            echo"</pre>";
        }


      /*  if ($questionattemptids !== null) {


                echo"<pre>";
                print_r($result);
                echo"</pre>";

              //  $current_step = $this->get_steps_by_questionengid($result);
              //  array_push($step_list, $current_step);
            }
        }
      */
    }






    private function get_steps_by_questionengid($result)
    {
        $steps = array();
        $current_step= new attempt_steps(null,null);

        foreach ($result as $step) {
            $current_step->id = $step->id;
            $current_step->questionattemptid = $step->questionattemptid;
            $current_step->sequencenumber = $step->sequencenumber;
            $current_step->state = $step->state;
            $current_step->fraction = $step->fraction;
            $current_step->timecreated = $step->timecreated;
            $current_step->userid = $step->userid;
            $current_step->step_list = $step->step_list;

            if ($current_step != null) {
                array_push($steps, $current_step);
            }
        }

        return $steps;
    }







}