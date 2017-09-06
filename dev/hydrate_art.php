<?php
//Cette page sert a remplir la base de donées pour avoir des articles

try 
{
    $db = new PDO('mysql:host=localhost;dbname=tp_php', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) 
{
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
if(empty($e))
{
    $nb = 10; //Nombre d'article a ajouter
    $i = 0; //init du compteur
    $r_title = "Article bobo";
    $r_content = "Lorem sa mere";
    $r_posted = date("d.m.y");
    $r_picture = "pic01.jpg";
    $r_author = "Connasse parisienne";
    while($i != 10)
    {
        $r_titles = $r_title.$i;
        $dbh = $db->prepare("INSERT INTO articles (title, content, posted, picture, author) VALUES (:title, :content, :posted, :picture, :author)");
        $dbh->bindParam(':title', $r_titles);
        $dbh->bindParam(':content', $r_content);
        $dbh->bindParam(':posted', $r_posted);
        $dbh->bindParam(':picture', $r_picture);
        $dbh->bindParam(':author', $r_author);
        $dbh->execute();
        $i++;
    }
}






?>