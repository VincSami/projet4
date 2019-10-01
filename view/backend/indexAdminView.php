<?php ob_start(); ?>
    <img class="fullwidth" src="public/img/alaska_accueil.jpg ?>.jpg">
<?php $image_post = ob_get_clean(); ?>

<?php $page_title = 'Bienvenue sur la page d\'administration du site de Jean Forteroche'; ?>

<?php $page_subtitle = ''; ?>

<?php $main_content_title = 'Gestion des billets et des commentaires'; ?>

<?php $main_content_subtitle = 'Ecrivez de nouveaux billets, modifiez ou supprimez des billets existants ou encore gérer les commentaires signalés à partir de cette page.'; ?>

<?php ob_start(); ?>
      <div id="newPost">
        <button class="boutonVert"><a href="index.php?action=newPost">Ecrire un nouvel épisode</a></button><br>
      </div>
      <div class="postPresentation">
      <?php
        while ($post = $posts->fetch())
        {
      ?>
            <figure><a href="index.php?action=postAdmin&amp;id=<?= $post['id'] ?>">
            <img src="public/img/episode<?= $post['id'] ?>.jpg">
            <figcaption>
              Billet simple pour l'Alaska<br><?= htmlspecialchars($post['title']) ?><br></a>
              <button class="boutonRouge" id="deletePostPage"><a href="index.php?action=goToDeletePage&amp;id=<?= $post['id'] ?>">Supprimer</a></button>
              <button class="boutonOrange" id="updatePostPage"><a href="index.php?action=goToUpdatePage&amp;id=<?= $post['id'] ?>">Modifier</a></button>
            </figcaption>
            </figure>
      <?php
        }
      $posts->closeCursor();
      ?>   
      </div>   
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = "" ?>

<?php require('templateBackend.php'); ?>