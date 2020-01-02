<?php

require_once('include/functions.php');

redirect_if_not_admin();
?>

<!DOCTYPE html>
<html lang="en">

<?php
$titre_page = "Édition d'un article";
require_once('include/head.php');
?>

<body>

  <?php require_once('include/admin-panel.php'); ?>
  <h1 class="display-1 py-5 my-5 text-center text-secondary">Création d'un article</h1>

  <div class="container py-5 mb-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="article-list.php">Liste</a></li>
        <li class="breadcrumb-item active" aria-current="page">Création</li>
      </ol>
    </nav>

    <!-- Formulaire de création de l'article. -->
    <form action="create-article.php" method="post" enctype="multipart/form-data" class="shadow p-5 my-5 rounded border w-50 mx-auto">
      <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre">
        <small class="form-text text-muted">Titre de l'article</small>
      </div>
      <div class="form-group">
        <label for="corps">Contenu</label>
        <textarea class="form-control" id="corps" name="corps" rows="3"></textarea>
        <small class="form-text text-muted">Contenu de l'article</small>
      </div>
      <div class="form-group">
        <label for="corps">Date de création</label>
        <input type="date" class="form-control" id="date" name="date" value="2019-12-17">
      </div>

      <!-- Choix de l'auteur. -->
      <?php
      $list_auteurs = get_auteurs($dbh);
      ?>
      <div class="form-group">
        <label for="auteur_id">Auteur:</label>
        <select name="auteur_id" id="auteur_id" class="form-control">
          <?php foreach ($list_auteurs as $auteur) : ?>
            <option value="<?php echo $auteur['id']; ?>"><?php echo $auteur['prenom'] . ' ' . $auteur['nom']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- fin du choix des auteurs -->

      <!-- Ajout d'une image -->
      <div class="form-group">
        <img src="<?php echo get_img_src(); ?>" class="img-fluid">
        <input type="file" class="form-control-file py-2" id="image" name="image">
      </div>


      <button type="submit" class="btn btn-primary">Créer</button>
    </form>
  </div>

  <?php include('include/footer.php'); ?>
</body>

</html>
