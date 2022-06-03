<?php
require_once("../../../config.php");
global $DB;

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
    private $list_of_answers = array(); // LIST ATTEMPS

    public function __construct($allquestionengids, $slot)
    {
        global $DB;
        if ($allquestionengids !== null && $slot !== null) {

            foreach ($allquestionengids as $questionengids) {
                $sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid AND slot= :slot';
                $params = array('questionusageid' => $questionengids, 'slot' => $slot);
                $result = $DB->get_records_sql($sql, $params);
                $question_attemps = $this->get_attempts_by_questionengid($result);
                array_push($this->list_of_answers, $question_attemps);
            }
        }

    }

    private function get_attempts_by_questionengid($result)
    {
        $attempts = array();
        $currentAttempt = new question_attempts(null,null);

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
            $currentAttempt->responsesummary = $this->deleteCharAT($attempt->responsesummary, strlen($attempt->responsesummary) - 1);
            $currentAttempt->timemodified = $attempt->timemodified;
            if ($currentAttempt != null) {
                array_push($attempts, $currentAttempt);
            }
        }

        return $attempts;
    }

    private function filterAnswers($questionsummary)
    {
        $answers = explode(':', $questionsummary);
        $listOfAnswers = explode(';', $answers[1]);
        $cleanList = array();
        foreach ($listOfAnswers as $item) {
            array_push($cleanList, str_replace("\n", "", $item));
        }
        return $cleanList;
    }


    private function deleteCharAT($word, $index)
    {
        $arr = str_split($word); // String in Array umwandeln
        unset($arr[$index]); // Zeichen mit Index  loeschen
        return implode('', $arr);
    }

    /**
     * @return array
     */
    public function getListOfAnswers()
    {
        return $this->list_of_answers;
    }


}