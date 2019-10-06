<?php ob_start(); ?>
    <img class="fullwidth" src="public/img/episode<?= $post['id'] ?>.jpg">
<?php $image_post = ob_get_clean(); ?>

<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = ($post['title']) ?>

<?php $main_content_title = "\"Il y a avait peu de place pour l'hésitation. Perdre ou gagner, franchement, on a vraiment le choix ?\""; ?>

<?php $main_content_subtitle = ""; ?>

<?php $article_content = ($post['content']) ?>

<?php ob_start(); ?>
        <h2>Commentaires</h2>
        <form id="postComment" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" placeholder="Votre pseudo" /><br><br>
                <label for="email">Email</label><br />
                <input type="email" id="email" name="email" placeholder="Votre email" /><br><br>
                <label for="comment">Commentaire</label><br />
                <textarea id="commentPost" name="comment" placeholder="Votre commentaire"></textarea><br>
                <input class="boutonVert" type="submit" value="Valider"/>
        </form>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
        <div id="comment">
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <p></strong> le <?= $comment['comment_date_fr'] ?></strong></p>
            <button class="<?= $post['id'] ?> <?= $comment['id'] ?> signalButton boutonRouge">Signaler</button>
        </div>
        <?php
        }
        ?>
<?php $comment_content = ob_get_clean(); ?>

<?php require('templateFrontend.php'); ?>
