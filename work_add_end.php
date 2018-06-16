<?php
if(!isset($_SESSION)) {session_start();}
include "db.php";

$wid = $_POST['mid'];
$begin = date('Y-m-d');
$dead = $_POST['deadline'];
$wname = $_POST['wtitle'];
$wcontent = $_POST['wcontent'];
$pindex = $_POST['pindex'];

$tincrease_path = "/project/".$pindex."/things/increase";
$tincrease = $firebase->get($tincrease_path);
$tincrease++;

$newbegin_path = "/project/".$pindex."/things/".$tincrease."/beginline";
$newcontent_path = "/project/".$pindex."/things/".$tincrease."/content";
$newdead_path = "/project/".$pindex."/things/".$tincrease."/deadline";
$newid_path = "/project/".$pindex."/things/".$tincrease."/id";
$newstate_path = "/project/".$pindex."/things/".$tincrease."/state";
$newname_path = "/project/".$pindex."/things/".$tincrease."/wname";
$tt_path = "/project/".$pindex."/pInfo/wnum";
$tt = $firebase->get($tt_path);
$tt++;

if($wid != '0'){
	$i=1;
	do{
		$check_path = "/project/".$pindex."/member/".$i."/id";
		$check = $firebase->get($check_path);
		$check = explode("\"", $check)[1];
		if($check == $wid){
			break;
		}
		$i++;
		$check_path = "/project/".$pindex."/member/".$i."/id";
		$check = $firebase->get($check_path);
	}while($check != 'null');

	$addbegin_path = "/project/".$pindex."/member/".$i."/work/".$wname."/beginline";
	$addcontent_path = "/project/".$pindex."/member/".$i."/work/".$wname."/content";
	$adddead_path = "/project/".$pindex."/member/".$i."/work/".$wname."/deadline";
	$addstate_path = "/project/".$pindex."/member/".$i."/work/".$wname."/state";
	$addwname_path = "/project/".$pindex."/member/".$i."/work/".$wname."/wname";

	$firebase->set($addbegin_path, $begin);
	$firebase->set($addcontent_path, $wcontent);
	$firebase->set($adddead_path, $dead);
	$firebase->set($addstate_path, 1);
	$firebase->set($newstate_path, 1);
	$firebase->set($addwname_path, $wname);
	$firebase->set($newid_path, $wid);
}else{
	$firebase->set($newstate_path, 0);
	$firebase->set($newid_path, (int)$wid);
}
$firebase->set($newbegin_path, $begin);
$firebase->set($newcontent_path, $wcontent);
$firebase->set($newdead_path, $dead);
$firebase->set($newname_path, $wname);

$firebase->set($tincrease_path, $tincrease);
$firebase->set($tt_path, $tt);
?>
<script>alert("일감추가완료!");history.back();history.back();</script>