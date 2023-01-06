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
    public function setData($row_data)
    {
        $row_data = explode(",", $row_data);
        foreach ($row_data as $val) {
            array_push($this->data, (int)$val);
        }
    }

    private function createGraph()
    {
        $this->graph = new Graph($this->getWeight(), $this->getHeight(), 'auto');
        $this->graph->SetMargin(60, 30, 50, 50);

        // SETTINGS
        $this->graph->SetScale($this->scale);
        $this->graph->SetShadow();
        $this->graph->SetFrame(false);

        // TITLE
        $this->graph->title->Set($this->getTitle());
        $this->graph->title->SetFont(FF_FONT1,FS_BOLD);

        $this->choiceBarPlot();
    }

    // Bar
    private function choiceBarPlot(){

        $this->setYaxisGraph();
        $this->setXaxisGraph();

        // BAR
        $bplot = new BarPlot($this->data());
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

}
