<?php
require_once("../../../../config.php");
require_once("../class/mdl_question_data.php");
require_once("../class/mdl_activequiz_attempt.php");
require_once("../class/mdl_activequiz_sessions.php");
require_once("../class/mdl_question_attempts.php");
require_once("../builder/chart_img_builder.php");

require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

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
    $height = 350;
}
if(!$weight){
    $weight = 400;
}

$datay=array(62,105,85,50);


// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);

$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set($label);

// Display the graph
$graph->Stroke();









//$img = new img();
//http_response_code($img->getResponseCode());
//header('Content-Type: application/json');
//
//echo json_encode($data, JSON_PRETTY_PRINT);
//exit;