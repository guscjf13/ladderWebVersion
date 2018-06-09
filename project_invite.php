<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";

$invite_id = $_POST['invite_id'];
$index = $_POST['index'];

$leader_path = "/check/signup/".$index."/leader";
$leader = $firebase->get($leader_path);
$leader = explode("\"", $leader)[1];

$increase_path = "/project/".$index."/member/increase";
$increase = $firebase->get($increase_path);

$exist_path = "/check/signup/".$index."/id/".$invite_id;
$exist = $firebase->get($exist_path);

$flag = true;
for($m=1;$m<=$increase;$m++){
	$member_path = "/project/".$index."/member/".$m."/id";
	$member = $firebase->get($member_path);
	$member = explode("\"", $member)[1];
	if(strcmp($invite_id,$member) == 0){
		$flag = false;
		break;
	}
}
if($flag == false){
	?><script>alert("현재 팀원은 초대 대상이 아닙니다!");</script>
	<script>history.back();</script><?php
}elseif($exist == 2){
	?><script>alert("이미 초대한 사람입니다!");</script>
	<script>history.back();</script><?php
}elseif(strcmp($invite_id,$leader) == 0){
	?><script>alert("자기자신은 초대 할 수 없습니다!");</script>
	<script>history.back();</script><?php
}else{
	$path = "/user/";
	$array = $firebase->get($path);
	$array = explode("}},", $array);
	$i=0;
	$flag=false;
	while($array[$i] != null){
		$id = explode("\"", $array[$i])[1];
		if($invite_id == $id){
			$flag = true;
			break;
		}
		$i++;
	}
	if($flag == true){
		$invite_path = "/check/signup/".$index."/id/".$invite_id;
		$firebase->set($invite_path, 2);		//1은 참가신청 2는 초대
		?><script>alert("초대 완료!");</script>
		<script>history.back();</script><?php
	}else{
		?><script>alert("존재하지 않는 회원입니다!");</script>
		<script>history.back();</script><?php
	}
}
?>