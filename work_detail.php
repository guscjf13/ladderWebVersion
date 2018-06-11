<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>

<head>
	<style>
		#message_logo {
			width: 80px;
			height: 80px;
			background-size: cover;
			margin: 5px auto;
		}
		#backBtn {
			margin: 20px 0 0 210px;
			width: 100px;
			height: 50px;
			border: 0;
			border-style: none;
			background-image: url('back.png');
			background-size: cover;
		}
		#backBtn:hover {
			background-image: url('back_hover.png');
			cursor: pointer;
		}
	</style>
</head>

<body>

	<?php
		include "db.php";
		$pindex=$_REQUEST['pindex'];
		$windex=$_REQUEST['windex'];
		$id=$_SESSION['id'];

		$wname_path="/project/".$pindex."/things/".$windex."/wname";
		$begin_path="/project/".$pindex."/things/".$windex."/beginline";
		$dead_path="/project/".$pindex."/things/".$windex."/deadline";
		$content_path="/project/".$pindex."/things/".$windex."/content";
		$state_path="/project/".$pindex."/things/".$windex."/state";
		$wid_path="/project/".$pindex."/things/".$windex."/id";

	   	$wname=$firebase->get($wname_path);
	   	$content=$firebase->get($content_path);
	   	$begin=$firebase->get($begin_path);
	   	$dead=$firebase->get($dead_path);
	   	$state=$firebase->get($state_path);
	   	$wid=$firebase->get($wid_path);

	   	$wname=explode("\"", $wname)[1];
	   	$content=explode("\"", $content)[1];
	   	$begin=explode("\"", $begin)[1];
	   	$dead=explode("\"", $dead)[1];
	   	$wid=explode("\"", $wid)[1];
	?>

	<?php if($state == 3){?>
            <div id=message_logo style="background-image: url('done2.png');"></div>
        	<?php }elseif($state == 2){?>
        	<div id=message_logo style="background-image: url('issue2.png');"></div>
        	<?php }elseif($state == 1){?>
        	<div id=message_logo style="background-image: url('working3.png');"></div>
        	<?php }else{?>
        	<div id=message_logo style="background-image: url('finding.png');"></div>
        	<?php }?>
	

	<table boder="0" style="margin: 0 auto; width: 350px; border-collapse: collapse;">
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>담당자</h3></th>
			<th><?php echo $id?></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>기간</h3></th>
			<th><?php echo $begin?>&nbsp~&nbsp<?php echo $dead?></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>제목</h3></th>
			<th><?php echo $wname?></th>
		</tr>
		<tr style="height: 200px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>내용</h3></th>
			<th><?php echo $content?></th>
		</tr>
	</table>
	<?php if($id==$wid){?>
	<input id=doneBtn type=button Onclick="location.replace('work_done.php');" value="완료">
	<?php }?>

</body>

</html>
