<?php
//error_reporting(E_ALL); ini_set('display_errors', 'On');

session_start();

require('controller/frontendcontroller.php');
require('controller/backendcontroller.php');

try {
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'post') {
	        post();
	    }
	   	elseif ($_GET['action'] == 'listPostAdmin') {
	        listPostsAdmin();
	    }
      	elseif ($_GET['action'] == 'postAdmin') {
	        postAdmin();
	    }
	    elseif ($_GET['action'] == 'connect') {
	    	if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
	    		connectAdministrator($_POST['pseudo'], $_POST['password']);
	    		header("Location:index.php?action=listPostAdmin");
	    	} else {
	                throw new Exception('tous les champs ne sont pas remplis !');
	            }
	    }
	    elseif ($_GET['action'] == 'disconnect') {
          		session_destroy();
	    		listPosts();
	    }
	    elseif ($_GET['action'] == 'addComment') {
	        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
	            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
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
	        	erasePost($postId);
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
	        if (isset($_GET['postId']) && $_GET['postId'] > 0) {
	        	updatePost($_GET['postId']);
	        }  
		    else {
		        throw new Exception("aucun identifiant de billet envoyé");
		    }
		}
		elseif ($_GET['action'] == 'newPost') {
	        require('view/backend/createPostView.php');
	    }
	    elseif ($_GET['action'] == 'createPost') {
	        newPost();
	    }  
	}
	else{
		if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
			listPostsAdmin();
		}
		else {
			listPosts();
		}
	}
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
