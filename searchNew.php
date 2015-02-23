<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['escapedSearch']);
	$m = new MongoClient();
	$db = $m->module8;
	$regex = new MongoRegex("/.*$searchName.*/gi"); ///$searchName(\w.+%\-){0,25}/i
	$data = $db->users->find(array("username" => $regex));
	$i = 0;
	foreach($data as $doc){
		$users[$i] = $doc['username'];
		$i++;
	}
	
	if($users!=null){
		echo json_encode(array("status"=>"success", "people"=>$users));
	}else{
		echo json_encode(array("status"=>"fail"));
	}
}
?>