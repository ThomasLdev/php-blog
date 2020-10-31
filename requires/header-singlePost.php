<header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?= $post['title']?></h1>
                    <h2 class="subheading">Category : <?= $post['category']?></h2>
                    <span class="meta">Posted by
              <a href="#">Start Bootstrap</a>
              on <?= $post['created_at'] ?></span>
                    <span class="meta mt-3">
                        <a href="../public/index.php">
                        Return to post list
                    </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
