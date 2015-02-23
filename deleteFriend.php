<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	$deleted = false;
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['deleteName']);
	$m = new MongoClient();
	$db = $m->module8;
	$collection = $db->friends;
	//$newFriend = array('$set'=>array("friend" => $addName));
	$check = $collection->findOne(array("user" => $username, "friend" => $searchName));
	if ($check){
	$collection->remove(array("user"=>$username, "friend"=>$searchName));
	$deleted=true;
	}
	//$look = (string)$collection['user'];
	if($deleted){
		echo json_encode(array("status"=>"success"));
	}else{
		echo json_encode(array("status"=>"fail"));
	}
}
?>