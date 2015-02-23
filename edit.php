<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	if((isset($_SESSION['name']))&&($_SESSION['edit']==true)){
		$username = $_SESSION['username'];
		$name = $_SESSION['name'];
		$m = new MongoClient();
		$db = $m->module8;
		$data = $db->drawings->findOne(array("username" => $username, "name" => $name), array("clickX" => 1, "clickY" => 1, "clickDrag" => 1, "clickColor" => 1, "clickSize" => 1));
		if($data){
			$clickX = $data['clickX'];
			$clickY = $data['clickY'];
			$clickDrag = $data['clickDrag'];
			$clickColor = $data['clickColor'];
			$clickSize = $data['clickSize'];
			$_SESSION['edit'] = false;
			echo json_encode(array("status"=>"success", "name"=>$name, "clickX"=>$clickX, "clickY"=>$clickY, "clickDrag"=>$clickDrag, "clickColor"=>$clickColor, "clickSize"=>$clickSize, "token"=>$_SESSION['token']));
		}else{
			echo json_encode(array("status"=>"fail"));
		}
	}else if((isset($_SESSION['view_friend']))&&($_SESSION['view_friend']==true)){
		$username = $_SESSION['friend_name'];
		$name = $_SESSION['name'];
		$m = new MongoClient();
		$db = $m->module8;
		$data = $db->drawings->findOne(array("username" => $username, "name" => $name), array("clickX" => 1, "clickY" => 1, "clickDrag" => 1, "clickColor" => 1, "clickSize" => 1));
		if($data){
			$clickX = $data['clickX'];
			$clickY = $data['clickY'];
			$clickDrag = $data['clickDrag'];
			$clickColor = $data['clickColor'];
			$clickSize = $data['clickSize'];
			$_SESSION['edit'] = false;
			echo json_encode(array("status"=>"view_friend", "name"=>$name, "clickX"=>$clickX, "clickY"=>$clickY, "clickDrag"=>$clickDrag, "clickColor"=>$clickColor, "clickSize"=>$clickSize, "token"=>$_SESSION['token']));
		}else{
			echo json_encode(array("status"=>"fail"));
		}	
	}else{
		echo json_encode(array("status"=>"notedit", "token"=>$_SESSION['token']));
	}
	
}else{
	echo json_encode(array("status"=>"notloggedin"));
}
?>