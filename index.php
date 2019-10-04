<?php

session_start();

require('controller/backendcontroller.php');
require('controller/frontendcontroller.php');

try {
    	if (isset($_SESSION['id'])){
        	backendController();
    	}
  		else {
      		frontendController();	 
    	}
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
