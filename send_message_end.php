<?php
	include "db.php";

	$mfrom=$_SESSION['id'];
	$mid=$_POST["mid"];
	$mtitle=$_POST["mtitle"];
	$mcontent=$_POST["mcontent"];
	$when=new DateTime();

	$count_path = "/users/".$mid."/message/count";
	$count=$firebase->get($count_path);
	$index=$count+1;
	echo $count,$index;
	$firebase->update($count_path, $index);

	$mfrom_path="/users/".$mid."/message/".$index."/from";
	$mwhen_path="/users/".$mid."/message/".$index."/when";
	$mtitle_path="/users/".$mid."/message/".$index."/title";
	$mcontent_path="/users/".$mid."/message/".$index."/content";

	$firebase->set($mfrom_path,$mfrom);
	$firebase->set($mwhen_path,$when->format('c'));
	$firebase->set($mtitle_path,$mtitle);
	$firebase->set($mcontent_path,$mcontent);
	?>
	<script>alert("쪽지를 보냈습니다.")</script>
	<script> location.replace("main_not_joined.php") </script>
?>