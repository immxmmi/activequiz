<?php

class quiz_builder
{
    private $response_code = 200;
    private $status = 'success';
    private $msg = 'Quizdata successfully fetched';
    private $data = array();
    private $info = '3';
    private $slots = 1;

    public function __construct()
    {
    }

    public function build_quiz_data($question, $answer, $right_answer, $slots,$current_slot)
    {
        if ($question === null || $current_slot > $slots || $right_answer == null || $answer == null) {
            $this->info = "no Question - Failed";
            $this->msg = "SLOT ERROR";
            $this->status = "not found";
            $this->response_code = 404;
            $this->data = array(
                'question' => 'NULL',
                'answers' => null,
                'right_answer' => 'NULL',
                'current_slot' => $current_slot,
                'max_slots' => $slots
            );
        } else {
            $this->info = $this->info;
            $this->data = array(
                'question' => $question,
                'answers' => $answer,
                'right_answer' => $right_answer,
                'current_slot' => $current_slot,
                'max_slots' => $slots
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
