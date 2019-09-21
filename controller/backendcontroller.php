<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');

function listPostsAdmin()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/backend/indexAdminView.php');
}

function deletePostAdmin()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $postAdmin = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/backend/deletePostView.php');
}

function erasePost()
{
    $postManager = new PostManager();
    $deletePost = $postManager->deletePost($_GET['id']);
}

function updatePostAdmin()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $postAdmin = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/backend/updatePostView.php');
}

function updatePost()
{
    $postManager = new PostManager();
    $updatePost = $postManager->modifyPost($_GET['id']);
}