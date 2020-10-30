<?php

function connectDB()
{
    try {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getPostAuthor()
{
    $db = connectDB();
    $authorRequest = $db->query('SELECT posts.author_id, user.first_name FROM posts INNER JOIN users ON post.author_id = user.first_name');
    return $authorRequest;
}

function getPosts()
{
    $db = connectDB();
    $postsRequest = $db->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 0, 5');
    //$postsRequest = $db->query('SELECT posts.author_id, user.first_name FROM posts INNER JOIN users ON post.author_id = user.first_name ORDER BY created_at DESC LIMIT 0, 5');
    return $postsRequest;
}

function getPost($postId)
{
    $db = connectDB();
    $singlePostRequest= $db->prepare('SELECT * FROM posts WHERE id = ?');
    $singlePostRequest->execute(array($postId));
    $singlePost = $singlePostRequest->fetch();
    return $singlePost;
}