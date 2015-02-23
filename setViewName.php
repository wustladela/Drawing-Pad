<?php
ini_set("session.cookie_httponly", 1);
session_start();
$_SESSION['name'] = htmlentities($_POST['name']);
echo json_encode(array("status"=>"success"));
?>