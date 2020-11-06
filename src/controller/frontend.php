<?php

require('model/frontend.php');

function listPosts()
{
    $posts = getPosts();
    require('view/frontend/listPostsView.php');
}

function showPost()
{
    $post = getPost($_GET['id']);
    require('view/frontend/postView.php');
}