<?php
require_once("../../../../config.php");
require_once("../builder/chart_img_builder.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_line.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_bar.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_pie.php");
require_once ("../lib/jpgraph-4.4.1/src/jpgraph_pie3d.php");

global $DB;

// PARAMETER
$height = (int)optional_param('height', false, PARAM_TEXT);
$width = (int)optional_param('width', false, PARAM_TEXT);
$xlabel = optional_param('xlabel', false, PARAM_TEXT);
$ylabel = optional_param('ylabel', false, PARAM_TEXT);
$type = optional_param('type', false, PARAM_TEXT);
$title = optional_param('title', false, PARAM_TEXT);
$labels = optional_param('labels', false, PARAM_TEXT);
$data = optional_param('data', false, PARAM_TEXT);

// IMG
$img_build = new chart_img_builder(
    $height,
    $width,
    $type,
    $title,
    $xlabel,
    $ylabel,
    $labels,
    $data
);

$img_build->showImage();
