<?php

namespace App\Manager;
use App\Entity\Post;

class PostManager extends Manager
{
    public function getPosts(): array
    {
        $lastPostsRequest = $this->pdo->query('
        SELECT     p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content",
                   p.thumbnail "post_thumbnail",
                   u.first_name "post_author"
                   FROM posts p
                   JOIN user u on p.author_id = u.id
                   ORDER BY p.created_at DESC LIMIT 0, 5;
        ');
        $postsSQL = $lastPostsRequest->fetchAll();
        $posts = [];
        foreach ($postsSQL as $postSQL)
        {
            $posts[] = $this->hydratePost($postSQL);
        }
        return $posts;
    }

    public function getPost(int $postId): Post
    {
        $singlePostRequest = $this->pdo->prepare('
            SELECT p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content",
                   p.thumbnail "post_thumbnail",
                   u.first_name "post_author"
                   FROM posts p
                   JOIN user u on p.author_id = u.id
                   WHERE p.id = :id');
        $singlePostRequest->execute(array('id' => $postId));
        $postSql = $singlePostRequest->fetch();
        return $this->hydratePost($postSql);
    }

    public function savePost(Post $post)
    {
        $sendPostRequest = $this->pdo->prepare('
        INSERT INTO posts (author_id, title, created_at, updated_at, category, content, thumbnail) VALUES (:authorId, :title, :createdAt, :updatedAt, :category, :content, :thumbnail)
        ');
        $sendPostRequest->execute([
            'authorId' => $post->getAuthor(),
            'title' => $post->getTitle(),
            'createdAt' => $post->getCreatedAt()->format('Y-m-d h:i:s'),
            'updatedAt' => $post->getUpdatedAt()->format('Y-m-d h:i:s'),
            'category' => $post->getCategory(),
            'content' => $post->getContent(),
            'thumbnail' => $post->getThumbnail()
        ]);
    }

    private function hydratePost(array $postSQL): Post
    {
        $post = new Post();
        $post->setId($postSQL['post_id']);
        $post->setAuthor($postSQL['post_author']);
        $post->setTitle($postSQL['post_title']);
        $post->setCreatedAt((new \DateTime($postSQL['post_date'])));
        $post->setUpdatedAt((new \DateTime($postSQL['post_update'])));
        $post->setCategory($postSQL['post_category']);
        $post->setContent($postSQL['post_content']);
        $post->setThumbnail($postSQL['post_thumbnail']);
        return $post;
    }
}

