<?php
require_once("../../../../config.php");
require_once("../class/mdl_question_data.php");
require_once("../class/mdl_activequiz_attempt.php");
require_once("../class/mdl_activequiz_sessions.php");
require_once("../class/mdl_question_attempts.php");
require_once("../builder/chart_img_builder.php");
global $DB;

//https://quickchart.io/chart?c={
//type:'bar',
//data:{labels:['Q1','Q2','Q3','Q4'], datasets:[{label:'Users', data:[50,60,70,180]},{label:'Revenue',data:[100,200,300,400]}]}}



// PARAMETER
$type = optional_param('type', false, PARAM_TEXT);
$c = optional_param('c', false, PARAM_TEXT);
$data = optional_param('data', false, PARAM_TEXT);
var_dump($c);
//$img = new img();
//http_response_code($img->getResponseCode());
//header('Content-Type: application/json');
//
//echo json_encode($data, JSON_PRETTY_PRINT);
//exit;
