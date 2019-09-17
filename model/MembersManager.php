<?php

require_once('model/Manager.php');

class MembersManager extends Manager
{
	public function newMember($pseudo, $password, $email)
	{
	    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
	    $db = $this->dbConnect();
	    $members = $db->prepare('INSERT INTO members(groupes_id, pseudo, password, email, date_inscription) VALUES(2, ?, ?, ?, NOW())');
	    $affectedLines = $members->execute(array($pseudo, $pass_hash, $email));

	return $affectedLines;
	}

	public function connectMember($pseudo, $password)
	{
		$db = $this->dbConnect();
		$pseudo = $_POST['pseudo'];
		$req = $db->prepare('SELECT id, password FROM members WHERE pseudo = ?');
		$req->execute(array($pseudo));
		$resultat = $req->fetch();

		$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

		if (!$resultat)
		{
   			echo 'Mauvais identifiant ou mot de passe !';
		}
		else {
    		if ($isPasswordCorrect) {
        		echo 'Vous êtes connecté !';
    		} else {
        	echo 'Mauvais identifiant ou mot de passe !';
    		}
    	}	
	}
}
