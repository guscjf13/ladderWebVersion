<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";

$sign_id = $_SESSION['id'];
(int)$index = $_REQUEST['index'];
$path = "/check/signup/".$index."/id/".$sign_id;

$pincrease_path = "/project/".$index."/member/increase";
$pincrease = $firebase->get($pincrease_path);
$pincrease++;

$new_id_path = "/project/".$index."/member/".$pincrease."/id";
$new_isLeader_path = "/project/".$index."/member/".$pincrease."/isLeader";

$nump_path = "/project/".$index."/pInfo/numpeople";
$maxp_path = "/project/".$index."/pInfo/maxpeople";
$status_path = "/project/".$index."/pInfo/status";
$pname_path = "/project/".$index."/pInfo/pname";

$ucount_path = "/user/".$sign_id."/project/count";
$uincrease_path = "/user/".$sign_id."/project/increase";
$ucount = $firebase->get($ucount_path);
$uincrease = $firebase->get($uincrease_path);
$pname = $firebase->get($pname_path);
$pname = explode("\"", $pname)[1];
$ucount++;
$uincrease++;

$user_path1 = "/user/".$sign_id."/project/".$uincrease."/index";
$user_path2 = "/user/".$sign_id."/project/".$uincrease."/isLeader";
$user_path3 = "/user/".$sign_id."/project/".$uincrease."/pname";

$nump = $firebase->get($nump_path);
$maxp = $firebase->get($maxp_path);

if($nump >= $maxp){
	$firebase->delete($path);
	?><script>alert("최대 인원 초과!"); history.back();</script><?php
}else{
	$nump++;
	$firebase->delete($path);
	$firebase->set($new_id_path, $sign_id);
	$firebase->set($new_isLeader_path, false);
	$firebase->set($nump_path, $nump);
	$firebase->set($user_path2, false);
	$firebase->set($user_path3, $pname);
	$firebase->set($ucount_path, $ucount);
	$firebase->set($uincrease_path, $uincrease);
	$firebase->set($pincrease_path, $pincrease);
	$firebase->set($user_path1, (int)$index);
	if($nump == $maxp){
		$firebase->set($status_path, "마감");
	}
	?><script>alert("참가 완료!"); history.back();</script><?php
}
?>