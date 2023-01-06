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
            array_push($this->labels, trim($val, '\''));
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
            array_push($this->data, (int)$val);
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getYlabel(): string
    {
        return $this->ylabel;
    }

    /**
     * @return string
     */
    public function getXlabel(): string
    {
        return $this->xlabel;
    }


}
