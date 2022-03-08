<?php 
require 'connexionDb.php';
session_start();
if(isset($_SESSION['admin'])) {
    if (empty($_POST)) {
        // var_dump($_GET);
        if (isset($_GET["id"])) {
            $id = htmlspecialchars($_GET["id"]);
    /* si l'on a pas encore soumis le formulaire, alors on récupère les catégories
       présentes en bdd et les auteurs et on les affiche dans une liste déroulante.
    */
            $queryArticle = $connexionDb->prepare("SELECT `id`,`titre`,`contenu` 
                                                    FROM `articles`
                                                    WHERE `id`= ?");
            $queryArticle->execute([$id]);
            $article = $queryArticle->fetch();
            // var_dump($article);
            
            
            $queryAuteurs = $connexionDb->prepare("SELECT `id`,`nom`,`prenom` 
                                            FROM `auteurs`");
            $queryAuteurs->execute();
            $auteurs = $queryAuteurs->fetchAll();
            
            $queryCat = $connexionDb->prepare("SELECT `id`,`nom_cat` 
                                                FROM `categories`");
            $queryCat->execute();
            $categories = $queryCat->fetchAll();
            
            // var_dump($auteurs);
            // var_dump($categories);
        
            $titre = "modifier article";
            $template = "modif_article";
            require "layout.phtml";
        }
        
    } else {
        
        if (!empty($_POST["titre"]) && !empty($_POST["contenu"]) && isset($_POST["titre"]) && isset($_POST["contenu"])) {
            $titre = htmlspecialchars($_POST["titre"]);
            $contenu = htmlspecialchars($_POST["contenu"]);
            $id = htmlspecialchars($_POST["idArticle"]);
            $image = htmlspecialchars($_FILES["image"]["name"]);
            
            $sql = $connexionDb->prepare("UPDATE `articles`
                                            SET `titre`= ?,`contenu`= ?,`date`= NOW()
                                            WHERE `id` = ?");
            $sql->execute([$titre, $contenu, $id]);
            // var_dump($_POST);
            
            if ($sql) {
                header('location:admin.php');
            }
            
            if (!empty($_FILES['image']['name'])) { //si le nom de l'image n'est pas vide
                    $sql = $connexionDb->prepare("UPDATE `articles`
                                                    SET `titre`= ?,`contenu`= ?,`date`= NOW(),`image`=?
                                                    WHERE `id` = ?");
                    $sql->execute([$titre,$contenu,$image,$id]);
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                    if($sql) {
                        header('location:admin.php');
                    }
            }
    
        } else {
            // si le champs est vide et que l'on essaie de soumettre le formulaire
            $id = htmlspecialchars($_POST["idArticle"]);
            header('location:modif_article.php?id='.$id);
                
        }
        
    }

} else {
    header('location:admin.php');
    exit();
}