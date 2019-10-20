<?php
//On charge Manager.php (pour récupérer la connexion à la bdd)
require_once('model/Manager.php');
//Déclare la classe PostManager en la faisant hériter de la class Manager (connexion bdd)
class PostManager extends Manager
{
	//Récupération des épisodes
    public function getPosts()
    {	
    	$db = $this->dbConnect();  
	    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');
	    $req->setFetchMode(PDO::FETCH_ASSOC);
	    $req->execute();
	    $posts = $req->fetchAll();

	    return $posts;
	}
	//Récupération de l'épisode passé en paramètre
    public function getPost($postId)
    {	
    	$db = $this->dbConnect();  
	    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();
		//On vérifie que l'épisode demandé existe bien
	    if(! $post){
	    	throw new Exception("le billet n'existe pas");
	    }
	    else {
	    return $post;
		}
	}

	public function isPostExist($postId)
	{
		$db = $this->dbConnect();  
	    $req = $db->prepare('SELECT COUNT (id) FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();
	    return $post > 0;
	}
}