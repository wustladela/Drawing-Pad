<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	$deletedRequest = false;
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['deletedRequestFrom']);
	$m = new MongoClient();
	$db = $m->module8;
	$checkMine = $db->requests->findOne(array("from"=>$searchName, "to"=>$username));
	//sending request to a completely new friend, generate a new request
	if ($checkMine){
	//$collection->insert(array("user"=>$username, "friend"=>$searchName));
	$db->requests->remove(array("from"=>$searchName, "to"=>$username));
	$deletedRequest=true;
	}
	//responding to a friend request; no new request generated
	
	if($deletedRequest){
		echo json_encode(array("status"=>"success"));
	}else{
		echo json_encode(array("status"=>"failed"));
	}
}
?>