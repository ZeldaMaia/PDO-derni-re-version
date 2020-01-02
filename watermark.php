<?php
$stamp = imagecreatefrompng('images/watermark/logo.png');
$im = imagecreatefromjpeg('images/papillon.jpg');
//Définit les marges pour le cachet et récupère la hauteur et largeur de celui-ci

$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copie le cachet sur la photo en utilisant les marges et la,largeur de la photo originale afin de calculer la position du cachet
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

$size = min(imagesx($im), imagesy($im));
$im = imagecrop($im, ['x' => $size*0.4, 'y' => 0, 'width' => $size, 'height' => $size]);
$im = imagescale($im, 200);


// $im_php = imagescale($im_php, 300);

//Affichage et libération de la mémoire
header('Content-type: image/png');
imagepng($im);
//imagepng($im, 'images/cofee-with-watermark.png');
imagedestroy($im);

?>