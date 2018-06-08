<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	include "db.php";
	include "top_menu.php";
	$index=$_REQUEST['index'];
	$m_index=$_REQUEST['m_index'];
	$m_i=$_REQUEST['m_i'];
	$userid_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/userid";
	$title_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/path";
	$content_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/content";
   	$timesend_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/time_send";

  	$userid=$firebase->get($userid_path);
   	$title=$firebase->get($title_path);
   	$content=$firebase->get($content_path);
   	$time_send=$firebase->get($timesend_path);
?>
<table boder="1">
	<tr>
		<th>보낸 사람</th>
		<th><?php echo $userid?></th>
	</tr>
</table>
</body>
</html>
