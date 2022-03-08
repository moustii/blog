<?php
require 'connexionDb.php';
session_start();
// var_dump($_GET);

if(isset($_SESSION['admin'])) {
    if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET["id"]);
        
        $sqlArticle = $connexionDb->prepare("DELETE FROM `articles`
                                        WHERE id = ?");
        
        $test = $sqlArticle->execute([$id]);
        
        $sqlComment = $connexionDb->prepare("DELETE FROM `commentaires`
                                        WHERE id_article = ?");
        
        $test1 = $sqlComment->execute([$id]);
       
       
        if ($test && $test1) {
            header('location: admin.php');
        } else {
            echo "Suppression impossible";
        }
    } 

} else {
    header('location:admin.php');
    exit();
}








