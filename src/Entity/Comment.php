<?php

Namespace App\Entity;

use DateTime;

class Comment
{
    private ?int $id = null;
    private ?int $postId = null;
    private ?string $authorComment = null;
    private ?DateTime $createdAt;
    private ?string $content = null;
    private ?int $status = 0;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function getAuthorComment(): ?string
    {
        return $this->authorComment;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
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

    public function setPostId(int $postId)
    {
        $this->postId = $postId;
    }

    public function setAuthorComment(string $authorComment)
    {
        $this->authorComment = $authorComment;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
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