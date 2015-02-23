<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$name = htmlentities($_POST['name']);
		$m = new MongoClient();
		$db = $m->module8;
		$db->drawings->remove(array("username" => $username, "name" => $name));
		echo json_encode(array("status"=>"success"));
	}else{
		echo json_encode(array("status"=>"notloggedin"));
	}
	
?>