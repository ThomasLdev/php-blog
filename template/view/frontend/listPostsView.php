<?php
require('requires/head.php');
require('requires/header-nav.php');
require('requires/header.php');
?>
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

<?php while ($data = $posts->fetch())
{
    ?>
    <div class="post-preview">
        <a href="../../../public/index.php?action=showPost&amp;id=<?= $data['id'] ?>">
            <h2 class="post-title">
                <?= htmlspecialchars($data['title']) ?>
            </h2>
        </a>
        <p>
            <?= htmlspecialchars(substr($data['content'], 0, 100)) ?>...
            <a href="../../../public/index.php?action=showPost&amp;id=<?= $data['id'] ?>">En lire plus</a>
        </p>
        <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on <em> <?= $data['created_at'] ?></em></p>
    </div>
    <?php
} ?>
     </div>
    </div>
  </div>

<?php $posts->closeCursor();
require('requires/footer.php');
?>