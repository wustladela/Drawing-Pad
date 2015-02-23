<?php
ini_set("session.cookie_httponly", 1);
session_start();
$_SESSION['view_friend'] = false;
$username = $_SESSION['username'];
echo json_encode(array("status"=>"success", "username"=>$username));
?>