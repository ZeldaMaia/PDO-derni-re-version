<?php

require_once('include/functions.php');

//Récupération de l'ID de l'article.
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) ?? 0;
$result = delete_article($id);

header("Location: article-list.php");
