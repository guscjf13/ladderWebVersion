<?php
if(!isset($_SESSION)) {session_start();}
include "db.php";
$pindex=$_REQUEST['pindex'];
$windex=$_REQUEST['windex'];
$id=$_SESSION['id'];

$wname_path = "/project/".$pindex."/things/".$windex."/wname";
$wstate_path = "/project/".$pindex."/things/".$windex."/state";
$pmincrease_path = "/project/".$pindex."/member/increase";
$wname = $firebase->get($wname_path);
$wname = explode("\"", $wname)[1];
$pmincrease = $firebase->get($pmincrease_path);
$i=1;
for($i;$i<=$pmincrease;$i++){
	$same_path = "/project/".$pindex."/member/".$i."/id";
	$same = $firebase->get($same_path);
	$same = explode("\"", $same)[1];
	if($id == $same){
		$mwstate_path = "/project/".$pindex."/member/".$i."/work/".$wname."/state";
		$firebase->set($mwstate_path, 3);
		$firebase->set($wstate_path, 3);
		break;
	}
}
?><script>alert("일감 완료!");window.open('about:blank','_self').self.close();</script><?php
?>