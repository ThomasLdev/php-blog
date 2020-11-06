<?php

namespace OC\Blog\Model;
require_once ('Manager.php');

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
}

