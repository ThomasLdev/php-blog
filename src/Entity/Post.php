<?php

Namespace App\Entity;

use DateTime;

class Post
{
    private ?int $id = null;
    private ?string $author = null;
    private ?string $title = null;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;
    private ?string $category = null;
    private ?string $content = null;
    private ?string $thumbnail = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setThumbnail(string $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }
}