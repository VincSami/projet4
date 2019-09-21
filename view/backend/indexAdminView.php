<?php $page_title = 'Bienvenue sur le site de Jean Forteroche'; ?>

<?php $page_subtitle = 'L\'écrivain du Grand Nord, auteur des best-sellers "Une nuit à Montréal" et "Terres sauvages d\'Islande"'; ?>

<?php $main_content_title = 'Découvrez le dernier livre de Jean Forteroche : Billet simple pour l\'Alaska'; ?>

<?php $main_content_subtitle = 'Comme à son habitude, Jean Forteroche surprend son public par son dernier livre. Délivré son forme de 6 épisodes, "Billet simple pour l\'Alaska" pourrait être le roman le plus haletant de l\'écrivain.'; ?>

<?php ob_start(); ?>
      <div id="newPost">
        <p>Ecrire un nouvel épisode</p>
      </div>
      <?php
        while ($post = $posts->fetch())
        {
      ?>
            <figure><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">
            <img src="public/img/episode<?= $post['id'] ?>.jpg">
            <figcaption>Billet simple pour l'Alaska<br><?= htmlspecialchars($post['title']) ?></figcaption>
            </a></figure>
            <button><a href="index.php?action=gotodeletepage&amp;id=<?= $post['id'] ?>">Supprimer</a></button>
            <button><a href="index.php?action=gotoupdatepage&amp;id=<?= $post['id'] ?>">Modifier</a></button>
      <?php
        }
      $posts->closeCursor();
      ?>      
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = "" ?>

<?php require('template.php'); ?>