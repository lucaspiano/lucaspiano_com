<?php

class Video
{
    private $id;
    private $viewCount;
    private $viewCountInt;

    /**
     * @var Comment[]
     */
    private $comments;

    public function __construct($id, $viewCount, $viewCountInt, $comments = [])
    {
        $this->id = $id;
        $this->viewCount = $viewCount;
        $this->viewCountInt = number_format(intval($viewCountInt),0,",",".");
        $this->comments = $comments;
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

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }
}