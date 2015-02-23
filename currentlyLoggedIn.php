<?php
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_SESSION['username'])){
	echo json_encode(array("status"=>"success", "username"=>$_SESSION['username']));
}else{
	echo json_encode(array("status"=>"fail"));
}
?>