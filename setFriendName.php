<?php
ini_set("session.cookie_httponly", 1);
session_start();
$_SESSION['view_friend'] = true;
$friend = htmlentities($_POST['inputName']);
$username = $_SESSION['username'];
$m = new MongoClient();
$db = $m->module8;
$data = $db->friends->findOne(array("user"=> $username, "friend"=> $friend), array("friend"=>1));
if($data){
	$_SESSION['friend_name'] = $friend; 
	echo json_encode(array("status"=>"success"));
}else{
	echo json_encode(array("status"=>"fail"));
}


?>