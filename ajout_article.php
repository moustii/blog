<?php
require 'connexionDb.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (empty($_POST)) {
        
    /* si l'on a pas encore soumis le formulaire, alors on récupère les catégories
       présentes en bdd et les auteurs et on les affiche dans une liste déroulante.
    */
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
        $msgError = 'none';
        $titre = "nouvel article";
        $template = "ajout_article";
        require "layout.phtml";
    } else {
        
    /*sinon, on insère le nouvel article en base de données et on redirige vers admin.php*/
        if (!empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["idAuteurs"]) && !empty($_POST["idCategories"]) && isset($_POST["titre"]) && isset($_POST["contenu"]) && isset($_POST["idAuteurs"]) && isset($_POST["idCategories"]) ) {
            $titre = htmlspecialchars($_POST["titre"]);
            $contenu = htmlspecialchars($_POST["contenu"]);
            $image = htmlspecialchars($_FILES["image"]["name"]);
            $auteur = htmlspecialchars($_POST["idAuteurs"]); 
            $cat = htmlspecialchars($_POST["idCategories"]); 
        //   var_dump($_POST); 
        //   var_dump($_FILES); 
            $sql = $connexionDb->prepare("INSERT INTO `articles`(`titre`, `contenu`, `date`, `id_auteur`,`id_cat`,`image`)
                                            VALUES (?,?,NOW(),?,?,?)");
                                            
            $sql->execute([$titre,$contenu,$auteur,$cat,$image]);
            $uploads_dir = 'images';
            if (!empty($_FILES['image']['name'])) { //si le nom de l'image n'est pas vide
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
            }
            if ($sql) {
                header('location:admin.php');
            }
            // redirection admin
            
                                            
        } else {
            $queryAuteurs = $connexionDb->prepare("SELECT `id`,`nom`,`prenom` 
                                        FROM `auteurs`");
            $queryAuteurs->execute();
            $auteurs = $queryAuteurs->fetchAll();
            
            $queryCat = $connexionDb->prepare("SELECT `id`,`nom_cat` 
                                                FROM `categories`");
            $queryCat->execute();
            $categories = $queryCat->fetchAll();
            
            $msgError = 'block';
            $titre = "nouvel article";
            $template = "ajout_article";
            require "layout.phtml";
        }
     
    }
} else {
    header('location:admin.php');
    exit();
}










