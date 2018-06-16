<?php
if(!isset($_SESSION)) {session_start();}
include "db.php";

$wid = $_POST['mid'];
$dead = $_POST['deadline'];
$wname = $_POST['wtitle'];
$realwname= $_POST['realwname'];	//원래 이름
$wcontent = $_POST['wcontent'];
$pindex = $_POST['pindex'];
$windex = $_POST['windex'];
$begin = $_POST['beginline'];
$state = $_POST['state'];		//원래 상태
$realid = $_POST['realid'];		//원래 담당자

$newcontent_path = "/project/".$pindex."/things/".$windex."/content";
$newdead_path = "/project/".$pindex."/things/".$windex."/deadline";
$newid_path = "/project/".$pindex."/things/".$windex."/id";
$newname_path = "/project/".$pindex."/things/".$windex."/wname";
$newstate_path = "/project/".$pindex."/things/".$windex."/state";	//수정될 경로

if($wid != '0'){	//담당자가 있으면
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
	}while($check != 'null');		//그 담당자 번호 $i 를 찾고
	$s=1;
	do{
		$check_path = "/project/".$pindex."/member/".$s."/id";
		$check = $firebase->get($check_path);
		$check = explode("\"", $check)[1];
		if($check == $realid){
			break;
		}
		$s++;
		$check_path = "/project/".$pindex."/member/".$s."/id";
		$check = $firebase->get($check_path);
	}while($check != 'null');	//원 주인 번호 $s를 찾고

	$addcontent_path = "/project/".$pindex."/member/".$i."/work/".$wname."/content";
	$adddead_path = "/project/".$pindex."/member/".$i."/work/".$wname."/deadline";
	$addwname_path = "/project/".$pindex."/member/".$i."/work/".$wname."/wname";
	$addstate_path = "/project/".$pindex."/member/".$i."/work/".$wname."/state";
	$addbegin_path = "/project/".$pindex."/member/".$i."/work/".$wname."/beginline";	//그 담당자 아래에 있는 목록경로

	$delete_path = "/project/".$pindex."/member/".$s."/work/".$realwname;	//원 주인 삭제 경로
	$firebase->delete($delete_path); //원 주인 삭제해

	$firebase->set($addcontent_path, $wcontent);
	$firebase->set($adddead_path, $dead);
	$firebase->set($addbegin_path, $begin);
	$firebase->set($addwname_path, $wname);
	$firebase->set($newid_path, $wid);
	if($state == 0){$firebase->set($addstate_path, 1);$firebase->set($newstate_path, 1);}
	else{$firebase->set($addstate_path, (int)$state);$firebase->set($newstate_path, (int)$state);}
}else{
	$i=1;
	do{
		$check_path = "/project/".$pindex."/member/".$i."/id";
		$check = $firebase->get($check_path);
		$check = explode("\"", $check)[1];
		if($check == $realwname){
			break;
		}
		$i++;
		$check_path = "/project/".$pindex."/member/".$i."/id";
		$check = $firebase->get($check_path);
	}while($check != 'null');
	$delete_path = "/project/".$pindex."/member/".$i."/work/".$realwname;
	$firebase->delete($delete_path);
	$firebase->set($newstate_path, 0);
	$firebase->set($newid_path, (int)$wid);
}
$firebase->set($newcontent_path, $wcontent);
$firebase->set($newdead_path, $dead);
$firebase->set($newname_path, $wname);

?>
<script>alert("일감수정완료!");history.back();history.back();</script>