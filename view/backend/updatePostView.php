<?php $page_title = "Billet simple pour l'Alaska" ?>

<?php $page_subtitle = "Modifier le billet : " . htmlspecialchars($post['title']) ?>

<?php $main_content_title = "Vous êtes sur le point de modifier ce billet "; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
    <form action="index.php?action=update&amp;postId=<?= $post['id'] ?>" method="post">
    <textarea id="editor" name="editor">
    <?php echo ($post['content']);?>
    </textarea>
    <input type="submit" name="submit" value="Modifier">
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
