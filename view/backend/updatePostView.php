<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = "Modifier le billet : " . htmlspecialchars($postAdmin['title']) ?>

<?php $main_content_title = "Vous êtes sur le point de modifier ce billet "; ?>

<?php ob_start(); ?>
        <button><a href="index.php?action=update&amp;id=<?= $postAdmin['id'] ?>">Modifier</a></button>
<?php $main_content_subtitle = ob_get_clean(); ?>

<?php ob_start(); ?>
    <textarea id="basic-example">
    <?php echo htmlentities($postAdmin['content']);?>
    </textarea>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
