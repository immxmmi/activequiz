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
$xlabel = optional_param('xlabel', false, PARAM_TEXT);
$ylabel = optional_param('ylabel', false, PARAM_TEXT);
$type = optional_param('type', false, PARAM_TEXT);
$title = optional_param('title', false, PARAM_TEXT);
$labels = optional_param('labels', false, PARAM_TEXT);
$data = optional_param('data', false, PARAM_TEXT);

// IMG
$img_build = new chart_img_builder($height,$weight,$type,$title,$xlabel,$ylabel,$labels,$data);

// Create the graph
$graph = $img_build->graph;


// Display the graph
$graph->Stroke();
