<?php

Namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use Twig\Environment;


class FrontendController extends Controller
{
    private Environment $twig;
    private PostManager $postManager;
    private CommentManager $commentManager;
    private UserManager $userManager;

    public function __construct(Environment $twig, PostManager $postManager, CommentManager $commentManager, UserManager $userManager)
    {
        $this->twig = $twig;
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
        $this->userManager = $userManager;
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts(PostManager::POST_LIMIT);
        echo $this->twig->render('home.html.twig', ['posts' => $posts]);
    }

    public function showPost(int $postId)
    {
        $post = $this->postManager->getPost($postId);
        if ($_POST)
        {
            $comment = new Comment();
            $comment->setAuthorComment(1);
            $comment->setContent($_POST['comment-message']);
            $comment->setPostId($post->getId());
            $this->commentManager->saveComment($comment);
        }
        $comments = $this->commentManager->getPostComments($post);
        echo $this->twig->render('post.html.twig', ['post' => $post, 'comments' => $comments]);
    }

    public function register()
    {
        if ($_POST) {
            $user = new User();
            $user->setFirstName(ucwords($_POST['first_name']));
            $user->setLastName(strtoupper($_POST['last_name']));
            $user->setEmail($_POST['email']);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->setThumbnail("../public/img/avatars/default.png");
            $this->userManager->saveUser($user);
            header('Location: index.php');
        }
        echo $this->twig->render('register.html.twig');
    }

    public function login()
    {
        if ($_POST)
        {
            $userEmail = $_POST['user-email'];
            $userPassword = $_POST['user-password'];
            $user = $this->userManager->getUser($userEmail, $userPassword);
            if ($user != null) {
                $_SESSION['id'] = $user->getId();
                $_SESSION['first_name'] = $user->getFirstName();
                $_SESSION['last_name'] = $user->getLastName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['password'] = $user->getPassword();
                $_SESSION['thumbnail'] = $user->getThumbnail();
                $_SESSION['admin'] = $user->getAdmin();
            }
            header('Location: index.php');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}