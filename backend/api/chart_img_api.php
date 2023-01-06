<?php
require_once("../../../../config.php");
require_once("../builder/chart_img_builder.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

global $DB;

// PARAMETER
$labels = optional_param('labels', false, PARAM_TEXT);
$data = optional_param('data', false, PARAM_TEXT);
$label = optional_param('label', false, PARAM_TEXT);
$height = (int)optional_param('height', false, PARAM_TEXT);
$weight = (int)optional_param('weight', false, PARAM_TEXT);
$type = optional_param('type', false, PARAM_TEXT);



// IMG
$img_build = new chart_img_builder($height,$weight,$label,$data, $labels);


// Create the graph
$graph = new Graph($img_build->getWeight(),$img_build->getHeight(),'auto');

// Add a drop shadow
$graph->SetShadow();
$graph->SetScale($img_build->getScale());
$graph->title->Set($img_build->getTitle());


// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);

// BAR
$bplot = new BarPlot($img_build->data);
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






