<?php
	if(!isset($_SESSION)){session_start();}
	include("db.php");

	$index = $_REQUEST['index'];
	$id = $_SESSION['id'];
	$path = "/check/signup/".$index."/id/".$id;

	$firebase->set($path, 1);

	?><script>alert("신청 완료!");
	history.back();</script><?php
?>