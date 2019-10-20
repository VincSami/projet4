<?php
//On charge Manager.php (pour récupérer la connexion à la bdd)
require_once('model/Manager.php');

//Déclare la classe AdminManager en la faisant hériter de la class Manager (connexion bdd)
class AdminManager extends Manager
{
	//fonction de connexion de l'admin : pseudo et mdp doit être renseigné et passé en paramètre
	public function connectAdmin($pseudo, $password)
	{
		//Si l'admin est déjà connecté on termine la fonction ici
		if(isset($_SESSION['id'])){
			return;
		}
		//Sinon on se connecte à la bdd
		$db = $this->dbConnect();
		$pseudo = $_POST['pseudo'];
		//On récupère l'id et le mdp lié au pseudo renseigné
		$req = $db->prepare('SELECT id, password FROM members WHERE pseudo = ?');
		$req->execute(array($pseudo));
		//on stocke le pseudo dans l'array résultat
		$resultat = $req->fetch();
		//On vérifie que le mot de passe renseigné par rapport à celui stocké dans la bdd (qui a été haché préalablement) avec la fonction password_verify
		$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
		//Si le pseudo renseigné n'est pas trouvé dans la bdd...
		if (!$resultat)
		{
   			throw new Exception('Mauvais identifiant ou mot de passe !');
		}
		//Si le pseudo est trouvé et que le mdp renseigné est correct, on connecte l'admin
    	if ($isPasswordCorrect) {
	        $_SESSION['id'] = $resultat['id'];
	        $_SESSION['pseudo'] = $pseudo;
    	}
    	//Si mauvais mdp ...
    	else {
        throw new Exception('Mauvais identifiant ou mot de passe !');
    	}	
	}
	//Affichage d'un épisode
  	public function getPostAdmin($postId)
    {	
	        $db = $this->dbConnect();  
	        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $post = $req->fetch();
	        //Si l'épisode demandé n'existe pas.. (gestion des id de posts qui n'existent pas)
	        if(! $post){
	    	throw new Exception("le billet n'existe pas");
	    	}
	    	//Si l'épisode demandé a été trouvé dans la bdd, on l'affiche
	    	else {
			return $post;
			}
	        
	}
  	//Suppression d'un épisode
  	public function deletePost($postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
	        $req->execute(array($postId));
	        $deletePost = $req->fetch(); 
	}
	//Suppression des commentaires
  	public function deleteComments($postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM comments WHERE post_id = ?');
	        $req->execute(array($postId));
	        $deleteComments = $req->fetch(); 
	}
	//Suppression d'un commentaire
	public function deleteComment($commentId, $postId)
	{
	        $db = $this->dbConnect();  
	        $req = $db->prepare('DELETE FROM comments WHERE id = ? AND post_id = ?');
	        $req->execute(array($commentId, $postId));
	        $deleteComment = $req->fetch(); 
	}
	//Modification d'un épisode existant
	public function modifyPost($title, $content, $postId)
	{
		if(isset($_POST['submit'])){
		        $db = $this->dbConnect();  
		        $posts = $db->prepare('UPDATE posts SET title = ?, content = ?, updated_date = NOW() WHERE id = ?');
		        $updatedPost = $posts->execute(array($title, $content, $postId));
		        return $updatedPost;
		}
	}
	//Création d'un nouvel épisode
	public function createPost($title, $content)
	{
	    $db = $this->dbConnect();
	    $posts = $db->prepare('INSERT INTO posts(title, creation_date, content) VALUES(?, NOW(), ?)');
	    $postCreated = $posts->execute(array($title, $content));
	    
	    return $db->lastInsertId();
	}
	//Upload d'une nouvelle image pour un épisode (création ou modification d'un épisode)
	public function postImage($postId)
	{
	    //Si un fichier a été transmis
	    if (isset($_FILES['image'])){
	    	//Si le fichier ne pèse pas plus de 5 Mo
	    	if ($_FILES['image']['size'] <= 5000000){
	    		//On récupère le nom du fichier
	    		$infosfichier = pathinfo($_FILES['image']['name']);
                //On récupère l'extension du fichier
                $extension_upload = $infosfichier['extension'];
                //On crée un array des extensions permises
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                //On compare l'extension du fichier transmis aux types d'extension autorisés
                if (in_array($extension_upload, $extensions_autorisees)){
                	//On place l'image dans le dossier adéquat et on lui donne un nouveau nom pour faciliter sa récupération
                	move_uploaded_file($_FILES['image']['tmp_name'], 'public/img/episode' . $postId . "." . $extension_upload);
                }
	    	}
		}
	}
}