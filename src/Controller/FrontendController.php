<?php

Namespace App\Controller;
use App\Manager\PostManager;

class FrontendController
{
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
}

