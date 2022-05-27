<?php
require_once("../../../config.php");

class question_attempts
{
    private $id;
    private $questionusageid;
    private $slot;
    private $behaviour;
    private $questionid;
    private $variant;
    private $maxmark;
    private $minfraction;
    private $maxfraction;
    private $flagged;
    private $questionsummary;
    private $rightanswer;
    private $responsesummary;
    private $timemodified;


    public function __construct(){}
    public function getAttemptsByQuestionengID($result){
        $attempts = array();
        $currentAttempt = new question_attempts();
        foreach ($result as $attempt) {
            $currentAttempt->id=$attempt->id;
            $currentAttempt->questionusageid=$attempt->questionusageid;
           // $currentAttempt->slot=$attempt->slot;
           // $currentAttempt->behaviour=$attempt->behaviour;
           // $currentAttempt->questionid=$attempt->questionid;
           // $currentAttempt->variant=$attempt->variant;
           // $currentAttempt->maxmark=$attempt->maxmark;
           // $currentAttempt->minfraction=$attempt->minfraction;
           // $currentAttempt->maxfraction=$attempt->maxfraction;
           // $currentAttempt->flagged=$attempt->flagged;
           // $currentAttempt->questionsummary= filterAnswers($attempt->questionsummary);
           // $currentAttempt->rightanswer=$attempt->rightanswer;
           // $currentAttempt->responsesummary=$attempt->responsesummary;
           // $currentAttempt->timemodified=$attempt->timemodified;

           if ($currentAttempt != null) {
               array_push($attempts, $currentAttempt);
           }
        }
// $currentAttempts = null;

        return $attempts;
    }

    private function filterAnswers($rowAnswers){
        $answers = explode(':', $rowAnswers);
        return explode(';', $answers[1]);
    }
}