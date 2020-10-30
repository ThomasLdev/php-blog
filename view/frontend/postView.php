<?php

require ('requires/head.php');
require ('requires/header-nav.php');
require ('requires/header-singlePost.php');
?>

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>
                <?= $post['content']?>
            </p>
        </div>
      </div>
    </div>
  </article>