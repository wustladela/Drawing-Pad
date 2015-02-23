<?php
session_start();
if(isset($_SESSION['username'])){
	$added = false;
	$nonExist = false;
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['newName']);
	$m = new MongoClient();
	$db = $m->module8;
	$collection = $db->friends;
	//check if exists
	$checkExistUser = $db->users->findOne(array("username"=>$searchName));
	//check if in friend list
	$checkFriendList = $collection->findOne(array("user" => $username, "friend" => $searchName));
	//check if the requesting person has already sent the current user a friend request
	$checkRequested = $db->requests->findOne(array("from"=>$searchName, "to"=>$username));
	//sending request to a completely new friend, generate a new request
	if (!$checkExistUser){
	$nonExist=true;
	}
	//send request
	if (!$checkFriendList and !$checkRequested and $checkExistUser){
	//$collection->insert(array("user"=>$username, "friend"=>$searchName));
	$db->requests->insert(array("from"=>$username, "to"=>$searchName));
	$added=true;
	}
	//responding to a friend request; no new request generated and delete old request
	else if (!$checkFriendList and $checkRequested){
	$collection->insert(array("user"=>$username, "friend"=>$searchName));
	$collection->insert(array("user"=>$searchName, "friend"=>$username));
	$db->requests->remove(array("from"=>$searchName, "to"=>$username));
	$added=true;
	}
	if($added and !$nonExist){
		echo json_encode(array("status"=>"success"));
	}
	else if($nonExist){
		echo json_encode(array("status"=>"nonExist"));
	}
	else{
		echo json_encode(array("status"=>"failed"));
	}
}
?>