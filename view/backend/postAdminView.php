<?php $page_title = "Page d'administration du site de Jean Forteroche" ?>

<?php $page_subtitle = htmlspecialchars($post['title']) ?>

<?php $main_content_title = "\"Il y a avait peu de place pour l'hésitation. Perdre ou gagner, franchement, on a vraiment le choix ?\""; ?>

<?php ob_start(); ?>
<button class="boutonRouge"><a href="index.php?action=goToDeletePage&amp;id=<?= $post['id'] ?>">Supprimer</a></button>
<button class="boutonOrange"><a href="index.php?action=goToUpdatePage&amp;id=<?= $post['id'] ?>">Modifier</a></button>
<?php $main_content_subtitle = ob_get_clean(); ?>

<?php $article_content = htmlspecialchars($post['content']) ?>

<?php ob_start(); ?>
<?php
while ($comment = $comments->fetch())
    {
    ?>
    <div id="commentAdmin">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p></strong> le <?= $comment['comment_date_fr'] ?></strong></p>
        <p>signalé <?= $comment['niveau_signalement'] ?> fois</p>
        <?php
        if ($comment['niveau_signalement'] > 0){ 
        ?>
        <p></strong> dernier signalement le <?= $comment['date_dernier_signalement'] ?></strong></p>
        <?php 
        }
        ?>
        <button class="boutonRouge"><a href="index.php?action=deleteComment&amp;commentId=<?= $comment['id'] ?>&amp;id=<?= $post['id'] ?>">Supprimer</a></button>
        </div>
    <?php
    }
    ?>
<?php $comment_content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>
