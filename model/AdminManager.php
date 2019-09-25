<?php

require_once('model/Manager.php');

class AdminManager extends Manager
{
	public function connectAdmin($pseudo, $password)
	{
		if(isset($_SESSION['id'])){
			return;
		}
		$db = $this->dbConnect();
		$pseudo = $_POST['pseudo'];
		$req = $db->prepare('SELECT id, password FROM members WHERE pseudo = ?');
		$req->execute(array($pseudo));
		$resultat = $req->fetch();

		$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

		if (!$resultat)
		{
   			throw new Exception('Mauvais identifiant ou mot de passe !');
		}
    	if ($isPasswordCorrect) {
	        //session_start();
	        $_SESSION['id'] = $resultat['id'];
	        $_SESSION['pseudo'] = $pseudo;
    	}
    	else {
        throw new Exception('Mauvais identifiant ou mot de passe !');
    	}	
	}
	
  	public function getPostAdmin($postId)
    {	
    	if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $postAdmin = $req->fetch();
	        return $postAdmin;

	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}
  	
  	public function deletePost($postId)
	{
		if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $deletePost = $req->fetch(); 
	    } 
	    else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}

	public function modifyPost($postId)
	{
		if(isset($_POST['submit'])){
			if (($postId >= 1) && ($postId <= 6)) {
		        $postContent = $_POST['editor'];
		        $db = $this->dbConnect();  
		        $req = $db->prepare('UPDATE posts SET content = $postContent, updated_date = NOW() WHERE id = ?');
		        $update = $req->execute(array($postId));
		    } else {
		    	throw new Exception('le billet n\'existe pas !');
		    }
		}
	}
	
	public function createPost($title, $content)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW()');
	        $req->execute(array($title, $content));
	echo "Le nouvel épisode a bien été ajouté";
	}
}
