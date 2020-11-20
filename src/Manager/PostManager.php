<?php

namespace App\Manager;
use App\Entity\Post;

class PostManager extends Manager
{
    public function getPosts(): array
    {
        $db = $this->connectDB();
        $lastPostsRequest = $db->query('
        SELECT p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content"
                   FROM posts p 
                   ORDER BY created_at DESC LIMIT 0, 5;
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
        $db = $this->connectDB();
        $singlePostRequest = $db->prepare('
            SELECT p.id "post_id",
                   p.title "post_title",
                   p.created_at "post_date",
                   p.updated_at "post_update",
                   p.category "post_category",
                   p.content "post_content"
                   FROM posts p 
                   WHERE id = ?');
        $singlePostRequest->execute(array($postId));
        $postSql = $singlePostRequest->fetch();
        return $this->hydratePost($postSql);
    }

    private function hydratePost(array $postSQL): Post
    {
        $post = new Post();
        $post->setId($postSQL['post_id']);
        //$post->setAuthor($postSQL['post_author']);
        $post->setTitle($postSQL['post_title']);
        $post->setCreatedAt((new \DateTime($postSQL['post_date'])));
        $post->setUpdatedAt((new \DateTime($postSQL['post_update'])));
        $post->setCategory($postSQL['post_category']);
        $post->setContent($postSQL['post_content']);
        //var_dump($post); die();
        return $post;
    }
}
