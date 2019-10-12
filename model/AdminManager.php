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
	        $_SESSION['id'] = $resultat['id'];
	        $_SESSION['pseudo'] = $pseudo;
    	}
    	else {
        throw new Exception('Mauvais identifiant ou mot de passe !');
    	}	
	}
	
  	public function getPostAdmin($postId)
    {	
	        $db = $this->dbConnect();  
	        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $post = $req->fetch();
	        if(! $post){
	    	throw new Exception("le billet n'existe pas");
	    	}
	    	else {
			return $post;
			}
	        
	}
  	
  	public function deletePost($postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $deletePost = $req->fetch(); 
	}

  	public function deleteComments($postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM comments WHERE post_id = ?');
	        $req->execute(array($postId));
	        $deleteComments = $req->fetch(); 
	}

	public function deleteComment($commentId, $postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM comments WHERE id = ? AND post_id = ?');
	        $req->execute(array($commentId, $postId));
	        $deleteComment = $req->fetch(); 
	}

	public function modifyPost($title, $content, $postId)
	{
		if(isset($_POST['submit'])){
		        $db = $this->dbConnect();  
		        $posts = $db->prepare('UPDATE posts SET title = ?, content = ?, updated_date = NOW() WHERE id = ?');
		        $updatedPost = $posts->execute(array($title, $content, $postId));
		        return $updatedPost;
		}
	}
	
	public function createPost($title, $content)
	{
	    $db = $this->dbConnect();
	    $posts = $db->prepare('INSERT INTO posts(title, creation_date, content) VALUES(?, NOW(), ?)');
	    $postCreated = $posts->execute(array($title, $content));
	    
	    return $db->lastInsertId();
	}

	public function postImage($postId)
	{
	    if (isset($_FILES['image'])){
	    	if ($_FILES['image']['size'] <= 5000000){
	    		$infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)){
                	move_uploaded_file($_FILES['image']['tmp_name'], 'public/img/episode' . $postId . "." . $extension_upload);
                }
	    	}
		}
	}
}