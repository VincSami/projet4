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

	public function deletePost($postId)
	{
		if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE id, title, content, creation_date FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $deletePost = $req->fetch(); 

	        return $deletePost;
	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}

	public function modifyPost($postId)
	{
		if (($postId >= 1) && ($postId <= 6)) {
	        $db = $this->dbConnect();  
	        $req = $db->prepare('UPDATE id, title, content, FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $modifyPost = $req->fetch(); 

	        return $modifyPost;
	    } else {
	    	throw new Exception('le billet n\'existe pas !');
		}
	}
	
	public function createPost()
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (:title, :content, :creation_date)');
	        $req->execute(array(
	        'title' => $title,
			'content' => $content,
			'creation_date' => $creation_date,
	        ));
	echo "Le nouvel épisode a bien été ajouté";
	}
}