<?php

require_once('include/functions.php');

//Récupération des variables issues de $_POST.
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) ?? 0;
$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING) ?? 'Article sans titre';
$corps = filter_input(INPUT_POST, 'corps', FILTER_SANITIZE_STRING) ?? ' -- ';
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING) ?? '';
$img_url = filter_input(INPUT_POST, 'current_image', FILTER_SANITIZE_STRING) ?? '';

$file_name = NULL;
if (!empty($_FILES['image']['name'])) {
  $file_name = $_FILES['image']['name'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $img_url = 'images/'.$file_name;
  move_uploaded_file($file_tmp, $img_url);
}

img_resize($img_url);
//On créé un tableau avec ces variables.
$params = [
  'id' => $id,
  'titre' => $titre,
  'corps' => $corps,
  'date' => $date,
  'img_url' => $file_name
];

//Execution de la requête de mise à jour.
$result = update_article($params);

if($result){
  $redirect_url = 'article-edit.php?id='.$params['id'].'&valid=1';
}
else {
  $redirect_url = 'article-edit.php?id='.$params['id'].'&valid=0';
}
header("Location: $redirect_url");
