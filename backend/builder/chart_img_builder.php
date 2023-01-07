<?php

class chart_img_builder
{
    private $type;
    private $height = 300;
    private $weight = 600;
    private $title = "label";
    private $labels = array();
    private $ylabel = "-";
    private $xlabel = "-";
    private $data = array();
    private $scale = "textint";
    private $graph;

    public function __construct($height, $weight, $type, $title, $xlabel, $ylabel, $row_labels, $row_data)
    {
        // SIZE
        $this->height = $height;
        $this->weight = $weight;

        // CHART TYPE
        $this->type = $type;

        // LABEL FOR AXIS
        $this->xlabel = $xlabel;
        $this->ylabel = $ylabel;

        // CHART TITLE
        $this->title = $title;

        // LABELS
        $this->setLabels($row_labels);

        // DATA
        $this->setData($row_data);

        $this->createGraph($this->type);
    }


    public function getHeight(): int
    {
        if (!$this->height) {
            $this->height = 300;
        }
        return $this->height;
    }
    public function getWeight(): int
    {
        if (!$this->weight) {
            $this->weight = 600;
        }
        return $this->weight;
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

    private function createGraph($type)
    {
        switch ($type){
            case "pie" : $this->createPiePlot();break;
            case "pie3d" : $this->create3dPiePlot();break;
            default : $this->createBarPlot();break;
        }

        $this->setGraphTitle($this->title);
        $this->graph->SetMargin(60, 70, 50, 50);
    }

    private function setGraphTitle($title){
            // TITLE
        $this->graph->title->Set($title);
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

    private function createBarPlot(){
        $this->graph = new Graph($this->getWeight(), $this->getHeight(), 'auto');
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
    private function createPiePlot(){
        // Create the Pie Graph.
        $this->graph = new PieGraph($this->getWeight(),$this->getHeight());
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
    private function create3dPiePlot(){
        // Create the Pie Graph.
        $this->graph = new PieGraph($this->getWeight(),$this->getHeight());

        $theme_class= new VividTheme;
        $this->graph->SetTheme($theme_class);



        $p1 = new PiePlot3D($this->data);
        $this->graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->ExplodeSlice(1);

        // COLORS
        //$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));


        $legends = $this->labels;//array('April (%d)','May (%d)','June (%d)');
        $p1->SetLegends($legends);

    }


    // Display Chart
    public function showImage(){
        $this->graph->Stroke();
    }
}
