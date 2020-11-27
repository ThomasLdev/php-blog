<?php

Namespace App\Controller;
use App\Manager\PostManager;
use App\Entity\Post;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AdminController
{
    private \Twig\Environment $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    public function showAdmin()
    {
        try {
            echo $this->twig->render('admin.html.twig');
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function createPost()
    {
        if ($_POST) {
            $createdPost = new Post();
            $createdPost->setTitle($_POST['post-title']);
            $createdPost->setThumbnail($_POST['post-thumbnail']);
            $createdPost->setCategory($_POST['post-category']);
            $createdPost->setContent($_POST['post-content']);
            $createdPost->setAuthor($_POST['post-author']);
            //$createdPost->setCreatedAt((new \DateTime($_POST['post_date'])));
            //Transmission au PostManager qui va envoyer en base
        }
        else {
            try {
                echo $this->twig->render('create-post.html.twig');
            } catch (LoaderError $e) {
            } catch (RuntimeError $e) {
            } catch (SyntaxError $e) {
            }
        }

        //header(article crée)

    }
}