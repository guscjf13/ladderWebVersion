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
		#modifyBtn {
			margin: 20px 0 0 170px;
			width: 100px;
			height: 50px;
			border: 0;
			border-style: none;
			background-image: url('modify.png');
			background-size: cover;
		}
		#modifyBtn:hover {
			background-image: url('modify_hover.png');
			cursor: pointer;
		}
		#backBtn {
			margin: 20px 0 0 20px;
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
		#deleteBtn {
			margin: 20px 0 0 20px;
			width: 100px;
			height: 50px;
			border: 0;
			border-style: none;	
			background-image: url('delete.png');
			background-size: cover;	
		}
		#deleteBtn:hover {
			background-image: url('delete_hover.png');
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
	
    <form id=message_form action="work_edit.php" method="post">
	<table boder="0" style="margin: 0 auto; width: 400px; border-collapse: collapse;">
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>담당자</h3></th>
			<th>
				<select id=mid name=mid>
					<?php
						$i=1;
						?>
						<option value=0>지정안함</option>
						<?php
						do{
							$rid_path="/project/".$pindex."/member/".$i."/id";
							$r_id=$firebase->get($rid_path);
							$r = explode("\"",$r_id)[1];
							?><option value=<?php echo $r_id;?>><?php echo $r;?></option><?php 
							$i++;
							$m_path="/project/".$pindex."/member/".$i;
							$m=$firebase->get($m_path);
						}while($m!="null");
					?>
				</select>
			</th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>기간</h3></th>
			<th><?php echo $begin?>&nbsp~&nbsp<input id=deadline type=date name=deadline style="width: 200px; text-align:center; margin-left: 10px" value="<?php echo $dead?>"></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>제목</h3></th>
			<th><input id=wtitle name=wtitle type=text value="<?php echo $wname?>"></th>
		</tr>
		<tr style="height: 200px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>내용</h3></th>
			<th><input type=textarea  id=wcontent name=wcontent  rows=9 cols=20 value="<?php echo $content?>"/></th>
		</tr>
		<input type="hidden" name="pindex" value="<?php echo $pindex?>">
		<input type="hidden" name="windex" value="<?php echo $windex?>">
		<input type="hidden" name="realwname" value="<?php echo $wname?>">
		<input type="hidden" name="beginline" value="<?php echo $begin?>">
		<input type="hidden" name="state" value="<?php echo $state?>">
		<input type="hidden" name="realid" value="<?php echo $wid?>">
	</table>
	<input id=modifyBtn type=submit value="">
	<input id=backBtn type=button Onclick="history.back();">
	<input id="deleteBtn" type=button Onclick="location.replace('work_delete.php?pindex=<?php echo $pindex?>&windex=<?php echo $windex?>&wid=<?php echo $wid?>')" value="">
	</form>

</body>

</html>