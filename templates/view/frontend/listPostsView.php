<?php
require('../requires/head.php');
require('../requires/header-nav.php');
require('../requires/header.php');

use App\Manager\PostManager;

?>
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

<?php


        /** @var \App\Entity\Post[] $posts */
        foreach ($posts as $post) {
            ?>
                <div class="post-preview">
        <a href="../public/index.php?action=showPost&amp;id=<?= $post->getId(); ?>">
            <h2 class="post-title">
                <?= htmlspecialchars($post->getTitle()); ?>
            </h2>
        </a>
        <p>
            <?= htmlspecialchars(substr($post->getContent(), 0, 100)) ?>...
            <a href="../public/index.php?action=showPost&amp;id=<?= $post->getId(); ?>">En lire plus</a>
        </p>
        <p class="post-meta">Publié par
            <a href="#"><?= $post->getAuthor(); ?></a>
            le <em> <?= $post->getCreatedAt()->format('d/m/Y'); ?></em></p>
    </div>
        <?php  }

?>
     </div>
    </div>
  </div>

<?php
require('../requires/footer.php');
?>