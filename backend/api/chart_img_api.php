<?php
require_once("../../../../config.php");
require_once("../builder/chart_img_builder.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

global $DB;

// PARAMETER
$height = (int)optional_param('height', false, PARAM_TEXT);
$weight = (int)optional_param('weight', false, PARAM_TEXT);
$type = optional_param('type', false, PARAM_TEXT);
$label = optional_param('label', false, PARAM_TEXT);
$labels = optional_param('labels', false, PARAM_TEXT);
$data = optional_param('data', false, PARAM_TEXT);


// IMG
$img_build = new chart_img_builder($height,$weight,$type,$label,$labels,$data);

// Create the graph
$graph = new Graph($img_build->getWeight(),$img_build->getHeight(),'auto');
// SETTINGS
$graph->SetScale($img_build->getScale());
$graph->SetShadow();


// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);



// BAR
$bplot = new BarPlot($img_build->getData());
//$bplot->SetFillColor('orange');
$bplot->value->SetColor('black','darkred');
$graph->Add($bplot);








// Setup the titles
//$graph->title->Set($img_build->getTitle());
$graph->title->Set('A basic bar graph');
$graph->xaxis->title->Set('X-title');
$graph->yaxis->title->Set('Y-title');
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);







// Display the graph
$graph->Stroke();






