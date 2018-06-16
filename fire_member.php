<?php
if(!isset($_SESSION)) {session_start();}
include "db.php";
$pindex = $_REQUEST['pindex'];
$pmindex = $_REQUEST['pmindex'];
$pmid = $_REQUEST['pmid'];

$pmdelete_path = "/project/".$pindex."/member/".$pmindex;
$pname_path = "/project/".$pindex."/pinfo/pname";
$ucount_path = "/user/".$pmid."/project/count";
$pnum_path = "/project/".$pindex."/pInfo/numpeople";
$i_path = "/user/".$pmid."/project/increase";

$pname = $firebase->get($pname_path);
$i = $firebase->get($i_path);
$ucount = $firebase->get($ucount_path);
$pnum = $firebase->get($pnum_path);
$ucount--;
$pnum--;

$m = 1;
for($m; $m<=$i; $m++){
	$compare_path = "/user/".$pmid."/project/".$m."/index";
	$compare = $firebase->get($compare_path);
	if($pindex == $compare){
		break;
	}
}

$udelete_path = "/user/".$pmid."/project/".$m;

$firebase->delete($pmdelete_path);
$firebase->delete($udelete_path);
$firebase->set($ucount_path, $ucount);
$firebase->set($pnum_path, $pnum);
?>
<script>alert("방출 완료!"); history.back();</script>