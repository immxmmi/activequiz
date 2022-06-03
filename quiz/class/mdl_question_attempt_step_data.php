<?php
require_once("../../../config.php");
global $DB;
class attempt_step_data
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
    public $questionsummary;
}