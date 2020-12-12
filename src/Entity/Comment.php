<?php

Namespace App\Entity;

use DateTime;

class Comment
{
    private ?int $id = null;
    private ?int $post_id = null;
    private ?int $author_comment_id = null;
    private ?string $title = null;
    private ?DateTime $created_at = null;
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public function getAuthorCommentId(): ?int
    {
        return $this->author_comment_id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setPostId(int $post_id)
    {
        $this->post_id = $post_id;
    }

    public function setAuthorCommentId(int $author_comment_id)
    {
        $this->author_comment_id = $author_comment_id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}