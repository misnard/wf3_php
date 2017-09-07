<?php
function display_articles($page)
{
    $p = intval($page) - 1;

    if(gettype($p) == "integer") {

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
            $dbu = $db->prepare("SELECT COUNT(*) FROM articles");
            $dbu->execute();
            $num_articles = $dbu->fetchAll();
            $total = $num_articles[0][0];

            $page_max = ceil($total / 5);
            if($p <= $page_max) {

                $nombre_par_page = 5;
                $offset = $p * $nombre_par_page;
                
                $dbh = $db->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT :numb OFFSET :offset");
                $dbh->bindParam(":offset", $offset, PDO::PARAM_INT);
                $dbh->bindParam(":numb", $nombre_par_page, PDO::PARAM_INT);
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
                        <a href="post.php?id=<?= htmlentities($article['id']); ?>" class="image featured"><img src="images/<?= htmlentities($article['picture']); ?>" alt="" /></a>
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
            return $page_max;
        }
    }
    else {
        echo "ERREUR cet article n'existe pas !";
    }
    
}

function display_pagination($page_max, $current_page)
{
    $p = intval($current_page);
    if(gettype($p) == "integer")
    {
        if($page_max >= $p){
            if($p == 1)
            {
                echo '<li><a href="index.php?p=' . ($p+1) . '" class="button big next">Page suivante</a></li>';
            }
            elseif($p > 1 && $p < $page_max)
            {
                echo '<li><a href="index.php?p=' . ($p-1) . '" class="button big previous">Page précédente</a></li>';
                echo '<li><a href="index.php?p=' . ($p+1) . '" class="button big next">Page suivante</a></li>';
            }
            else{
                echo '<li><a href="index.php?p=' . ($p-1) . '" class="button big previous">Page précédente</a></li>';
            }
        }
    }
}
?>