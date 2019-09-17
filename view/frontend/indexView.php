<?php $page_title = 'Bienvenue sur le site de Jean Forteroche'; ?>

<?php $page_subtitle = 'L\'écrivain du Grand Nord, auteur des best-sellers "Une nuit à Montréal" et "Terres sauvages d\'Islande"'; ?>

<?php $main_content_title = 'Découvrez le dernier livre de Jean Forteroche : Billet simple pour l\'Alaska'; ?>

<?php $main_content_subtitle = 'Comme à son habitude, Jean Forteroche surprend son public par son dernier livre. Délivré son forme de 6 épisodes, "Billet simple pour l\'Alaska" pourrait être le roman le plus haletant de l\'écrivain.'; ?>

<?php ob_start(); ?>
            <figure><a href="index.php?action=post&amp;id=1">
            <img src="public/img/episode1.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 1</figcaption>
            </a></figure>
            <figure><a href="index.php?action=post&amp;id=2">
            <img src="public/img/episode2.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 2</figcaption>
            </a></figure>
            <figure><a href="index.php?action=post&amp;id=3">
            <img src="public/img/episode3.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 3</figcaption>
            </a></figure>
            <figure><a href="index.php?action=post&amp;id=4">
            <img src="public/img/episode4.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 4</figcaption>
            </a></figure>
            <figure><a href="index.php?action=post&amp;id=5">
            <img src="public/img/episode5.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 5</figcaption>
            </a></figure>
            <figure><a href="index.php?action=post&amp;id=6">
            <img src="public/img/episode6.jpg">
            <figcaption>Billet simple pour l'Alaska<br>Episode 6</figcaption>
            </a></figure>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = "" ?>

<?php require('template.php'); ?>
