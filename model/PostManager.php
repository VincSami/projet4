<?php

require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {	
    	$db = $this->dbConnect();  
	    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');
	    return $req;
	}

    public function getPost($postId)
    {	
    	if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $post = $req->fetch();

	        return $post;

	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}

	public function deletepost($postId)
	{
		if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $post = $req->fetch();

	        return $post;

	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}

	public function updatepost($postId)
	{
		if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('UPDATE id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $post = $req->fetch();

	        return $post;

	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}
}