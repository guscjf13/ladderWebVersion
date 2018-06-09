<?php
	if(!isset($_SESSION)){session_start();}
	include "db.php";

	$index=$_POST['index'];
	$userid=$_SESSION['id'];
	$mid=$_POST['mid'];
	$mtitle=$_POST['mtitle'];
	$mcontent=$_POST['mcontent'];
	$m_index=$_POST['m_index'];
	$read=false;
	$time_send=new DateTime();
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

	$rcount_path = "/project/".$index."/member/".$i."/rcvmsg/increase";
	$scount_path="/project/".$index."/member/".$m_index."/sendmsg/increase";
	$r_count=$firebase->get($rcount_path);
	$s_count=$firebase->get($scount_path);
	$ddd=$r_count+1;
	$dddd=$s_count+1;
	$firebase->set($rcount_path, $ddd);
	$firebase->set($scount_path, $dddd);

	$ruserid_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/userid";
	$rread_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/isread_rcv";
	$rtimesend_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/time_send";
	$rmtitle_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/title";
	$rmcontent_path="/project/".$index."/member/".$i."/rcvmsg/".$ddd."/content";

	$suserid_path="/project/".$index."/member/".$m_index."/sendmsg/".$dddd."/userid";
	$stimesend_path="/project/".$index."/member/".$m_index."/sendmsg/".$dddd."/time_send";
	$sread_path="/project/".$index."/member/".$m_index."/sendmsg/".$dddd."/isread_rcv";
	$smtitle_path="/project/".$index."/member/".$m_index."/sendmsg/".$dddd."/title";
	$smcontent_path="/project/".$index."/member/".$m_index."/sendmsg/".$dddd."/content";

	$firebase->set($ruserid_path,$userid);
	$firebase->set($rtimesend_path,$time_send->format('Y-m-d H:i:s'));
	$firebase->set($rmtitle_path,$mtitle);
	$firebase->set($rmcontent_path,$mcontent);
	$firebase->set($rread_path,$read);
	
	$firebase->set($suserid_path,$mid);
	$firebase->set($stimesend_path,$time_send->format('Y-m-d H:i:s'));
	$firebase->set($smtitle_path,$mtitle);
	$firebase->set($smcontent_path,$mcontent);
	$firebase->set($sread_path,$read);
	?><script >alert("쪽지를 보냈습니다.")</script>
	<script> location.replace("message.php?index=<?php echo $index?>") </script>
?>