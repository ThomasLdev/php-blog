<?php

use OC\Blog\Model\PostManager;
require_once('../src/manager/PostManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('../template/view/frontend/listPostsView.php');
}

function showPost()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
    require('../template/view/frontend/postView.php');
}