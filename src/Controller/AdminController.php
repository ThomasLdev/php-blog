<?php

Namespace App\Controller;
use App\Manager\PostManager;
use App\Entity\Post;
use App\Manager\CommentManager;
use DateTime;
use Twig\Environment;

class AdminController
{
    private Environment $twig;
    private PostManager $postManager;
    private CommentManager $commentManager;

    public function __construct(Environment $twig, PostManager $postManager, CommentManager $commentManager)
    {
        $this->twig = $twig;
        $this->postManager = $postManager;
        $this->commentManager= $commentManager;
    }

    public function showAdmin()
    {
        $allComments = $this->commentManager->getAllComments();
        $posts = $this->postManager->getPosts(PostManager::POST_LIMIT);
        $allPosts = $this->postManager->getPosts();
        echo $this->twig->render('admin.html.twig', ['posts' => $posts, 'allPosts' => $allPosts, '$allComments' => $allComments]);
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
            $post->setUpdatedAt(new DateTime());
            $this->postManager->savePost($post);
            header('Location: index.php?action=managePost');
        }
            echo $this->twig->render('modify-post.html.twig', ['post' => $post]);
    }

    public function deletePost(int $postId)
    {
        $this->postManager->deletePost($postId);
        header('Location: index.php?action=managePost');
    }
}