<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\AdminController;
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
    elseif ($_GET['action'] === 'showAdmin') {
        $admin = new AdminController($twig);
        $admin->showAdmin();
    }
    else {
        echo 'Post ID is uncorrect. Please don\'t change any value directly in the address bar;';
    }
} else {
    $posts = new FrontendController($twig);
    $posts->listPosts();
}

//Refacto en switch case, erreur sur l'action à régler ligne 29, mais ça marche quand même
    /*switch ($_GET['action']) {
        case "listPosts":
            $posts = new FrontendController($twig);
            $posts->listPosts();
            break;
        case "showPost" :
            $post = new FrontendController($twig);
            $post->showPost();
            break;
        case "adminPanel":
            $admin = new AdminController($twig);
        default:
            $posts = new FrontendController($twig);
            $posts->listPosts();
    }*/