<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\AdminController;
use App\Controller\FrontendController;
use App\Manager\PostManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ .'/../templates');
$twig = new Environment($loader);

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$postManager = new PostManager($pdo);

    $action = isset($_GET['action']) ? $_GET['action'] : null;
    switch ($action) {
        case "listPosts":
            $posts = new FrontendController($twig, $postManager);
            $posts->listPosts();
            break;
        case "showPost" :
            $post = new FrontendController($twig, $postManager);
            $post->showPost($_GET['id']);
            break;
        case "showAdmin":
            $admin = new AdminController($twig);
            $admin->showAdmin();
            break;
        case "createPost":
            $createPost = new AdminController($twig);
            $createPost->createPost();
            break;
        default:
            $posts = new FrontendController($twig, $postManager);
            $posts->listPosts();
    }