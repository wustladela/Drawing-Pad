<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	if(isset($_SESSION['username'])){
		$token = htmlentities($_POST['token']);
		if($token!=$_SESSION['token']){
		echo json_encode(array("status"=>"forgeryattempt", "token"=>$token, "session"=>$_SESSION['token']));
			exit;
		}
		$edit = htmlentities($_POST['edit']);
		//$edit = false;
		$username = $_SESSION['username'];
		if($edit=="false"){
			$name = htmlentities($_POST['name']);
		}
		
		$time = htmlentities($_POST['time']);
		$clickX = htmlentities($_POST['clickX']);
		//echo $clickX;
		$clickX = explode(',', $clickX);
		//echo $clickX;
		$clickY = htmlentities($_POST['clickY']);
		$clickY = explode(',', $clickY);
		$clickDrag = htmlentities($_POST['clickDrag']);
		$clickDrag = explode(',', $clickDrag);
		$clickColor = htmlentities($_POST['clickColor']);
		$clickColor = explode(',', $clickColor);
		$clickSize = htmlentities($_POST['clickSize']);
		$clickSize = explode(',', $clickSize);
		$m = new MongoClient();
		$db = $m->module8;
		if($edit=="true"){

			$name = $_SESSION['name'];

			$db->drawings->remove(array("username" => $username, "name" => $name));
		}
		if($_POST['name']!=""){
			$name = htmlentities($_POST['name']);
		}
		$db->drawings->insert(array("username" => $username, "name" => $name, "time"=>$time, "clickX"=>$clickX, "clickY"=>$clickY, "clickDrag"=>$clickDrag, "clickColor"=>$clickColor, "clickSize"=>$clickSize));
		echo json_encode(array("status"=>"success"));
	}else{
		echo json_encode(array("status"=>"fail"));
	}

?>