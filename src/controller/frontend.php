<?php

require('../model/frontend.php');

function listPosts()
{
    $posts = getPosts();
    require('../template/view/frontend/listPostsView.php');
}

function showPost()
{
    $post = getPost($_GET['id']);
    require('../template/view/frontend/postView.php');
}