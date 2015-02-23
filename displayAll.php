<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	if((isset($_SESSION['view_friend']))&&($_SESSION['view_friend']==true)){
		$username = $_SESSION['friend_name'];
		$m = new MongoClient();
		$db = $m->module8;
		$data = $db->drawings->find(array("username" => $username), array("name" => 1, "time" => 1))->sort(array("time" => -1));
		$i=0;
		if($data){
			$drawingNames = array();
			$drawingTimes = array();
			foreach($data as $doc){
				$drawingNames[$i] = $doc['name'];
				$drawingTimes[$i]= $doc['time'];
				$i++;
			}
			echo json_encode(array("status"=>"view_friend", "name"=>$drawingNames, "time"=>$drawingTimes, "friend"=>$username));
		}else{
			echo json_encode(array("status"=>"fail"));
		}
	}else{
		$username = $_SESSION['username'];
		$m = new MongoClient();
		$db = $m->module8;
		$data = $db->drawings->find(array("username" => $username), array("name" => 1, "time" => 1))->sort(array("time" => -1));
		$i=0;
		if($data){
			$drawingNames = array();
			$drawingTimes = array();
			foreach($data as $doc){
				$drawingNames[$i] = $doc['name'];
				$drawingTimes[$i]= $doc['time'];
				$i++;
			}
			echo json_encode(array("status"=>"success", "name"=>$drawingNames, "time"=>$drawingTimes));
		}else{
			echo json_encode(array("status"=>"fail"));
		}
	}
	
?>