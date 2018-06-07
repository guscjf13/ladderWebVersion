<?php
	if(!isset($_SESSION)){session_start();}
	include("db.php");

	$index = $_REQUEST['index'];
	$id = $_SESSION['id'];
	$path = "/check/signup/".$index."/id/".$id;

	$firebase->delete($path);

	?><script>alert("신청 취소 완료!")
	location.reload()</script><?php
?>