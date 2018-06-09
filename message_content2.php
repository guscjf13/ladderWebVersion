<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>
<head>
<style>
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
<table class="list-table" boder="1">
	<tr>
		<th>받는 사람</th>
		<th><?php echo $userid?></th>
	</tr>
	<tr>
		<th>보낸 시각</th>
		<th><?php echo $time_send?></th>
	</tr>
	<tr>
		<th>제목</th>
		<th><?php echo $title?></th>
	</tr>
	<tr>
		<th>내용</th>
		<th><?php echo $content?></th>
	</tr>
</table>
<input type=button value="뒤로 가기" Onclick="history.back();">
</body>
</html>
