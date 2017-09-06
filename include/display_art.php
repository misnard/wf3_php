<?php
function display_articles()
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
			<article class="post">
				<header>
					<div class="title">
						<h2><a href="#"><?= htmlentities($article['title']) ?></a></h2>
						<p></p>
					</div>
					<div class="meta">
						<time class="published" datetime="<?= htmlentities($article['posted']); ?>"><?= htmlentities($article['posted']); ?></time>
						<a href="#" class="author"><span class="name"><?= htmlentities($article['author']); ?></span><img src="images/avatar.jpg" alt="" /></a>
					</div>
				</header>
				<a href="#" class="image featured"><img src="images/<?= htmlentities($article['picture']); ?>" alt="" /></a>
				<p><?= htmlentities($article['content']); ?></p>
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