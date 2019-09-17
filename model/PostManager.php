<?php

require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPost($postId)
    {
        $db = $this->dbConnect();  
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}