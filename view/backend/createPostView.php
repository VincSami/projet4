<?php $image_post = ""; ?>

<?php $page_title = "Page d'administration du site de Jean Forteroche"; ?>

<?php $page_subtitle = "Créer un nouveau billet"; ?>

<?php $main_content_title = "Vous êtes sur le point de créer un nouveau billet "; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
    <form action="index.php?action=createPost" method="post" enctype="multipart/form-data">
	    <label for="image"><strong>Définir l'image</strong></label><br />
   		<input class="boutonVert" type="file" name="image" /><br /><br />
	    <label for="title"><strong>Titre</strong></label><br />
	    <textarea id="title" name="title"><br />
	    </textarea><br />
	    <label for="content"><strong>Contenu</strong></label><br />
	    <textarea id="content" name="content">
	    </textarea><br />
	    <input class="boutonVert" type="submit" name="submit" value="Publier le billet">
	    <button class="boutonRouge"><a href="index.php">Annuler</a></button>
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
