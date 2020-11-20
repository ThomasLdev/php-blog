<?php

Namespace App\Controller;
use App\Manager\PostManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
        try {
            echo $this->twig->render('home.html.twig', ['posts' => $posts]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function showPost()
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        try {
            echo $this->twig->render('post.html.twig', ['post' => $post]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}

