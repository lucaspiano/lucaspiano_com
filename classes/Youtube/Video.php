<?php

class Video
{
    private $id;
    private $viewCount;
    private $viewCountInt;

    public function __construct($id, $viewCount, $viewCountInt)
    {
        $this->id = $id;
        $this->viewCount = $viewCount;
        $this->viewCountInt = number_format(intval($viewCountInt),0,",",".");
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @return string
     */
    public function getViewCountInt()
    {
        return $this->viewCountInt;
    }
}