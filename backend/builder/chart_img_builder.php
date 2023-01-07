<?php

class chart_img_builder
{
    public $type = "bar";
    private $height = 300;
    private $weight = 600;
    private $title = "label";
    private $labels = array();
    private $ylabel = "-";
    private $xlabel = "-";
    private $data = array();
    private $scale = "textint";
    public $graph;

    public function __construct($height, $weight, $type, $label, $xlabel, $ylabel, $row_labels, $row_data)
    {
        $this->type = $type;
        $this->xlabel = $xlabel;
        $this->ylabel = $ylabel;
        $this->height = $height;
        if (!$this->height) {
            $this->height = 300;
        }
        $this->weight = $weight;
        if (!$this->weight) {
            $this->weight = 600;
        }

        $this->title = $label;
       // $this->setLabelsForPie($row_labels);
        $this->setLabels($row_labels);
        $this->setData($row_data);
        $this->createGraph();
    }

    public function setLabels($row_labels)
    {
        $row_labels = explode("',' ", $row_labels);
        foreach ($row_labels as $val) {
            array_push($this->labels, trim($val, '\''));
        }
    }

    public function setLabelsForPie($row_labels)
    {
        $row_labels = explode("',' ", $row_labels);
        foreach ($row_labels as $val) {
            trim($val, '\'');
            array_push($this->labels, $val);
        }
    }

    public function setData($row_data)
    {
        $row_data = explode(",", $row_data);
        foreach ($row_data as $val) {
            array_push($this->data, (int)$val);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    private function createGraph()
    {
        /*
        $this->choicePiePlot();
        */


        $this->graph = new Graph($this->weight, $this->height, 'auto');

        $this->setGraphTitle();
        $this->graph->SetMargin(60, 90, 50, 50);

        $this->choiceBarPlot();
    }

    private function setGraphTitle(){
            // TITLE
        $this->graph->title->Set($this->title);
        $this->graph->title->SetFont(FF_FONT1,FS_BOLD);
    }



    private function setYaxisGraph(){
        $this->graph->yaxis->title->Set($this->ylabel);
        $this->graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $this->graph->yaxis->scale->SetGrace(10);
    }
    private function setXaxisGraph(){
        $this->graph->xaxis->title->Set($this->xlabel);
        $this->graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);
        //LABELS
        $this->graph->xaxis->SetTickLabels($this->labels);
    }

    private function choiceBarPlot(){
        // SETTINGS
        $this->graph->SetScale($this->scale);
        $this->graph->SetShadow();
        $this->graph->SetFrame(false);



        $this->setYaxisGraph();
        $this->setXaxisGraph();

        // BAR
        $bplot = new BarPlot($this->data);
        $bplot->SetFillColor('orange');
        $bplot->SetWidth(0.8);
        $bplot->SetShadow();

         // VALUE
        $bplot->value->Show();
        $bplot->value->SetFont(FF_ARIAL,FS_BOLD);
        $bplot->value->SetAngle(45);
        $bplot->value->SetColor('green','darkred');

        $this->graph->Add($bplot);
    }

    private function choicePiePlot(){
        // Create the Pie Graph.
        $this->graph = new PieGraph($this->weight,$this->height);
        $this->graph->SetBox(true);



        $p1 = new PiePlot($this->data);
        $this->graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');


        // COLORS
        //$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));


        $legends = $this->labels;//array('April (%d)','May (%d)','June (%d)');
        $p1->SetLegends($legends);

    }

    public function showImage(){
        $this->graph->Stroke();
    }
}
