<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$m = new MongoClient();
	$db = $m->module8;
	$data = $db->friends->find(array("user" => $username), array("friend" => 1));
	$i = 0;
	if($data){
		$friends = array();
		foreach($data as $doc){
			$friends[$i] = $doc['friend'];
			$i++;
		}
		echo json_encode(array("status"=>"success", "friends"=>$friends));
	}else{
		echo json_encode(array("status"=>"fail"));
	}
}else{
	echo json_encode(array("status"=>"notloggedin"));
}
?>