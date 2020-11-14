<?php

Namespace App\Entity;

class Post extends Manager
{
    private ?int $id = null;
    private ?string $author = null;
    private ?string $title = null;
    private ?\DateTime $created_at = null;
    private ?\DateTime $updated_at = null;
    private ?string $category = null;
    private ?string $content = null;

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

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getContent(): ?string
    {
        return $this->content;
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

    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}