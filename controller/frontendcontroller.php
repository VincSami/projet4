<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');

function frontendController()
{
  if (isset($_GET['action'])) { 
          if ($_GET['action'] == 'connect'){
            if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
              connectAdministrator($_POST['pseudo'], $_POST['password']);
              header('Location:index.php');
            } 
            else {
             throw new Exception('Tous les champs ne sont pas remplis !');
              }
          }     
          elseif ($_GET['action'] == 'post') {
              post();
          }
          elseif ($_GET['action'] == 'addComment') {
              if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                  if (!empty($_POST['author']) && !empty($_POST['comment']) && !empty($_POST['email'])) {
                      addComment($_GET['id'], $_POST['author'], $_POST['email'], $_POST['comment']);
                  }
              } else {
                      throw new Exception('tous les champs ne sont pas remplis !');
                  }
          }
          elseif ($_GET['action'] == 'signal') {
              if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
                      signalComment($_GET['commentId'], $_GET['postId']);
              } else {
                      throw new Exception('impossible de procéder au signalement !');
                  }
          }
  }
  else {
      listPosts();
  }
}

function connectAdministrator()
{
    $adminManager = new AdminManager();
    $connectAdministrator = $adminManager->connectAdmin($_POST['pseudo'], $_POST['password']);
}

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
    if ($badComment === false){
      throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
      return 1;
    }
}