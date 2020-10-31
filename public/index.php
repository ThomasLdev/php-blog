<?php

require('controller/frontend.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts'){
        listPosts();
    }
    elseif ($_GET['action'] === 'showPost') {
        showPost();
    }
    else {
        echo 'Post ID is uncorrect. Please don\'t change any value directly in the address bar;';
    }
} else {
    listPosts();
}