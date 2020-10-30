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

function getPosts()
{
    $db = connectDB();
    $postsRequest = $db->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 0, 5');
    return $postsRequest;
}