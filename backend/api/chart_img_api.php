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
// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);
// SETTINGS
$graph->SetScale($img_build->getScale());
$graph->SetShadow();
$graph->SetFrame(false); // No border around the graph



// Setup the titles
//$graph->title->Set($img_build->getTitle());
$graph->yaxis->scale->SetGrace(50);
$graph->yaxis->SetLabelFormatCallback('separator1000');


// LABELS
$graph->xaxis->SetTickLabels($img_build->getLabels());
$graph->xaxis->SetFont(FF_FONT2);

// Setup graph title ands fonts
$graph->title->Set('Example of Y-scale callback formatting');
$graph->title->SetFont(FF_FONT2,FS_BOLD);
$graph->xaxis->title->Set('Year 2002');
$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);




$graph->yaxis->title->Set('Y-title');
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);










// BAR
$bplot = new BarPlot($img_build->getData());
$bplot->SetFillColor('orange');
$bplot->SetWidth(0.5);
$bplot->SetShadow();

// Setup the values that are displayed on top of each bar
$bplot->value->Show();

// Must use TTF fonts if we want text at an arbitrary angle
$bplot->value->SetFont(FF_ARIAL,FS_BOLD);
$bplot->value->SetAngle(45);
$bplot->value->SetFormatCallback('separator1000_usd');


// Black color for positive values and darkred for negative values
$bplot->value->SetColor('black','darkred');
$graph->Add($bplot);












// Display the graph
$graph->Stroke();






