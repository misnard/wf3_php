<?php
function display_articles_min()
{
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
    $dbh = $db->prepare("SELECT * FROM articles");
    $dbh->execute();
    $articles = $dbh->fetchAll();


    foreach($articles as $article)
        { ?>
    <!-- Post -->
    <article>
        <header>

          <h2><a href="#"><?= htmlentities($article['title']) ?></a></h2>
      </header>

      <footer>
          <ul class="actions">
            <li><a href="post.php?id=<?= htmlentities($article['id']); ?>" class="button big">Voir plus &rarr;</a></li>
          </ul>
        </footer>
</article>
<?php
}

}
}

?>