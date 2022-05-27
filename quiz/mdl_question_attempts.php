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


    public function  __construct()
    {
    }

    public function getAttemptsByQuestionengID($result)
    {
        $attempts = array();
        $currentAttempt = new question_attempts();

        foreach ($result as $attempt) {
            $currentAttempt->id = $attempt->id;
            $currentAttempt->questionusageid = $attempt->questionusageid;
            $currentAttempt->slot = $attempt->slot;
            $currentAttempt->behaviour = $attempt->behaviour;
            $currentAttempt->questionid = $attempt->questionid;
            $currentAttempt->variant = $attempt->variant;
            $currentAttempt->maxmark = $attempt->maxmark;
            $currentAttempt->minfraction = $attempt->minfraction;
            $currentAttempt->maxfraction = $attempt->maxfraction;
            $currentAttempt->flagged = $attempt->flagged;
            $currentAttempt->questionsummary = $this->filterAnswers($attempt->questionsummary);
            $currentAttempt->rightanswer = $attempt->rightanswer;
            $currentAttempt->responsesummary = $attempt->responsesummary;
            $currentAttempt->timemodified = $attempt->timemodified;
            if ($currentAttempt != null) {
                array_push($attempts, $currentAttempt);
            }
        }
// $currentAttempts = null;

        return $attempts;
    }

    private function filterAnswers($questionsummary)
    {
        $answers = explode(':', $questionsummary);
        $listOfAnswers= explode(';', $answers[1]);
        $cleanList = array();
        foreach ($listOfAnswers as $item){
            array_push($cleanList, str_replace("\n","",$item));
        }
        return $cleanList;
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
    public function getQuestionusageid()
    {
        return $this->questionusageid;
    }

    /**
     * @return mixed
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @return mixed
     */
    public function getBehaviour()
    {
        return $this->behaviour;
    }

    /**
     * @return mixed
     */
    public function getQuestionid()
    {
        return $this->questionid;
    }

    /**
     * @return mixed
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @return mixed
     */
    public function getMaxmark()
    {
        return $this->maxmark;
    }

    /**
     * @return mixed
     */
    public function getMinfraction()
    {
        return $this->minfraction;
    }

    /**
     * @return mixed
     */
    public function getMaxfraction()
    {
        return $this->maxfraction;
    }

    /**
     * @return mixed
     */
    public function getFlagged()
    {
        return $this->flagged;
    }

    /**
     * @return mixed
     */
    public function getQuestionsummary()
    {
        return $this->questionsummary;
    }

    /**
     * @return mixed
     */
    public function getRightanswer()
    {
        return $this->rightanswer;
    }

    /**
     * @return mixed
     */
    public function getResponsesummary()
    {
        return $this->responsesummary;
    }

    /**
     * @return mixed
     */
    public function getTimemodified()
    {
        return $this->timemodified;
    }

}