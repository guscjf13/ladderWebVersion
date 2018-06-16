<?php
if(!isset($_SESSION)){session_start();}   //세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";

$goal = $_POST['goal'];
$begin = $_POST['beginline'];
$dead = $_POST['deadline'];
$info = $_POST['info'];
$index = $_POST['index'];

$goal_path = "/project/".$index."/pInfo/goal";
$begin_path = "/project/".$index."/pInfo/beginline";
$dead_path = "/project/".$index."/pInfo/deadline";
$info_path = "/project/".$index."/pInfo/info";

$firebase->set($goal_path,$goal);
$firebase->set($begin_path,$begin);
$firebase->set($dead_path,$dead);
$firebase->set($info_path,$info);
?>
<script>alert("프로젝트 정보 수정 완료!");history.back();</script>