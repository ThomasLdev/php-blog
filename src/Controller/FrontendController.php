<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use Twig\Environment;

class FrontendController extends Controller
{
    private PostManager $postManager;
    private CommentManager $commentManager;
    private UserManager $userManager;

    public function __construct(Environment $twig, PostManager $postManager, CommentManager $commentManager, UserManager $userManager)
    {
        parent::__construct($twig);
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
        if ($_POST) {
            $comment = new Comment();
            $comment->setAuthorComment($this->getUser()->getId());
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
            $user->setThumbnail("/img/avatars/default.png");
            $this->userManager->saveUser($user);
            header('Location: /');
        }
        echo $this->twig->render('register.html.twig');
    }

    public function login()
    {
        if ($_POST) {
            $userEmail = $_POST['user-email'];
            $userPassword = $_POST['user-password'];
            $user = $this->userManager->getUser($userEmail, $userPassword);
            if ($user != null) {
                $_SESSION['user'] = $user;
            }
            header('Location: /');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    public function contact()
    {
        if ($_POST) {

            $errors = '';
            $myEmail = 'contact@thomas-lefebvre.com';

            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
                return $errors . "\n Erreur: Tous les champs sont requis";
            }

            $name = $_POST['name'];
            $emailAddress = $_POST['email'];
            $message = $_POST['message'];
            $phone = $_POST['phone'];

            if (!preg_match(
                "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
                $emailAddress))
            {
                return $errors . "\n Erreur: mail invalide =)";
            }

            if( empty($errors)) {
                $to = $myEmail;
                $email_subject = "Message du blog de la part de : $name";
                $email_body = "$message - $phone";
                $headers = "De: $myEmail\n";
                $headers .= "Répondre à: $emailAddress";
                mail($to, $email_subject, $email_body, $headers);
                header('Location: /contact/thank-you');
            } else {
                return $errors;
            }
        }
        echo $this->twig->render('contact.html.twig');
    }
}