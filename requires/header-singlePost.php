<header class="masthead" style="background-image: url('../public/img/header-single.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <div class="post-heading">
                    <h1><?= $post['title']?></h1>
                    <h2 class="subheading">Category : <?= $post['category']?></h2>
                    <span class="meta">Posté par
              <a href="#"><?= $post['author_id']?></a>
              on <?= $post['created_at'] ?></span>
                    <span class="meta mt-4">
                        <a href="../public/index.php">
                        Retour à la liste des articles
                    </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
