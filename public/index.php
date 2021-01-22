<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Controller\AdminController;
use App\Controller\FrontendController;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

$loader = new FilesystemLoader(__DIR__ .'/../templates');
$twig = new Environment($loader,[
'debug' => true]);
$twig->addExtension(new DebugExtension());

$twig->addGlobal('appUser', isset($_SESSION['user']) ? $_SESSION['user'] : null);

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$postManager = new PostManager($pdo);
$commentManager = new CommentManager($pdo);
$userManager = new UserManager($pdo);

$frontController = new FrontendController($twig, $postManager, $commentManager, $userManager);
$adminController = new AdminController($twig, $postManager, $commentManager);

//var_dump($_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_URI'] === '/') {
    $frontController->listPosts();
} elseif (preg_match('/^\/post\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
    //print_r($matches);
    $postId = (int)$matches[1];
    $frontController->showPost($postId);
} elseif ($_SERVER['REQUEST_URI'] === '/cv') {
    echo $twig->render('cv.html.twig');
} elseif ($_SERVER['REQUEST_URI'] === '/contact') {
    echo $twig->render('contact.html.twig');
} elseif ($_SERVER['REQUEST_URI'] === '/contact/thank-you') {
    echo $twig->render('contact-ty.html.twig');
} elseif ($_SERVER['REQUEST_URI'] === '/admin') {
    $adminController->showAdmin();
} elseif ($_SERVER['REQUEST_URI'] === '/admin/create/post') {
    $adminController->createPost();
} elseif ($_SERVER['REQUEST_URI'] === '/admin/manage/post') {
    $adminController->managePost();
} elseif (preg_match('/^admin\/modify\/post\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
    $postId = (int)$matches[1];
    $adminController->modifyPost($postId);
} elseif (preg_match('/^admin\/delete\/post\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
    $postId = (int)$matches[1];
    $adminController->deletePost($postId);
} elseif (preg_match('/^admin\/\/delete\/comment\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
    $postId = (int)$matches[1];
    $adminController->deleteComment($postId);
} elseif (preg_match('/^admin\/\/validate\/comment\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches)) {
    $postId = (int)$matches[1];
    $adminController->validateComment($postId);
} elseif ($_SERVER['REQUEST_URI'] === '/admin/manage/comment') {
    $adminController->manageComment();
} elseif ($_SERVER['REQUEST_URI'] === '/register') {
    $frontController->register();
} elseif ($_SERVER['REQUEST_URI'] === '/login') {
    $frontController->login();
} elseif ($_SERVER['REQUEST_URI'] === '/logout') {
    $frontController->logout();
} else {
    echo $twig->render('404.html.twig');
}

/*$action = isset($_GET['action']) ? $_GET['action'] : null;
    switch ($action) {
        case "listPosts":
            $frontController->listPosts(); // OK
            break;
        case "showPost" :
            $frontController->showPost($_GET['id']); // OK
            break;
        case "showAdmin":
            $adminController->showAdmin(); // OK
            break;
        case "createPost":
            $adminController->createPost(); // OK
            break;
        case "managePost":
            $adminController->managePost(); // OK
            break;
        case "modifyPost": // OK
            $postId = $_GET['id'];
            $adminController->modifyPost($postId); // OK
            break;
        case "deletePost":
            $postId = $_GET['id'];
            $adminController->deletePost($postId); // OK
            break;
        case "deleteComment":
            $commentId = $_GET['id'];
            $adminController->deleteComment($commentId); // OK
            break;
        case "validateComment":
            $commentId = $_GET['id'];
            $adminController->validateComment($commentId); // OK
            break;
        case "manageComment":
            $adminController->manageComment(); // OK
            break;
        case "register":
            $frontController->register(); // OK
            break;
        case "login":
            $frontController->login(); // OK
            break;
        case "logout":
            $frontController->logout(); // OK
            break;
        case "contact":
            $frontController->contact(); // OK
            break;
        case "contactTy":
            echo $twig->render('contact-ty.html.twig'); // OK
            break;
        case "cv":
            echo $twig->render('cv.html.twig'); // OK
            break;
        default:
            echo $twig->render('404.html.twig'); // OK
    }*/