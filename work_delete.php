<?php
if(!isset($_SESSION)) {session_start();}
include "db.php";

$pindex = $_REQUEST['pindex'];
$windex = $_REQUEST['windex'];
$wid = $_REQUEST['wid'];

$wnum_path = "/project/".$pindex."/pInfo/wnum";
$delete_path = "/project/".$pindex."/things/".$windex;
$wname_path = "/project/".$pindex."/things/".$windex."/wname";
$wname = $firebase->get($wname_path);
$wname = explode("\"", $wname)[1];
$wnum = $firebase->get($wnum_path);
$wnum--;
$firebase->set($wnum_path,$wnum);
$firebase->delete($delete_path);
if($wid != '0'){
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
	$mdelete_path = "/project/".$pindex."/member/".$i."/work/".$wname;
	$firebase->delete($mdelete_path);
}
?>
<script>alert("일감 삭제 완료!");history.back();history.back();</script>