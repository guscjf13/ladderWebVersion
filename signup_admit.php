<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";

$sign_id = $_REQUEST['sign_id'];
$index = $_REQUEST['index'];
$path = "/check/signup/".$index."/id/".$sign_id;

$new_id_path = "/project/".$index."/member/".$sign_id."/id";
$new_isLeader_path = "/project/".$index."/member/".$sign_id."/isLeader";

$nump_path = "/project/".$index."/pInfo/numpeople";
$maxp_path = "/project/".$index."/pInfo/maxpeople";
$status_path = "/project/".$index."/pInfo/status";
$pname_path = "/project/".$index."/pInfo/pname";

$count_path = "/users/".$sign_id."/project/count";
$a = $firebase->get($count_path);
$pname = $firebase->get($pname_path);
$user_path1 = "/users/".$sign_id."/project/".$a."/index";
$user_path2 = "/users/".$sign_id."/project/".$a."/isLeader";
$user_path3 = "/users/".$sign_id."/project/".$a."/".$pname;

$nump = $firebase->get($nump_path);
$maxp = $firebase->get($maxp_path);

if($nump >= $maxp){
	?><script>alert("최대 인원 초과!"); location.reload();</script><?php
}else{
	$nump++;
	$firebase->delete($path);
	$firebase->set($new_id_path, $sign_id);
	$firebase->set($new_isLeader_path, false);
	$firebase->set($nump_path, $nump);
	$firebase->set($user_path1, $index);
	$firebase->set($user_path2, false);
	$firebase->set($user_path3, $pname);
	if($nump == $maxp){
		$firebase->set($status_path, "꽉참");
	}
	?><script>alert("승인 완료!"); location.reload();</script><?php
}



?>