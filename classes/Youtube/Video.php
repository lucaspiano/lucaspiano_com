<?php

class Video
{
    private $id;
    private $viewCount;
    private $viewCountInt;
    private $code;

    /**
     * @var Comment[]
     */
    private $comments;

    public function __construct($id, $viewCount, $viewCountInt, $code, $comments = [])
    {
        $this->id = $id;
        $this->viewCount = $viewCount;
        $this->viewCountInt = number_format(intval($viewCountInt),0,",",".");
        $this->comments = $comments;
        $this->code = $code;
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

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}