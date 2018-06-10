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
		#answerBtn {
			margin: 20px 20px 20px 140px;
			width: 100px;
			height: 50px;
			background-image: url('answer.png');
			background-size: cover;
			float: left;
		}
		#answerBtn:hover {
			background-image: url('answer_hover.png');
		}
		#backBtn {
			margin: 20px 20px;
			width: 100px;
			border: 0;
			border-style: none;
			height: 50px;
			float: left;
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
		$m_index=$_REQUEST['m_index'];
		$m_i=$_REQUEST['m_i'];
		$userid_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/userid";
		$title_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/title";
		$content_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/content";
	   	$timesend_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/time_send";

	  	$userid=$firebase->get($userid_path);
	   	$title=$firebase->get($title_path);
	   	$content=$firebase->get($content_path);
	   	$time_send=$firebase->get($timesend_path);

	   	$u=explode("\"", $userid)[1];
	   	$title=explode("\"", $title)[1];
	   	$content=explode("\"", $content)[1];
	   	$time_send=explode("\"", $time_send)[1];
	?>

	<div id=message_logo>
	</div>

	<table boder="0" style="margin: 0 auto; width: 350px; border-collapse: collapse;">
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>보낸 사람</h3></th>
			<th><?php echo $u?></th>
		</tr>
		<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
			<th><h3>받은 시각</h3></th>
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

	<a href="reply_message.php?index=<?php echo $index?>&m_index=<?php echo $m_index?>&m_i=<?php echo $m_i?>">
		<div id=answerBtn> </div>
	</a>
	<input id=backBtn type=button Onclick="history.back();">

</body>

</html>
