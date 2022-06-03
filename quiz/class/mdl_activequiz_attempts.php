<?php
require_once("../../../config.php");


class activequiz_attempts
{
    private $id;
    private $sessionid;
    private $userid;
    private $attemptnum;
    private $questionengid;
    private $status;
    private $preview;
    private $responded;
    private $responded_count;
    private $forgroupid;
    private $timestart;
    private $timefinish;
    private $timemodified;
    private $qubalayout;


    public function __construct()
    {
    }

    public function getAttemptsByID($result)
    {
        $attempts = array();
        foreach ($result as $attempt) {
            $currentAttempt = new activequiz_attempts();
            $currentAttempt->id = $attempt->id;
            $currentAttempt->sessionid = $attempt->sessionid;
            $currentAttempt->userid = $attempt->userid;
            $currentAttempt->attemptnum = $attempt->attemptnum;
            $currentAttempt->questionengid = $attempt->questionengid;
            $currentAttempt->status = $attempt->status;
            $currentAttempt->preview = $attempt->preview;
            $currentAttempt->responded = $attempt->responded;
            $currentAttempt->responded_count = $attempt->responded_count;
            $currentAttempt->forgroupid = $attempt->forgroupid;
            $currentAttempt->timestart = $attempt->timestart;
            $currentAttempt->timefinish = $attempt->timefinish;
            $currentAttempt->timemodified = $attempt->timemodified;
            $currentAttempt->qubalayout = $attempt->qubalayout;

            if ($currentAttempt != null) {
                array_push($attempts, $currentAttempt);
            }
        }

        return $attempts;
    }

    public function filterQID($attemps)
    {
        $qid = array();
        foreach ($attemps as $attempt) {
            if ($attempt->questionengid != null) {
                array_push($qid, $attempt->questionengid);
            }
        }
        return $qid;
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
    public function getSessionid()
    {
        return $this->sessionid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @return mixed
     */
    public function getAttemptnum()
    {
        return $this->attemptnum;
    }

    /**
     * @return mixed
     */
    public function getQuestionengid()
    {
        return $this->questionengid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @return mixed
     */
    public function getResponded()
    {
        return $this->responded;
    }

    /**
     * @return mixed
     */
    public function getRespondedCount()
    {
        return $this->responded_count;
    }

    /**
     * @return mixed
     */
    public function getForgroupid()
    {
        return $this->forgroupid;
    }

    /**
     * @return mixed
     */
    public function getTimestart()
    {
        return $this->timestart;
    }

    /**
     * @return mixed
     */
    public function getTimefinish()
    {
        return $this->timefinish;
    }

    /**
     * @return mixed
     */
    public function getTimemodified()
    {
        return $this->timemodified;
    }

    /**
     * @return mixed
     */
    public function getQubalayout()
    {
        return $this->qubalayout;
    }



}