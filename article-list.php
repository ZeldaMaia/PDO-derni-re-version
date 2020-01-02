<?php require_once('include/functions.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<?php

$titre_page = 'Liste des articles';

// Récupération des articles.
$articles = get_articles();

include('include/head.php');
?>

<body>

  <?php require_once('include/admin-panel.php'); ?>
  <h1 class="display-1 py-5 my-5 text-center text-secondary">Articles</h1>

  <div class="container">

    <?php include('include/article-pagination.php'); ?>

    <a href="article-create.php" class="btn btn-outline-success mb-4"><i class="fa fa-plus pr-2" aria-hidden="true"></i></i>Ajouter un article</a>
    <?php foreach ($articles as $article) : ?>
      <article class="shadow rounded border p-4 mb-5">
        <div class="row">
          <div class="col-3">
            <img src="<?php echo 'images/thumbnails/'.$article['img_url']; ?>" class="img-fluid" alt="" srcset="">
            <!-- <img src="<?php echo get_img_src($article['img_url']); ?>"  -->
      
          </div>
          <div class="col-9">
            <h2 class="text-primary text-uppercase"><a href="<?php echo 'article.php?id='.$article['id']; ?>"><?php echo $article['titre']; ?></a></h2>
            <?php $tags = get_tags($article['id']); ?>
            <?php foreach ($tags as $tag) : ?>
              <span class="badge badge-primary"><?php echo $tag['nom']; ?></span>
            <?php endforeach ?>
            <p class="text-justify">
              <?php
                $teaser = strlen($article['corps']) > 320 ? substr($article['corps'], 0, 320) . "..." : $article['corps'];
                echo $teaser;
              ?>
            </p>
            <hr>
          </div>

        </div>
        <footer class="d-flex justify-content-between align-items-center">
          <div class="d-flex">
            <a href="article-edit.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-primary"><i class="fa fa-pencil pr-2" aria-hidden="true"></i>Éditer</a>
            <?php if (is_admin()) : ?>
              <a href="delete-article.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-danger ml-2"><i class="fa fa-times pr-2" aria-hidden="true"></i>Supprimer</a>
            <?php endif; ?>
          </div>
          <div class="d-flex">
            <h6 class="text-muted pr-4"><i class="fa fa-user pr-2" aria-hidden="true"></i><?php echo $article['prenom'] . ' ' . $article['nom']; ?></h6>
            <h6 class="text-muted"><i class="fa fa-calendar pr-2" aria-hidden="true"></i><?php echo $article['date']; ?></h6>
          </div>
        </footer>
      </article>
    <?php endforeach; ?>

  </div>

  <?php include('include/footer.php'); ?>
</body>

</html>
