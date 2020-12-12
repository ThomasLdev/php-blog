<?php

Namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use Twig\Environment;

class FrontendController
{
    private Environment $twig;
    private PostManager $postManager;
    private CommentManager $commentManager;

    public function __construct(Environment $twig, PostManager $postManager, CommentManager $commentManager)
    {
        $this->twig = $twig;
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts(PostManager::POST_LIMIT);
        echo $this->twig->render('home.html.twig', ['posts' => $posts]);
    }

    public function showPost(int $postId)
    {
        $post = $this->postManager->getPost($postId);
        $comments = $this->commentManager->getPostComments($post);
        echo $this->twig->render('post.html.twig', ['post' => $post, 'comments' => $comments], );
    }
}