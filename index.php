<?php

require ('controller/frontend.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts'){
        listPosts();
    }
    elseif ($_GET['action'] === 'showPost') {
        showPost();
    }
    else {
        echo 'Aucun ID correct de post envoyé. Veuillez ne pas modifier les valeurs d\'actions en URL;';
    }
} else {
    listPosts();
}