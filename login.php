<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);

	$m = new MongoClient();
	$db = $m->module8;
	$crypt_pass = crypt ($password, '$1$awagawag$');
	$data = $db->users->findOne(array("username"=> $username, "password"=> $crypt_pass), array("username"=>1));
	

	if($data){
		$user = (string)$data['username'];
		$_SESSION['username']=$user;
		$_SESSION['token'] = substr(md5(rand()), 0, 10);
		echo json_encode(array("status"=>"success", "username"=>$user, "token"=>$_SESSION['token']));
	}else{
		echo json_encode(array("status"=>"fail"));
	}

?>