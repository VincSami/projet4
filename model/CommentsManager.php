<?php
//On charge Manager.php (pour récupérer la connexion à la bdd)
require_once('model/Manager.php');
//Déclare la classe CommentsManager en la faisant hériter de la class Manager (connexion bdd)
class CommentsManager extends Manager
{
	//Récupération des commentaires lié à l'épisode passé en paramètre
	public function getComments($postId)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, niveau_signalement, date_dernier_signalement FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
	    $comments->execute(array($postId));
	    return $comments;
	}
	//Ajout d'un commentaire lié à l'épisode passé en paramètre
	public function postComment($postId, $author, $email, $comment)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('INSERT INTO comments(post_id, author, email, comment, comment_date) VALUES(?, ?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $email, $comment));
	    return $affectedLines;
	}
	//Signalement d'un commentaire existant
	public function badComment($commentId)
	{
	    $db = $this->dbConnect();
	    //Mis à jour des champs niveau de signalement (+1) et date du dernier signalement (date au moment du signalement)
	    $comments = $db->prepare('UPDATE comments SET niveau_signalement = niveau_signalement + 1, date_dernier_signalement = NOW() WHERE id = ?');
	    $badComment = $comments->execute(array($commentId));
	    
	    return $badComment;
	}
}