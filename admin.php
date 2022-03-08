<?php
require 'connexionDb.php';
session_start();

if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    
    $query = $connexionDb->prepare("SELECT `pseudo`,`password`
                                    FROM `admin`
                                    WHERE `pseudo` = ?");
    $query->execute([$pseudo]);
    $result = $query->fetch();
    // var_dump($result);
    if ($result) {
        if (password_verify($password, $result["password"])) {
            $_SESSION["admin"] = $pseudo;
        }
    }
    
}
$query = $connexionDb->prepare("SELECT articles.`id`,`titre`,`contenu`,`nom`,`prenom`,`nom_cat` 
                                FROM `articles`
                                INNER JOIN categories ON articles.id_cat = categories.id
                                INNER JOIN auteurs ON articles.id_auteur = auteurs.id
                                ORDER BY articles.date DESC");
                
$query->execute();

$articles = $query->fetchAll();
// var_dump($articles);


$titre = "admin";
$template = "admin";
require "layout.phtml";
