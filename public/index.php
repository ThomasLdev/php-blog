<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\AdminController;
use App\Controller\FrontendController;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

$loader = new FilesystemLoader(__DIR__ .'/../templates');
$twig = new Environment($loader,[
'debug' => true]);
$twig->addExtension(new DebugExtension());

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$postManager = new PostManager($pdo);
$commentManager = new CommentManager($pdo);

$frontController = new FrontendController($twig, $postManager, $commentManager);
$adminController = new AdminController($twig, $postManager, $commentManager);

    $action = isset($_GET['action']) ? $_GET['action'] : null;
    switch ($action) {
        case "listPosts":
            $frontController->listPosts();
            break;
        case "showPost" :
            $frontController->showPost($_GET['id']);
            break;
        case "showAdmin":
            $adminController->showAdmin();
            break;
        case "createPost":
            $adminController->createPost();
            break;
        case "managePost":
            $adminController->managePost();
            break;
        case "modifyPost":
            $postId = $_GET['id'];
            $adminController->modifyPost($postId);
            break;
        case "deletePost":
            $postId = $_GET['id'];
            $adminController->deletePost($postId);
            break;
        case "deleteComment":
            $commentId = $_GET['id'];
            $adminController->deleteComment($commentId);
            break;
        case "validateComment":
            $commentId = $_GET['id'];
            $adminController->validateComment($commentId);
        case "manageComment":
            $adminController->manageComment();
            break;
        default:
            $frontController->listPosts();
    }