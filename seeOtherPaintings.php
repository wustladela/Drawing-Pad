<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	$username = $_SESSION['username'];
	$searchName = htmlentities($_POST['inputName']);
	$m = new MongoClient();
	$db = $m->module8;
	$data = $db->drawings->find(array("username" => $username), array("name" => 1, "time" => 1));
	$i=0;
	foreach($data as $doc){
		$drawingNames[$i] = $doc['name'];
		$drawingTimes[$i]= $doc['time'];
		$i++;
	}
	
	if($drawingNames!=null){
		echo json_encode(array("status"=>"success", "name"=>$drawingNames, "time"=>$drawingTimes));
	}else{
		echo json_encode(array("status"=>"fail"));
	}
?>