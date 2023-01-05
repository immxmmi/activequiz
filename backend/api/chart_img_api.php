<?php
require_once("../../../../config.php");
require_once("../class/mdl_question_data.php");
require_once("../class/mdl_activequiz_attempt.php");
require_once("../class/mdl_activequiz_sessions.php");
require_once("../class/mdl_question_attempts.php");
require_once("../builder/chart_img_builder.php");

require_once ("../jpgraph-4.4.1/src/jpgraph.php");
require_once ("../jpgraph-4.4.1/src/jpgraph_line.php");

global $DB;

//https://quickchart.io/chart?type:'bar'&=data:{labels:['Q1','Q2','Q3','Q4'], datasets:[{label:'Users', data:[50,60,70,180]},{label:'Revenue',data:[100,200,300,400]}]}



// PARAMETER
//$rowdata = optional_param('c', false, PARAM_TEXT);
$height = optional_param('height', false, PARAM_TEXT);
$weight = optional_param('weight', false, PARAM_TEXT);
$type = optional_param('type', false, PARAM_TEXT);
$labels = optional_param('labels', false, PARAM_TEXT);
$label = optional_param('label', false, PARAM_TEXT);
$datas = optional_param('data', false, PARAM_TEXT);

if(!$height){
    $height = 250;
}
if(!$weight){
    $weight = 400;
}
//Set the data

$series1=array(10,60,30,70,25,67,10);

$series2=array(34,89,56,12,59,70,23);



//Declare object to draw the chart

$graph = new Graph(500,300);

//Clear all

$graph->ClearTheme();

//Set some setting for the chart

$graph->SetScale("textlin");

$graph->SetShadow();

$graph->img->SetMargin(80,30,20,50);



//Create object and colors for the bar plots

$b1plot = new BarPlot($series1);

$b1plot->SetFillColor("blue");

$b2plot = new BarPlot($series2);

$b2plot->SetFillColor("red");



//Create object for the grouped bar plot

$gbplot = new AccBarPlot(array($b1plot, $b2plot));



//Add the plot for the chart

$graph->Add($gbplot);

//Set title of the chart, x-axis and y-axis

$graph->title->Set("Accumulated Bar Chart");

$graph->xaxis->title->Set("Series-1");

$graph->yaxis->title->Set("Series-2");

//Display the graph

$graph->Stroke();










//$img = new img();
//http_response_code($img->getResponseCode());
//header('Content-Type: application/json');
//
//echo json_encode($data, JSON_PRETTY_PRINT);
//exit;
