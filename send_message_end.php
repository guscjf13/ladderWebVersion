<?php
	include "db.php";

	$index=$_POST['index'];
	$userid=$_SESSION['id'];
	$mid=$_POST['mid'];
	$mtitle=$_POST['mtitle'];
	$mcontent=$_POST['mcontent'];
	$time_send=new DateTime();
	echo $index,$mid,$userid;
	$i=1;
	do{
		$id_path="/project/".$index."/member/".$i."/id";
		$id=$firebase->get($id_path);
		if($id=="\"".$mid."\""){
			break;
		}
		$i++;
		$m_path="/project/".$index."/member/".$i;
		$m=$firebase->get($m_path);
	}while($m!="null");

	$count_path = "/project/".$index."/member/".$i."/rcvmsg/increase";
	$count=$firebase->get($count_path);
	$ddd=$count+1;
	$firebase->set($count_path, $ddd);

	$userid_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/userid";
	$timesend_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/time_send";
	$mtitle_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/title";
	$mcontent_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/content";

	$firebase->set($userid_path,$userid);
	$firebase->set($timesend_path,$time_send->format('c'));
	$firebase->set($mtitle_path,$mtitle);
	$firebase->set($mcontent_path,$mcontent);
	
	
	
?>