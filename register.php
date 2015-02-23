<?php
	$username = (string)htmlentities($_POST['username']);
	$password = (string)htmlentities($_POST['password']);
	$crypt_pass = crypt ($password, '$1$awagawag$');
	$person = array("username" => $username, "password" => $crypt_pass);
	$m = new MongoClient();
	$db = $m->module8;
	$db->users->insert($person);
	echo json_encode(array("status"=>"success", "username"=>$username));
?>