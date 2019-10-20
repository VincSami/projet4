<?php

//Récupération des fonctions nécesaires dans le model
require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');

//Déclenchement des fonctions selon l'action
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
                  } else {
                      throw new Exception('tous les champs ne sont pas remplis !');
                  }
              } else {
                      throw new Exception('tous les champs ne sont pas remplis !');
                  }
          }
          elseif ($_GET['action'] == 'signal') {
              if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
                      signalComment($_GET['commentId']);
              } else {
                      throw new Exception('impossible de procéder au signalement !');
                  }
          }
          elseif ($_GET['action'] == 'mentions'){
            require ('view/mentions_legales.php');
          }
  }
  else {
      listPosts();
  }
}

//connexion de l'Admin
function connectAdministrator()
{
    $adminManager = new AdminManager();
    $connectAdministrator = $adminManager->connectAdmin($_POST['pseudo'], $_POST['password']);
}

//Affichage des posts sur la page d'acceuil visiteur
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/frontend/indexView.php');
}

//Affichage du post sélectionné
function post()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $posts = $postManager->getPosts();  
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

//Ajout d'un commentaire
function addComment($postId, $author, $email, $comment)
{
    $postManager = new PostManager();
    if (!$postManager->isPostExist($postId)){
      throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    $commentsManager = new CommentsManager();
    $affectedLines = $commentsManager->postComment($postId, $author, $email, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } 
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

//Signalement d'un commentaire existant
function signalComment($commentId)
{
    $commentsManager = new CommentsManager();
    $badComment = $commentsManager->badComment($commentId);
    if ($badComment === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else{
      return true;
    }
}