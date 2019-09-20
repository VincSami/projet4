<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/MembersManager.php');

function post()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentsManager = new CommentsManager();

    $affectedLines = $commentsManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } 

    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function addMember($pseudo, $password, $email)
{
    $membersManager = new MembersManager();

    $affectedLines = $membersManager->newMember($pseudo, $password, $email);

    if ($affectedLines === false) {
        throw new Exception('Impossible de finaliser votre inscription !');
    }
}

function connectUser()
{
    $membersManager = new MembersManager();

    $connectUser = $membersManager->connectMember($_POST['pseudo'], $_POST['password']);
}
