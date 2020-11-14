<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Controller\FrontendController;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'/../templates');
$twig = new \Twig\Environment($loader);

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

/*switch ($_GET['action']) {
    case "home":
        listPosts();
        break;
    case "post" :
        showPost();
        break;
    default:
        header("../templates/view/fronted/404.twig");
}*/