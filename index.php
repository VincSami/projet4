<?php

require('controller/controller.php');

try {
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'post') {
	        post();
	    }
	    elseif ($_GET['action'] == 'subscribe') {
	    	require('view/frontend/subscriptionView.php');
	    }
	    elseif ($_GET['action'] == 'newMember') {
	    	if ((!empty($_POST['pseudo'])) && (!empty($_POST['password'])) && (!empty($_POST['email']))) {
	    		addMember($_POST['pseudo'], $_POST['password'], $_POST['email']);
	    		require('view/frontend/indexView.php');
	    	} else {
	                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	            }
	    }
	    elseif ($_GET['action'] == 'connect') {
	    	if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
	    		connectUser($_POST['pseudo'], $_POST['password']);
	    		require('view/frontend/indexView.php');
	    	} else {
	                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	            }
	    }
	    elseif ($_GET['action'] == 'addComment') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
	                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
	            }
	        } else {
	                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
	            }
	    }      
	    else {
	        throw new Exception("Erreur : aucun identifiant de billet envoyé");
	    }
	}

	else{
		require('view/frontend/indexView.php');
	}
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
