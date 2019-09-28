<?php $page_title = "Page d'administration du site de Jean Forteroche" ?>

<?php $page_subtitle = "Modifier le billet : " . htmlspecialchars($post['title']) ?>

<?php $main_content_title = "Vous êtes sur le point de modifier ce billet "; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
    <form action="index.php?action=update&amp;id=<?= $post['id'] ?>" method="post">
	    <label for="title">Titre</label><br />
	    <textarea id="title" name="title">
	    	<?php echo ($post['title']); ?>
	    </textarea>
	    <label for="content">Contenu</label><br />
	    <textarea id="content" name="content">
	        <?php echo ($post['content']);?>
	    </textarea>
	    <input class="boutonVert" type="submit" name="submit" value="Valider le contenu du billet">
        <button class="boutonRouge"><a href="index.php">Annuler</a></button>
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php
while ($comment = $comments->fetch())
    {
    ?>
    <div id="comment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
        <p><?= htmlspecialchars($comment['comment']) ?></p>
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
