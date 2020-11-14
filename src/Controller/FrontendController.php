<?php

Namespace App\Controller;
use App\Manager\PostManager;

class FrontendController
{
    private \Twig\Environment $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    public function listPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        echo $this->twig->render('home.twig', ['posts'=>$posts]);
        //require('../templates/view/frontend/listPostsView.php');
    }

    public function showPost()
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        echo $this->twig->render('post.twig', ['post'=>$post]);
        //require('../templates/view/frontend/postView.php');
    }
}

