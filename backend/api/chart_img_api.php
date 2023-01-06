<?php
require_once("../../../../config.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

global $DB;


$datay=array(12,8,19,3,10,5);

// Create the graph. These two calls are always required
$graph = new Graph(300,200);
$graph->SetScale('intlin');

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);

// Create a bar pot
$bplot = new BarPlot($datay);

// Adjust fill color
$bplot->SetFillColor('orange');
$graph->Add($bplot);

// Setup the titles
$graph->title->Set('A basic bar graph');
$graph->xaxis->title->Set('X-title');
$graph->yaxis->title->Set('Y-title');

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();



/*
// PARAMETER
$height = (int)optional_param('height', false, PARAM_TEXT);
if(!$height){$height = 250;}

$weight = (int)optional_param('weight', false, PARAM_TEXT);
if(!$weight){$weight = 350;}

// Create the graph. These two calls are always required
$graph = new Graph($weight,$height,'auto');
$graph->SetScale("textlin");


$type = optional_param('type', false, PARAM_TEXT);

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




//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,3,6,9,12,15), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);

$graph->xaxis->SetTickLabels($labels);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data);

// ...and add it to the graPH
$graph->Add($b1plot);







// rand
$border = "black";
$b1plot->SetColor($border);

$b1plot->SetFillGradient("blue","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(70);


// Display the graph
$graph->Stroke();


*/



