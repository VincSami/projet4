<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = htmlspecialchars($postAdmin['title']) ?>

<?php $main_content_title = "\"Il y a avait peu de place pour l'hésitation. Perdre ou gagner, franchement, on a vraiment le choix ?\""; ?>

<?php $main_content_subtitle = ""; ?>

<?php $article_content = htmlspecialchars($postAdmin['content']) ?>

<?php ob_start(); ?>
<?php
while ($comment = $comments->fetch())
    {
    ?>
    <div id="comment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p></strong> le <?= $comment['comment_date_fr'] ?></strong></p>
        <button><a href="index.php?action=signal&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $postAdmin['id'] ?>">signaler</a></button>
        </div>
    <?php
    }
    ?>
<?php $comment_content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>
