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
$graph->SetMargin(80,50,50,50);

// SETTINGS
$graph->SetScale($img_build->getScale());
$graph->SetShadow();
$graph->SetFrame(false);


// TITLE
$graph->title->Set($img_build->getTitle());
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Y
$graph->yaxis->scale->SetGrace(10);
$graph->yaxis->title->Set('Y-title');
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);

// LABELS X
$graph->xaxis->title->Set('X-title');
$graph->xaxis->SetTickLabels($img_build->getLabels());
$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);

// BAR
$bplot = new BarPlot($img_build->getData());
$bplot->SetFillColor('orange');
$bplot->SetWidth(0.8);
$bplot->SetShadow();

// VALUE
$bplot->value->Show();
$bplot->value->SetFont(FF_ARIAL,FS_BOLD);
$bplot->value->SetAngle(45);
$bplot->value->SetColor('green','darkred');

$graph->Add($bplot);

// Display the graph
$graph->Stroke();
