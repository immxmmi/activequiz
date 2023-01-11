<?php
require_once("mdl_question_attempt_steps.php");
global $DB;

class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;
    private $value;
    private $answer_list = array();
    private $answer;

    private $step_data_list = array();

    public function __construct($steps_attempts)
    {
        global $DB;
        if ($steps_attempts !== null) {

            foreach ($steps_attempts as $step) {

                $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid AND name = :name';
                $params = array('attemptstepid' => $step->getId(), 'name' => "answer");
                $step_data = $DB->get_records_sql($sql, $params);
                foreach ($step_data as $data) {
                    $current_data = $this->build($data->id,$data->attemptstepid,$data->name,$data->value,$step->getAnswerList());
                    array_push($this->step_data_list, $current_data);
                }
            }
        }
    }

    private function build($id, $attemptstepid, $name, $value, array $answer_list)
    {
        $currentStep = new attempt_step_data(null);
        $currentStep->id = $id;
        $currentStep->attemptstepid = $attemptstepid;
        $currentStep->name = $name;
        $currentStep->value = $value;
        $currentStep->answer_list = $answer_list;
        $currentStep->answer = $answer_list[$currentStep->value];
        return $currentStep;
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
    public function getAttemptstepid()
    {
        return $this->attemptstepid;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getStepDataList()
    {
        return $this->step_data_list;
    }

    /**
     * @return array
     */
    public function getAnswerList()
    {
        return $this->answer_list;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }



}
