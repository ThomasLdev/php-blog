<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Controller\FrontendController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ .'/../templates');
$twig = new Environment($loader);

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts'){
        $posts = new FrontendController($twig);
        $posts->listPosts();
    }
    elseif ($_GET['action'] === 'showPost') {
        $post = new FrontendController($twig);
        $post->showPost();
    }
    else {
        echo 'Post ID is uncorrect. Please don\'t change any value directly in the address bar;';
    }
} else {
    $posts = new FrontendController($twig);
    $posts->listPosts();
}

//Refacto en switch case
/*switch ($_GET['action']) {
    case "home":
        $posts = new FrontendController($twig);
        $posts->listPosts();
        break;
    case "showPost" :
        $post = new FrontendController($twig);
        $post->showPost();
        break;
    default:
        $posts = new FrontendController($twig);
        $posts->listPosts();
}*/