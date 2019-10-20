<?php
//Chargement des classes avec require_once (pour éviter des appels en doublons)
require_once('model/PostManager.php');
require_once('model/CommentsManager.php');
require_once('model/AdminManager.php');


function backendController()
{
  //On vérifie si une action est bien demandée
  if (isset($_GET['action'])) { 
          //Affichage des épisodes (accueil)
          if ($_GET['action'] == 'listPostsAdmin') {
              //On appelle la fonction listPostAdmin du controller
              listPostsAdmin();
          }
          //Affiche de l'épisode sélectionné
          elseif ($_GET['action'] == 'postAdmin') {
              //On appelle la fonction postAdmin du controller
              postAdmin();
          }
          //Suppression d'un commentaire
          elseif ($_GET['action'] == 'deleteComment') {
              //On vérifie l'id du commentaire à supprimer, s'il est bien passé en URL et s'il est positif
              if (isset($_GET['commentId']) && ($_GET['commentId'] > 0)) {
                    //Alors on appelle la fonction eraseComment du controller qui prend en paramètre l'id du commentaire et l'id de l'épisode
                    eraseComment($_GET['commentId'], $_GET['id'] );
                  } else {
                      throw new Exception('Le commentaire n\'existe pas !');
                  }
          }
          //Redirection vers la page de suppression de l'épisode sélectionné
          elseif ($_GET['action'] == 'goToDeletePage') {
              //On vérifie qu'on dispose de l'id de l'épisode à supprimer et qu'il est positif
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  //On appelle la fonction deletePostAdmin du controller
                  deletePostAdmin();
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          //Suppression de l'épisode de la bdd
          elseif ($_GET['action'] == 'delete') {
            //On vérifie qu'on dispose de l'id de l'épisode à supprimer et qu'il est positif
            if (isset($_GET['id']) && $_GET['id'] > 0) {
              //On appelle la fonction erasePost du controller
              erasePost($_GET['id']);
            }
          }
          //Redirection vers la page de modification de l'épisode sélectionné
          elseif ($_GET['action'] == 'goToUpdatePage') {
              //On vérifie qu'on dispose de l'id de l'épisode à supprimer et qu'il est positif
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  //On appelle la fonction updatePostAdmin du controller
                  updatePostAdmin();
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          //Modification de l'épisode dans la bdd
          elseif ($_GET['action'] == 'update') {
              //On vérifie qu'on dispose de l'id de l'épisode à supprimer et qu'il est positif
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                  //On vérifie que l'épisode dispose bien d'un titre et d'un contenu
                  if (!empty($_POST['title']) && !empty($_POST['content'])) {
                  //On appelle la fonction updatePost du controller
                  updatePost($_POST['title'], $_POST['content'], $_GET['id']);
                  } else {
                      throw new Exception('tous les champs ne sont pas remplis !');
                  }
              }  
              else {
                  throw new Exception("aucun identifiant de billet envoyé");
              }
          }
          //Redirection vers la page de création d'un épisode
          elseif ($_GET['action'] == 'newPost') {
              //On appelle la fonction postCreation du controller
              postCreation();
          }
          //Ajout d'un épisode dans la bdd
          elseif ($_GET['action'] == 'createPost') {
              //On vérifie que l'épisode dispose bien d'un titre et d'un contenu
              if (!empty($_POST['title']) && (!empty($_POST['content']))){
                //On appelle la fonction newPost du controller
                newPost($_POST['title'], $_POST['content']);
              } else {
                  throw new Exception('tous les champs ne sont pas remplis !');
              }
          }
          //Déconnexion de l'administrateur
          elseif ($_GET['action'] == 'disconnect') {
              session_destroy();
              header('Location:index.php');
          }
          //Redirection vers la page des mentions légales
          elseif ($_GET['action'] == 'mentions'){
            require ('view/mentions_legales.php');
          }
  }
  //Si aucune action n'est passée à l'URL, on affiche l'accueil
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
    $postManager = new PostManager();
    $posts = $postManager->getPosts();  
    
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

    $posts = $postManager->getPosts();  
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/deletePostView.php');
}

//Suppression du billet et des commentaires
function erasePost($postId)
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
  $adminManager = new AdminManager();
    $deletePost = $adminManager->deletePost($postId);
    $deleteComments = $adminManager->deleteComments($postId);
    header('Location:index.php');
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
  
    $posts = $postManager->getPosts();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    require('view/backend/updatePostView.php');
}

//Modification du billet
function updatePost($title, $content, $postId)
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    
    $adminManager = new AdminManager();
    $updatedPost = $adminManager->modifyPost($title, $content, $postId);
    $postImage = $adminManager->postImage($postId);
    if ($updatedPost === false) {
        throw new Exception('Impossible de modifier le billet !');
    } 
    else {
        header('Location: index.php?action=postAdmin&id=' . $postId);
    }
}

//Page de création d'un billet
function postCreation()
{
  $postManager = new PostManager();
  $posts = $postManager->getPosts();
  require('view/backend/createPostView.php');
}

//Création d'un nouveau billet
function newPost($title, $content)
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();  
    
    $adminManager = new AdminManager();
    $postCreated = $adminManager->createPost($title, $content);
    $postImage = $adminManager->postImage($postCreated);
    if ($postCreated === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    } 
    else {
        header('Location: index.php');
    }
}