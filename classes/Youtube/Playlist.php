<?php

class PlayList
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $total;

    /**
     * @var string
     */
    private $thumbnail;

    /**
     * @var array
     */
    private $videosCode;

    public function __construct($id, $title, $total, $videosCode, $thumbnail)
    {
        $this->id = $id;
        $this->title = $title;
        $this->total = $total;
        $this->thumbnail = $thumbnail;
        $this->videosCode = $videosCode;
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

    /**
     * @return array
     */
    public function getVideosCode()
    {
        return $this->videosCode;
    }
}