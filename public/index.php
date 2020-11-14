<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Controller\FrontendController;

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts'){
        $posts = new FrontendController();
        $posts->listPosts();
    }
    elseif ($_GET['action'] === 'showPost') {
        $post = new FrontendController();
        $post->showPost();
    }
    else {
        echo 'Post ID is uncorrect. Please don\'t change any value directly in the address bar;';
    }
} else {
    $posts = new FrontendController();
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
        header("../template/view/fronted/404.twig");
}*/