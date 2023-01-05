<?php
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");

// PARAMETER

// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");


$height = optional_param('height', false, PARAM_TEXT);
if(!$height){
    $height = 350;
}
$weight = optional_param('weight', false, PARAM_TEXT);
if(!$weight){
    $weight = 400;
}


$type = optional_param('type', false, PARAM_TEXT);
$labels = optional_param('labels', false, PARAM_TEXT);
$label = optional_param('label', false, PARAM_TEXT);
$datas = optional_param('data', false, PARAM_TEXT);


$datay=array(62,105,85,50);
$labels = array('A','B','C','D');



//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($labels);


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
