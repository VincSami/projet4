<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/frontend/indexView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $email, $comment)
{
    $commentsManager = new CommentsManager();
    $affectedLines = $commentsManager->postComment($postId, $author, $email, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } 
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function signalComment($commentId, $postId)
{
    $commentsManager = new CommentsManager();
    $signalComment = $commentsManager->badComment($_GET['commentId'], $_GET['postId']);
    header('Location: index.php?action=post&id=' . $_GET['postId']);
}

function connectAdministrator()
{
    $adminManager = new AdminManager();
    $connectAdministrator = $adminManager->connectAdmin($_POST['pseudo'], $_POST['password']);
}
