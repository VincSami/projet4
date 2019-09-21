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

function erasePost()
{
    $postManager = new PostManager();
    $deletepost = $postManager->deletepost($_GET['id']);
    require('view/backend/indexAdminView.php');
}