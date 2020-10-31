<?php

function connectDB()
{
    try {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
}

function getPosts()
{
    $db = connectDB();
    return $db->query('SELECT * FROM posts p JOIN user u ON p.author_id = u.id ORDER BY created_at DESC LIMIT 0, 5');
}

function getPost($postId)
{
    $db = connectDB();
    $singlePostRequest = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $singlePostRequest->execute(array($postId));
    return $singlePostRequest->fetch();
}