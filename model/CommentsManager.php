<?php

require_once('model/Manager.php');

class CommentsManager extends Manager
{
	public function getComments($postId)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, niveau_signalement, date_dernier_signalement FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
	    $comments->execute(array($postId));

	    return $comments;
	}

	public function postComment($postId, $author, $email, $comment)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('INSERT INTO comments(post_id, author, email, comment, comment_date) VALUES(?, ?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $email, $comment));
	    return $affectedLines;
	}

	public function badComment($commentId, $postId)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('UPDATE comments SET niveau_signalement = niveau_signalement + 1, date_dernier_signalement = NOW() WHERE id = ? AND post_id = ?');
	    $badComment = $comments->execute(array($commentId, $postId));
	    
	    return $badComment;
	}
}