<?php

require_once('model/Manager.php');

class AdminManager extends Manager
{
	public function connectAdmin($pseudo, $password)
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
    	if ($isPasswordCorrect) {
	        session_start();
	        $_SESSION['id'] = $resultat['id'];
	        $_SESSION['pseudo'] = $pseudo;
    	}
    	else {
        echo 'Mauvais identifiant ou mot de passe !';
    	}	
	}
}
