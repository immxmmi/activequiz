<?php

class chart_img_builder
{
    private $type;
    private $height = 300;
    private $width = 600;
    private $title = "label";
    private $labels = array();
    private $ylabel = "-";
    private $xlabel = "-";
    private $data = array();
    private $scale = "textint";
    private $graph;
    private $font = FF_ARIAL;

    public function __construct($height, $width, $type, $title, $xlabel, $ylabel, $row_labels, $row_data)
    {
        // SIZE
        $this->height = $height;
        $this->width = $width;

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

        $this->createGraph($this->type, $this->data);
    }

    private function checkData($chartData){
        foreach ($chartData as $data) {
            if($data > 0){
                return false;
            }
        }
        return true;
    }

    public function getHeight(): int
    {
        if (!$this->height) {
            $this->height = 300;
        }
        return $this->height;
    }
    public function getWidth(): int
    {
        if (!$this->width) {
            $this->width = 600;
        }
        return $this->width;
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

    private function createGraph($type, $data)
    {
        if($this->checkData($data)){
            $type = "bar";
        }

        switch ($type){
            case "pie" : $this->createPiePlot($data);break;
            case "pie3d" : $this->create3dPiePlot($data);break;
            default : $this->createBarPlot($data);break;
        }

        $this->setGraphTitle($this->title);
        $this->graph->SetMargin(60, 70, 50, 50);
    }

    private function setGraphTitle($title){
            // TITLE
        $this->graph->title->Set($title);
        $this->graph->title->SetFont($this->font,FS_BOLD);
    }

    private function setYaxisGraph(){
        $this->graph->yaxis->title->Set($this->ylabel);
        $this->graph->yaxis->title->SetFont($this->font,FS_BOLD);
        $this->graph->yaxis->scale->SetGrace(10);
    }
    private function setXaxisGraph(){
        $this->graph->xaxis->title->Set($this->xlabel);
        $this->graph->xaxis->title->SetFont($this->font,FS_BOLD);
        //LABELS
        $this->graph->xaxis->SetTickLabels($this->labels);
    }

    private function createBarPlot($data){
        $this->graph = new Graph($this->getWidth(), $this->getHeight(), 'auto');
        // SETTINGS
        $this->graph->SetScale($this->scale);
        $this->graph->SetShadow();
        $this->graph->SetFrame(false);



        $this->setYaxisGraph();
        $this->setXaxisGraph();

        // BAR
        $bplot = new BarPlot($data);
        $bplot->SetFillColor('orange');
        $bplot->SetWidth(0.8);
        $bplot->SetShadow();

         // VALUE
        $bplot->value->Show();
        $bplot->value->SetFont($this->font,FS_BOLD);
        $bplot->value->SetAngle(45);
        $bplot->value->SetColor('green','darkred');

        $this->graph->Add($bplot);
    }
    private function createPiePlot($data){
        // Create the Pie Graph.
        $this->graph = new PieGraph($this->getWidth(),$this->getHeight());
        $this->graph->SetBox(true);



        $p1 = new PiePlot($data);
        $this->graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');


        // COLORS
        //$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));

        $legends = $this->labels;
        $p1->SetLegends($legends);

    }
    private function create3dPiePlot($data){
        // Create the Pie Graph.
        $this->graph = new PieGraph($this->getWidth(),$this->getHeight());

        $theme_class= new VividTheme;
        $this->graph->SetTheme($theme_class);



        $p1 = new PiePlot3D($data);
        $this->graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->ExplodeSlice(1);

        // COLORS
        //$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));

        $legends = $this->labels;
        $p1->SetLegends($legends);

    }


    // Display Chart
    public function showImage(){
        $this->graph->Stroke();
    }
}
