<?php

require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');


function backendController()
{
  if (isset($_GET['action'])) {                 
          if ($_GET['action'] == 'listPostsAdmin') {
              listPostsAdmin();
          }
          elseif ($_GET['action'] == 'postAdmin') {
              postAdmin();
          }
          elseif ($_GET['action'] == 'deleteComment') {
              if (isset($_GET['commentId']) && ($_GET['commentId'] > 0)) {
                    eraseComment($_GET['commentId'], $_GET['id'] );
                  } else {
                      throw new Exception('Le commentaire n\'existe pas !');
                  }
          }
          elseif ($_GET['action'] == 'goToDeletePage') {
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  deletePostAdmin();
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          elseif ($_GET['action'] == 'delete') {
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  erasePost($_GET['id']);
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          elseif ($_GET['action'] == 'goToUpdatePage') {
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  updatePostAdmin();
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          elseif ($_GET['action'] == 'update') {
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  if (!empty($_POST['title']) && !empty($_POST['content'])) {
                  updatePost($_POST['title'], $_POST['content'], $_GET['id']);
                  } else {
                      throw new Exception('tous les champs ne sont pas remplis !');
                  }
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          elseif ($_GET['action'] == 'newPost') {
              require('view/backend/createPostView.php');
          }
          elseif ($_GET['action'] == 'createPost') {
              if (!empty($_POST['title']) && (!empty($_POST['content']))){
              newPost($_POST['title'], $_POST['content']);
              } else {
                  throw new Exception('tous les champs ne sont pas remplis !');
              }
          }
          elseif ($_GET['action'] == 'disconnect') {
              session_destroy();
              header('Location:index.php');
          }
  }
  else{
      listPostsAdmin();
  }
}

//Accueil Administrateur
function listPostsAdmin()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/backend/indexAdminView.php');
}

//Lecture billet Administrateur
function postAdmin()
{
    $adminManager = new AdminManager();
    $commentsManager = new CommentsManager();
    
    $post = $adminManager->getPostAdmin($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/postAdminView.php');
}

//Page de suppression du billet et des commentaires
function deletePostAdmin()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/deletePostView.php');
}

//Suppression du billet et des commentaires
function erasePost($postId)
{
    $adminManager = new AdminManager();
    $deletePost = $adminManager->deletePost($postId);
    $deleteComments = $adminManager->deleteComments($postId);
    header("Location:index.php");
}

//Suppression d'un commentaire
function eraseComment($commentId, $postId){
    $adminManager = new AdminManager();
    $eraseComment = $adminManager->deleteComment($commentId, $postId);
    header('Location: index.php?action=postAdmin&id=' . $postId);
}

//Page de modification du billet
function updatePostAdmin()
{
    $postManager = new PostManager();
    $commentsManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/updatePostView.php');
}

//Modification du billet
function updatePost($title, $content, $postId)
{
    $adminManager = new AdminManager();
    $updatedPost = $adminManager->modifyPost($title, $content, $postId);
    $postImage = $adminManager->postImage($postId);
    if ($updatedPost === false) {
        throw new Exception('Impossible de modifier le billet !');
    } 
    else {
        header('Location: index.php');
    }
}

//Création d'un nouveau billet
function newPost($title, $content)
{
    $adminManager = new AdminManager();
    $postCreated = $adminManager->createPost($title, $content);
    $postImage = $adminManager->postImage($postCreated);
    if ($createPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    } 
    else {
        header('Location: index.php');
    }
}