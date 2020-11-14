<?php

namespace App\Manager;
use App\Entity\Post;

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->connectDB();
        return $db->query('SELECT * FROM posts p JOIN user u ON p.author_id = u.id ORDER BY created_at DESC LIMIT 0, 5');
    }

    public function getPost($postId)
    {
        $db = $this->connectDB();
        $singlePostRequest = $db->prepare('SELECT * FROM posts WHERE id = ?');
        $singlePostRequest->execute(array($postId));
        return $singlePostRequest->fetch();
    }

    public function hydratePost($postSql){

    }
}

