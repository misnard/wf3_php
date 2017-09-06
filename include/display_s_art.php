<?php
function display_s_art($id)
{
    if(gettype(intval($id)) == "integer")
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
            $dbh = $db->prepare('SELECT * FROM articles WHERE id = :id');
            $dbh->bindParam(':id', $id);
            $dbh->execute();
            if($data = $dbh->fetch())
            {   ?>
                    <!-- Post -->
                    <article class="post">
                        <header>
                            <div class="title">
                                <h2><a href="#"><?= htmlentities($data['title']); ?></a></h2>
                                <p>sous titre</p>
                            </div>
                            <div class="meta">
                                <time class="published" datetime="<?= htmlentities($data['posted']); ?>"><?= htmlentities($data['posted']); ?></time>
                                <a href="#" class="author"><span class="name"><?= htmlentities($data['author']); ?></span><img src="images/avatar.jpg" alt="" /></a>
                            </div>
                        </header>
                        <span class="image featured"><img src="images/<?= htmlentities($data['picture']); ?>" alt="" /></span>
                        <?= htmlentities($data['content']); ?>
                        <footer>
                            <ul class="stats">
                                <li><a href="#">General</a></li>
                                <li><a href="#" class="icon fa-heart">28</a></li>
                                <li><a href="#" class="icon fa-comment">128</a></li>
                            </ul>
                        </footer>
                    </article>
                <?php
            }
            else
            {
                header('Location: 404.html');
            }
        }
    }
    else
    {
        header('Location: 404.html');
    }
}




?>