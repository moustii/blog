<?php
require 'connexionDb.php';

$queryArticle = $connexionDb->prepare("SELECT articles.id,`titre`,`contenu`,`date`,`nom`,`prenom`,`image`
                                        FROM `articles`
                                        INNER JOIN auteurs 
                                        ON articles.id_auteur = auteurs.id 
                                        ORDER BY date DESC");
$queryArticle->execute();

$articles = $queryArticle->fetchAll();

// echo "<pre>";
// print_r($articles);
// echo "</pre>";
if ($articles) {
    $titre = "page d'accueil";
    $template = "index";
    require "layout.phtml";
} else {
    echo "Erreur";
}
