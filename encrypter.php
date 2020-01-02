<?php

$mot_de_passe = '1234';

echo 'mot de passe: '.$mot_de_passe.'<br>';

$encoded_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

echo 'encoded psswd: '.$encoded_password.'<br><br>';

if(password_verify('12345', $encoded_password)){
	echo 'mot de passe OK!';
}
else{
	echo 'mot de passe incorrect.';
}
