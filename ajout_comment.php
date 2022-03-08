<?php
require 'connexionDb.php';


if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) && isset($_POST["commentaire"]) && !empty($_POST["commentaire"]) ) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $commentaire = htmlspecialchars($_POST["commentaire"]);
    $id = htmlspecialchars($_POST["id"]);
    
    // preparer requete inserer
    $sql = $connexionDb->prepare("INSERT INTO `commentaires`(`id_article`, `pseudo`, `contenu`, `date`)
                                    VALUES (?,?,?,NOW())");
    // executer requete 
    $sql->execute([$id,$pseudo,$commentaire]);
    $result = $sql;
    
    if($result) {
        header('location: article.php?id='.$id);
    }
}