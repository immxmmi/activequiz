<?php

class quiz_builder
{
    private $response_code = 200;
    private $status = 'success';
    private $msg = 'Quizdata successfully fetched';
    private $data = array();
    private $info = '-';

    public function __construct()
    {
    }

    public function build_quiz_data($question, $answer, $right_answer)
    {

        if ($question === null) {
            $this->info = "no Question - Failed";
        } else {
            $this->info = "Loading - Success";
            $this->data = array(
                'question' => $question,
                'answers' => $answer,
                'right_answer' => $right_answer
            );
        }
        return $this->convert_quiz_to_json();
    }

    private function convert_quiz_to_json()
    {
        http_response_code($this->response_code);
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

}