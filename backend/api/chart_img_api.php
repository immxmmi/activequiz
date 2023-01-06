<?php
require_once("../../../../config.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

global $DB;

// PARAMETER
$height = (int)optional_param('height', false, PARAM_TEXT);
if(!$height){$height = 250;}

$weight = (int)optional_param('weight', false, PARAM_TEXT);
if(!$weight){$weight = 350;}

// Create the graph. These two calls are always required
$graph = new Graph($weight,$height,'auto');
$graph->SetScale('intlin');

// Add a drop shadow
$graph->SetShadow();
// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);


// TYPE
$type = optional_param('type', false, PARAM_TEXT);

// LABEL
$label = optional_param('label', false, PARAM_TEXT);
$graph->title->Set($label);



$row_labels = optional_param('labels', false, PARAM_TEXT);
$row_labels = explode("',' ", $row_labels);
$labels = array();
foreach ($row_labels as $val) {
    $test = "test";
    array_push($labels,trim($val,'\''));
}

$row_data = optional_param('data', false, PARAM_TEXT);
$row_data = explode(",", $row_data);
$data = array();
foreach ($row_data as $val) {
    array_push($data,(int)$val);
}

// Create the bar plots
$bplot = new BarPlot($data);


// Adjust fill color
$bplot->SetFillColor('orange');
$graph->Add($bplot);



// Setup the titles
$graph->xaxis->title->Set('X-title');
$graph->yaxis->title->Set('Y-title');

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);







// Display the graph
$graph->Stroke();






