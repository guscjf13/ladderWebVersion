<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";

$id = $_SESSION['id'];
$index = $_REQUEST['index'];
$path = "/check/signup/".$index."/id/".$id;

$firebase->delete($path);
?><script>alert("초대 거절!"); history.back();</script><?php
?>