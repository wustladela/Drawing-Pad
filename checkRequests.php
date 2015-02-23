<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	//$added = false;
	$username = $_SESSION['username'];
	//$searchName = htmlentities($_POST['newName']);
	$m = new MongoClient();
	$db = $m->module8;
	$collection = $db->requests;
	$check = $collection->find(array("to" => $username), array("from"=> 1));
	$i = 0;
	if($check){
		$users = array();
		foreach($check as $doc){
			$users[$i] = $doc['from'];
			$i++;
		}	
	}
	if($users!=null){
		echo json_encode(array("status"=>$users));
	}else{
		echo json_encode(array("status"=>"fail"));
	}
}
?>