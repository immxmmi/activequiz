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
            $currentAttempt->responsesummary = $this->deleteCharAT($attempt->responsesummary,strlen($attempt->responsesummary)-1);
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



    public function deleteCharAT($word,$index){
        $arr = str_split($word); // String in Array umwandeln
        unset($arr[$index]); // Zeichen mit Index  loeschen
        return implode('', $arr);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQuestionusageid()
    {
        return $this->questionusageid;
    }

    /**
     * @param mixed $questionusageid
     */
    public function setQuestionusageid($questionusageid)
    {
        $this->questionusageid = $questionusageid;
    }

    /**
     * @return mixed
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @param mixed $slot
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;
    }

    /**
     * @return mixed
     */
    public function getBehaviour()
    {
        return $this->behaviour;
    }

    /**
     * @param mixed $behaviour
     */
    public function setBehaviour($behaviour)
    {
        $this->behaviour = $behaviour;
    }

    /**
     * @return mixed
     */
    public function getQuestionid()
    {
        return $this->questionid;
    }

    /**
     * @param mixed $questionid
     */
    public function setQuestionid($questionid)
    {
        $this->questionid = $questionid;
    }

    /**
     * @return mixed
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param mixed $variant
     */
    public function setVariant($variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return mixed
     */
    public function getMaxmark()
    {
        return $this->maxmark;
    }

    /**
     * @param mixed $maxmark
     */
    public function setMaxmark($maxmark)
    {
        $this->maxmark = $maxmark;
    }

    /**
     * @return mixed
     */
    public function getMinfraction()
    {
        return $this->minfraction;
    }

    /**
     * @param mixed $minfraction
     */
    public function setMinfraction($minfraction)
    {
        $this->minfraction = $minfraction;
    }

    /**
     * @return mixed
     */
    public function getMaxfraction()
    {
        return $this->maxfraction;
    }

    /**
     * @param mixed $maxfraction
     */
    public function setMaxfraction($maxfraction)
    {
        $this->maxfraction = $maxfraction;
    }

    /**
     * @return mixed
     */
    public function getFlagged()
    {
        return $this->flagged;
    }

    /**
     * @param mixed $flagged
     */
    public function setFlagged($flagged)
    {
        $this->flagged = $flagged;
    }

    /**
     * @return mixed
     */
    public function getQuestionsummary()
    {
        return $this->questionsummary;
    }

    /**
     * @param mixed $questionsummary
     */
    public function setQuestionsummary($questionsummary)
    {
        $this->questionsummary = $questionsummary;
    }

    /**
     * @return mixed
     */
    public function getRightanswer()
    {
        return $this->rightanswer;
    }

    /**
     * @param mixed $rightanswer
     */
    public function setRightanswer($rightanswer)
    {
        $this->rightanswer = $rightanswer;
    }

    /**
     * @return mixed
     */
    public function getResponsesummary()
    {
        return $this->responsesummary;
    }

    /**
     * @param mixed $responsesummary
     */
    public function setResponsesummary($responsesummary)
    {
        $this->responsesummary = $responsesummary;
    }

    /**
     * @return mixed
     */
    public function getTimemodified()
    {
        return $this->timemodified;
    }

    /**
     * @param mixed $timemodified
     */
    public function setTimemodified($timemodified)
    {
        $this->timemodified = $timemodified;
    }


}