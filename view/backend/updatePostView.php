<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = "Modifier le billet : " . htmlspecialchars($post['title']) ?>

<?php $main_content_title = "Vous êtes sur le point de modifier ce billet "; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
    <form action="index.php?action=update&amp;id=<?= $post['id'] ?>" method="post">
    <textarea id="editor" name="editor">
    <?php echo ($post['content']);?>
    </textarea>
    <input type="submit" name="submit" value="Modifier">
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php
while ($comment = $comments->fetch())
    {
    ?>
    <div id="comment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p></strong> le <?= $comment['comment_date_fr'] ?></strong></p>
        <button><a href="index.php?action=signal&amp;commentId=<?= $comment['id'] ?>&amp;id=<?= $post['id'] ?>">signaler</a></button>
        </div>
    <?php
    }
    ?>
<?php $comment_content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>
