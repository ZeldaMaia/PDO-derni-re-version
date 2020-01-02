<?php

require_once('include/functions.php');

$article_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) ?? 0;

/**
 * Récupération des détails d'un seul article.
 *
 * @param INT $article_id
 *
 * @return mixed array or false
 */
function get_article($article_id)
{
  global $dbh;
  $query = 'SELECT article.titre, article.corps,  DATE_FORMAT(article.date, "%Y-%m-%d") AS date, img_url,
  auteur.nom, auteur.prenom
  FROM article
  JOIN auteur ON article.auteur_id = auteur.id
  WHERE article.id = :article_id';

  $req = $dbh->prepare($query);
  $params = [
    'article_id' => $article_id
  ];
  //Éxecution de la requête.
  $req->execute($params);

  $article = $req->fetch(PDO::FETCH_ASSOC);
  return $article;
}

?>

