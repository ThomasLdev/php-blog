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
    private PostManager $postManager;

    public function __construct(\Twig\Environment $twig, PostManager $postManager)
    {
        $this->twig = $twig;
        $this->postManager = $postManager;
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
            $createdPost->setAuthor(1);
            $createdPost->setCreatedAt(new \DateTime());
            $createdPost->setUpdatedAt(new \DateTime());
            $this->postManager->savePost($createdPost);
            header('Location: index.php?action=showAdmin');

        }
        echo $this->twig->render('create-post.html.twig');
    }

    public function managePost()
    {
        $allPosts = $this->postManager->getPosts();
        echo $this->twig->render('manage-post.html.twig', ['allPosts' => $allPosts]);
    }

    public function modifyPost(int $postId)
    {
        $post = $this->postManager->getPost($postId);

        if ($_POST) {
            $post->setTitle($_POST['post-title']);
            $post->setThumbnail($_POST['post-thumbnail']);
            $post->setCategory($_POST['post-category']);
            $post->setContent($_POST['post-content']);
            $post->setAuthor(1);
            $post->setUpdatedAt(new \DateTime());
            $this->postManager->savePost($post);
        }
            echo $this->twig->render('modify-post.html.twig', ['post' => $post]);
    }

    public function deletePost(int $postId)
    {
        $this->postManager->deletePost($postId);
        header('Location: index.php?action=managePost');
    }
}