<?php

Namespace App\Entity;

use DateTime;

class Comment
{
    private ?int $id = null;
    private ?int $post_id = null;
    private ?int $author_comment = null;
    private ?DateTime $created_at = null;
    private ?string $content = null;
    private ?int $status = 0;

    public function __construct()
    {
        $this->created_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public function getAuthorComment(): ?int
    {
        return $this->author_comment;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setPostId(int $post_id)
    {
        $this->post_id = $post_id;
    }

    public function setAuthorComment(int $author_comment)
    {
        $this->author_comment = $author_comment;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }
}