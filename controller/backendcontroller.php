<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');

function checkIsAdmin()
{
    if(!isset($_SESSION['id'])){
        header("Location:index.php");
    }
}

function listPostsAdmin()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/backend/indexAdminView.php');
}

function postAdmin()
{
    checkIsAdmin();
    $adminManager = new AdminManager();
    
    $postAdmin = $adminManager->getPostAdmin($_GET['id']);

    require('view/backend/postAdminView.php');
}

function deletePostAdmin()
{
    checkIsAdmin();
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/deletePostView.php');
}

function erasePost($postId)
{
    $postManager = new PostManager();
    $deletePost = $postManager->deletePost($postId);
}

function updatePostAdmin()
{
    checkIsAdmin();
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/updatePostView.php');
}

function updatePost($postId)
{
    $adminManager = new AdminManager();
    $updatedPost = $adminManager->modifyPost($postId);
}

function newPost()
{
    $postManager = new PostManager();
    $newPost = $postManager->createPost();
}