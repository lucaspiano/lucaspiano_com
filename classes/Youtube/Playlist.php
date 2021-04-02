<?php

class PlayList
{
    private $id;
    private $title;
    private $total;
    private $thumbnail;

    public function __construct($id, $title, $total, $thumbnail)
    {
        $this->id = $id;
        $this->title = $title;
        $this->total = $total;
        $this->thumbnail = $thumbnail;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}