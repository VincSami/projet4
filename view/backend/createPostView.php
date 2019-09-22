<?php $page_title = "Billet simple pour l'Alaska"; ?>

<?php $page_subtitle = "Créer un nouveau billet"; ?>

<?php $main_content_title = "Vous êtes sur le point de créer un nouveau billet "; ?>

<?php ob_start(); ?>
        <button><a href="index.php?action=createPost">Créer</a></button>
<?php $main_content_subtitle = ob_get_clean(); ?>

<?php ob_start(); ?>
    <textarea id="basic-example">
    </textarea>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('templateBackend.php'); ?>
