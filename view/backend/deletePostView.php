<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = "Supprimer le billet : " . htmlspecialchars($postAdmin['title']) ?>

<?php $main_content_title = "Vous êtes sur le point de supprimer définitivement ce billet ainsi que ses commentaires"; ?>

<?php ob_start(); ?>
        <button><a href="index.php?action=delete&amp;id=<?= $postAdmin['id'] ?>">Supprimer le billet</a></button>
<?php $main_content_subtitle = ob_get_clean(); ?>

<?php $article_content = htmlspecialchars($postAdmin['content'])?>

<?php ob_start(); ?>
        <h2>Commentaires</h2>
        <?php
        while ($comment = $comments->fetch())
        {
        ?>
        <div id="comment">
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <p></strong> le <?= $comment['comment_date_fr'] ?></strong></p>
            <button>signaler</button>
        </div>
        <?php
        }
        ?>
<?php $comment_content = ob_get_clean(); ?>

<?php require('template.php'); ?>
