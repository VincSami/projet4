<?php

require('controller/frontendcontroller.php');
require('controller/backendcontroller.php');

try {
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'post') {
	        post();
	    }
	    elseif ($_GET['action'] == 'connect') {
	    	if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
	    		connectAdministrator($_POST['pseudo'], $_POST['password']);
	    		listPostsAdmin();
	    	} else {
	                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	            }
	    }
	    elseif ($_GET['action'] == 'disconnect') {
	    		listPosts();
	    }
	    elseif ($_GET['action'] == 'addComment') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
	                addComment($_GET['id'], $_POST['author'], $_POST['email'], $_POST['comment']);
	            }
	        } else {
	                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	            }
	    }
	    elseif ($_GET['action'] == 'gotodeletepage') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	        	deletePostAdmin();
	        }  
		    else {
		        throw new Exception("Erreur : aucun identifiant de billet envoyé");
		    }
		}
		elseif ($_GET['action'] == 'delete') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	        	erasePost();
	        }  
		    else {
		        throw new Exception("Erreur : aucun identifiant de billet envoyé");
		    }
		}
		elseif ($_GET['action'] == 'gotoupdatepage') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	        	updatePostAdmin();
	        }  
		    else {
		        throw new Exception("Erreur : aucun identifiant de billet envoyé");
		    }
		}
		elseif ($_GET['action'] == 'delete') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	        	updatePost();
	        }  
		    else {
		        throw new Exception("Erreur : aucun identifiant de billet envoyé");
		    }
		}
	}
	else{
		listPosts();
	}
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
