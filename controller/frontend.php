<?php



require ('model/frontend.php');

function listPosts()
{
    $posts = getPosts();
    require ('view/frontend/listPostsView.php');
}