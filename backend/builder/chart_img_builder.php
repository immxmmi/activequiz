<?php

class chart_img_builder
{

    public $height = 250;
    public $weight = 350;
    private $title = "label";
    private $scale = "intlin";
    private $labels = array();
    private $data = array();


    public function __construct($height,$weight,$label,$row_data,$row_labels)
    {
        $this->height = $height;
        if (!$this->height) {
            $this->height = 250;
        }

        $this->weight = $weight;
        if (!$this->weight) {
            $this->weight = 350;
        }

        $this->title = $label;
        $this->setLabels($row_labels);
        $this->setData($row_data);

    }





    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param array $labels
     */
    public function setLabels($row_labels)
    {
        $row_labels = explode("',' ", $row_labels);
        foreach ($row_labels as $val) {
            array_push($this->labels,trim($val,'\''));
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($row_data)
    {
        $row_data = explode(",", $row_data);
        foreach ($row_data as $val) {
            array_push($this->data,(int)$val);
        }
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getScale(): string
    {
        return $this->scale;
    }








}
