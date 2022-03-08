<?php
require 'connexionDb.php';
if (isset($_GET["id"])) {
    $articleId = htmlspecialchars($_GET["id"]);
    
    $queryArticle = $connexionDb->prepare("SELECT articles.id,`titre`,`contenu`,`date`,`nom`,`prenom`
                                        FROM `articles`
                                        INNER JOIN auteurs 
                                        ON articles.id_auteur = auteurs.id
                                        WHERE articles.id = ?");
    $queryArticle->execute([$articleId]);

    $article = $queryArticle->fetch();
    
    // preparer requete commentaire
    $query = $connexionDb->prepare("SELECT `id_article`,`pseudo`,commentaires.`contenu`,commentaires.`date`
                                    FROM `commentaires`
                                    INNER JOIN articles ON commentaires.id_article = articles.id 
                                    WHERE id_article = ?");
                                    
    $query->execute([$articleId]);      
    
    $resultComment = $query->fetchAll();
    // var_dump($resultComment);
    
    
    if ($article) {
        $titre = $article["titre"];
        $template = "article";
        require "layout.phtml";
    }
    
}










