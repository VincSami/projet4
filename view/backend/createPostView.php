<?php $page_title = "Billet simple pour l'Alaska"; ?>

<?php $page_subtitle = "Créer un nouveau billet"; ?>

<?php $main_content_title = "Vous êtes sur le point de créer un nouveau billet "; ?>

<?php ob_start(); ?>
    <form action="index.php?action=newPostTitle" method="post">
	    <textarea id="postTitle" name="postTitle">
	    </textarea>
	    <input type="submit" name="submit" value="Créer">
	</form>
<?php $main_content_subtitle = ob_get_clean(); ?>

<?php ob_start(); ?>
    <form action="index.php?action=newPost" method="post">
	    <textarea id="postContent" name="postContent">
	    </textarea>
	    <input type="submit" name="submit" value="Créer">
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
