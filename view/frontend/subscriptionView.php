<?php $page_title = "Billet simple pour l'Alaska"; ?>

<?php $page_subtitle = ""; ?>

<?php $main_content_title = "Inscription"; ?>

<?php $main_content_subtitle = ""; ?>

<?php ob_start(); ?>
        <h2>Inscrivez-vous</h2>
        <form id="subscription" action="index.php?action=newMember" method="post">
                <label for="pseudo">Pseudo</label><br />
                <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" /><br><br>
                <label for="mail">Mail</label><br />
                <input type="email" id="email" name="email" placeholder="Votre mail" /><br><br>
                <label for="password">Mot de passe</label><br />
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" /><br><br>
                <input type="submit" value="Valider"/>
        </form>
<?php $article_content = ob_get_clean(); ?>

<?php $comment_content = ""; ?>

<?php require('template.php'); ?>
