<?php

class Comment
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var int
     */
    private $likes;

    /**
     * @var DateTimeInterface
     */
    private $publishedAt;

    public function __construct($id, $comment, $author, $avatar, $likes, $publishedAt)
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->author = $author;
        $this->avatar = $avatar;
        $this->likes = (int)$likes;
        $this->publishedAt = new DateTimeImmutable($publishedAt);
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return DateTimeInterface
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }
}