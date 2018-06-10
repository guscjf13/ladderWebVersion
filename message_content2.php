<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>

<head>
	<style>
		#message_logo {
			width: 180px;
			height: 80px;
			background-image: url('message_logo.png');
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
		}
	</style>
</head>

<body>

	<?php
		include "db.php";
		$index=$_REQUEST['index'];
		$mm_index=$_REQUEST['mm_index'];
		$mm_i=$_REQUEST['mm_i'];
		$userid_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/userid";
		$title_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/title";
		$content_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/content";
	   	$timesend_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/time_send";

	  	$userid=$firebase->get($userid_path);
	   	$title=$firebase->get($title_path);
	   	$content=$firebase->get($content_path);
	   	$time_send=$firebase->get($timesend_path);

	   	$userid=explode("\"", $userid)[1];
	   	$title=explode("\"", $title)[1];
	   	$content=explode("\"", $content)[1];
	   	$time_send=explode("\"", $time_send)[1];
	?>

	<div id=message_logo>
	</div>

	<table boder="0" style="margin: 0 auto; width: 350px; border-collapse: collapse;">
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>받은 사람</h3></th>
			<th><?php echo $userid?></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>보낸 시각</h3></th>
			<th><?php echo $time_send?></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>제목</h3></th>
			<th><?php echo $title?></th>
		</tr>
		<tr style="height: 200px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>내용</h3></th>
			<th><?php echo $content?></th>
		</tr>
	</table>

	<input id=backBtn type=button Onclick="history.back();">

</body>

</html>
