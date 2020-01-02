<?php
require_once('include/functions.php');

$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mot_de_passe = filter_input(INPUT_POST, 'mot_de_passe', FILTER_SANITIZE_STRING);

$erreur_msg = FALSE;
if ($pseudo && $mot_de_passe) {
  if ($admin = get_administrateur($pseudo)) {
    //Vérification du mot de passe.
    if (password_verify($mot_de_passe, $admin['mot_de_passe'])) {
      //Initialisation de la session!
      init_admin_session($admin);
      header('Location: article-list.php');
      //+ redirection
    } else {
      $erreur_msg = 'Mot de passe incorrect.';
    }
  } else {
    $erreur_msg = 'Pseudonyme incorrect.';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php
$titre_page = "Login";
include('include/head.php');
?>

<body>
  <?php require_once('include/admin-panel.php'); ?>
  <h1 class="display-1 py-5 my-5 text-center text-secondary">Connexion</h1>

  <div class="container py-5 mb-5">


    <!-- Formulaire de connexion. -->
    <form action="" method="post" class="shadow p-5 my-5 rounded border w-50 mx-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="article-list.php"><i class="fa fa-home" aria-hidden="true"></i> </a></li>
          <li class="breadcrumb-item active" aria-current="page">Connexion</li>
        </ol>
      </nav>

      <?php if ($erreur_msg) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
          <?php echo $erreur_msg; ?>
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
        <small class="form-text text-muted">Pseudo de l'utilisateur</small>
      </div>
      <div class="form-group">
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
      </div>


      <button type="submit" class="btn btn-primary btn-large">Connexion</button>
    </form>
  </div>

  <?php include('include/footer.php'); ?>
</body>

</html>
