<?php ob_start(); ?>
    <img class="fullwidth" src="public/img/alaska_accueil.jpg" alt="image alaska accueil">
<?php $image_post = ob_get_clean(); ?>

<?php $page_title = 'Bienvenue sur la page d\'administration du site de Jean Forteroche'; ?>

<?php $page_subtitle = ''; ?>

<?php $main_content_title = 'Gestion des épisodes et des commentaires'; ?>

<?php $main_content_subtitle = 'Ecrivez de nouveaux épisodes, modifiez ou supprimez des épisodes existants ou encore gérez les commentaires signalés à partir de cette page.'; ?>
<?php ob_start(); ?>
      <div id="newPost">
        <button class="boutonVert"><a href="index.php?action=newPost">Ecrire un nouvel épisode</a></button><br>
      </div>
<?php $creation_post = ob_get_clean(); ?>

<?php ob_start(); ?>
      <div class="postPresentation">
      <?php
         foreach($posts as $post) 
        {
      ?>
            <figure><a href="index.php?action=postAdmin&amp;id=<?= $post['id'] ?>">
            <img src="public/img/episode<?= $post['id'] ?>.jpg" alt="image alaska épisodes"></a>
            <figcaption>
              Billet simple pour l'Alaska<br><?= $post['title'] ?><br>
              <button class="boutonRouge" id="deletePostPage"><a href="index.php?action=goToDeletePage&amp;id=<?= $post['id'] ?>">Supprimer</a></button>
              <button class="boutonOrange" id="updatePostPage"><a href="index.php?action=goToUpdatePage&amp;id=<?= $post['id'] ?>">Modifier</a></button>
            </figcaption>
            </figure>
      <?php
        }
      ?>   
      </div>   
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = "" ?>

<?php require('templateBackend.php'); ?>