<?php
require 'connexionDb.php';

$pseudo = 'Reese';
$mdp = password_hash("azerty", PASSWORD_DEFAULT);

$sql = $connexionDb->prepare("INSERT INTO admin(pseudo, password) VALUES(?,?)");
$sql->execute([$pseudo, $mdp]);

