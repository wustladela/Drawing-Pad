<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['escapedSearch']);
	$m = new MongoClient();
	$db = $m->module8;
	$collection = $db->friends;
	//$regex = new MongoRegex("/$searchName/");

	//->findOne(array("user" => $username));

	$newFriend = array('$set'=>array("friend" => $addName));
	$collection->insert(array("user"=>$username, "friend"=>$searchName));
	// 	array("user"==>"adela"),
	// 	//array("user"=>"adela"),
	// 	array("friend" => "$searchName")
	// 	); 
	// $update->$data->update(
	// array('user' => $username);
	// array('friend' => $newFriend);
	// 	);	

	//$look = (string)$collection['user'];
	if($collection){
		echo json_encode(array("status"=>"success"));
	}else{
		echo json_encode(array("status"=>"failed"));
	}
}
?>