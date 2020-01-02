<?php

//Il faut s'assurer que le gestionnaire de session PHP est démarré, sinon on
//ne pourra pas détruire la session de l'utilisateur.
session_start();

//Destruction de la session.
session_destroy();

//Redirection vers la page de listing des articles.
header('Location: article-list.php');

?>
