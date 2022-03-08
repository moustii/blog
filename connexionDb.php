<?php

define("HOST","db.3wa.io");
define("DBNAME","jeremyibert_blog");
define("USER","jeremyibert");
define("PWD","d4a2e417ec462dbe8a23963226b0ced2");

try {
    $connexionDb = new PDO("mysql:host=".HOST.";dbname=".DBNAME,USER,PWD);
    $connexionDb->exec("SET CHARACTER SET utf8");
} catch (Exception $message) {
    die("Error connexion ".$message->getMessage());
}
