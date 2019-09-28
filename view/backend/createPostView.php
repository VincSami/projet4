<?php ob_start(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <p>Formulaire d'envoi de fichier</p>
    <input type="file" name="image" /><br />
    <input class="boutonVert" type="submit" value="Ajouter l'image" />
</form>
<?php $post_image = ob_get_clean(); ?>

<?php $page_title = "Page d'administration du site de Jean Forteroche"; ?>

<?php $page_subtitle = "Créer un nouveau billet"; ?>

<?php $main_content_title = "Vous êtes sur le point de créer un nouveau billet "; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
    <form action="index.php?action=createPost" method="post">
	    <label for="title">Titre</label><br />
	    <textarea id="title" name="title">
	    </textarea>
	    <label for="content">Contenu</label><br />
	    <textarea id="content" name="content">
	    </textarea>
	    <input class="boutonVert" type="submit" name="submit" value="Valider le contenu du billet">
	    <button class="boutonRouge"><a href="index.php">Annuler</a></button>
	</form>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
