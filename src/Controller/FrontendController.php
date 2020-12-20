<?php

Namespace App\Controller;
use App\Manager\PostManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontendController
{
    private \Twig\Environment $twig;

    private PostManager $postManager;

    public function __construct(\Twig\Environment $twig, PostManager $postManager)
    {
        $this->twig = $twig;
        $this->postManager = $postManager;
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts(PostManager::POST_LIMIT);
        echo $this->twig->render('home.html.twig', ['posts' => $posts]);
    }

    public function showPost(int $postId)
    {
        $post = $this->postManager->getPost($postId);
        echo $this->twig->render('post.html.twig', ['post' => $post]);
    }
}

