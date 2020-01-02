<?php

require_once('include/functions.php');

$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING) ?? 'Article sans titre';
$corps = filter_input(INPUT_POST, 'corps', FILTER_SANITIZE_STRING) ?? ' -- ';
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING) ?? '';
$auteur = filter_input(INPUT_POST, 'auteur_id', FILTER_SANITIZE_NUMBER_INT) ?? '';

if (!empty($_FILES['image']['name'])) {
  $file_name = $_FILES['image']['name'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $img_url = 'images/' . $file_name;
  move_uploaded_file($file_tmp, $img_url);
}
else{
  $img_url = '';
}

//On créé un tableau avec ces variables.
$params = [
  'titre' => $titre,
  'corps' => $corps,
  'date' => $date,
  'auteur_id' => $auteur,
  'img_url' => $img_url
];

//Execution de la requête de mise à jour.
$result = create_article($params);

header("Location: article-list.php");
