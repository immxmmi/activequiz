<?php
require_once("../../../config.php");
require_once("mdl_question_attempts.php");

class quiz_builder
{
    private $response_code = 200;
    private $status = 'success';
    private $msg = 'Chartdata successfully fetched';
    private $data = array();
    private $options = array();
    private $info = '-';

    public function __construct()
    {
    }


    public function build_quiz_data($question, $answer){
                $this->data = array(
                    'question' => $question,
                    'answers' => $answer
                );
        return $this->convert_quiz_to_json();
    }


    private function convert_quiz_to_json()
    {
        http_response_code($this->response_code);
        //header('Content-Type: application/json');
        $response = array(
            'meta' => array(
                'status' => $this->status,
                'msg' => $this->msg,
                'info' => $this->info
            ),
            'data' => array(
                'data' => $this->data,
            )
        );
        return $response;
    }

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->response_code;
    }





    /**
     * @param string $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }



}