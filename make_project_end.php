<?php

	if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
	include 'db.php';

	$pname = $_POST["pname"];
	$goal = $_POST["goal"];
	$maxpeople = (int)$_POST["maxPeople"];
	$beginline = $_POST["beginline"];
	$deadline = $_POST["deadline"];
	$info = $_POST["info"];

	if(empty($pname)){
		?><script>alert("프로젝트 제목 누락!");location.replace("make_project.php");</script><?php
	}elseif(empty($goal)){
		?><script>alert("프로젝트 목표 누락!");location.replace("make_project.php");</script><?php
	}elseif(empty($beginline)){
		?><script>alert("프로젝트 시작날짜 누락!");location.replace("make_project.php");</script><?php
	}elseif(empty($deadline)){
		?><script>alert("프로젝트 종료날짜 누락!");location.replace("make_project.php");</script><?php
	}elseif(empty($info)){
		?><script>alert("프로젝트 설명 누락!");location.replace("make_project.php");</script><?php
	}else{
		$count_path = "/project/increase";
		$index = $firebase->get($count_path);
		$index++;
		$firebase->set($count_path,$index);

		$user_count_path = "/user/".$_SESSION['id']."/project/count";	//test1 대신 세션이나 그런걸로해서 현재 사용자 아이디
		$user_increase_path = "/user/".$_SESSION['id']."/project/increase";

		$user_count = $firebase->get($user_count_path);
		$user_increase = $firebase->get($user_increase_path);
		$user_count++;
		$user_increase++;
		$firebase->set($user_count_path,$user_count);
		$firebase->set($user_increase_path,$user_increase);


		$user_isLeader_path = "/user/".$_SESSION['id']."/project/".$user_increase."/isLeader";	//test1 대신 세션이나 그런걸로해서 현재 사용자 아이디
		$user_pname_path = "/user/".$_SESSION['id']."/project/".$user_increase."/pname";	//test1 대신 세션이나 그런걸로해서 현재 사용자 아이디
		$user_index_path = "/user/".$_SESSION['id']."/project/".$user_increase."/index";	//test1 대신 세션이나 그런걸로해서 현재 사용자 아이디



		$firebase->set($user_isLeader_path, true);
		$firebase->set($user_pname_path, $pname);
		$firebase->set($user_index_path, $index);

		$member_id_path = "/project/".$index."/member/".$_SESSION['id']."/id";	//여기서 세션이나 그런거 써서 현재 사용자정보 받아와야됨
		$member_isLeader_path = "/project/".$index."/member/".$_SESSION['id']."/isLeader";	//여기서 세션이나 그런거 써서 현재 사용자정보 받아와야됨

		$firebase->set($member_id_path, $_SESSION['id']);	//여기서 세션이나 그런거 써서 현재 사용자정보 받아와야됨
		$firebase->set($member_isLeader_path, true);

		$pname_path = "/project/".$index."/pInfo/pname";
		$goal_path = "/project/".$index."/pInfo/goal";
		$maxpeople_path = "/project/".$index."/pInfo/maxpeople";
		$numpeople_path = "/project/".$index."/pInfo/numpeople";
		$beginline_path = "/project/".$index."/pInfo/beginline";
		$deadline_path = "/project/".$index."/pInfo/deadline";
		$info_path = "/project/".$index."/pInfo/info";
		$leader_path = "/project/".$index."/pInfo/leader";
		$status_path = "/project/".$index."/pInfo/status";
		$index_path = "/project/".$index."/pInfo/index";
		$wincrease_path = "/project/".$index."/things/increase";
			
		$firebase->set($pname_path, $pname);
		$firebase->set($goal_path, $goal);
		$firebase->set($maxpeople_path, $maxpeople);
		$firebase->set($numpeople_path, 1);
		$firebase->set($beginline_path, $beginline);
		$firebase->set($deadline_path, $deadline);
		$firebase->set($info_path, $info);
		$firebase->set($leader_path, $_SESSION['id']);	//여기서 세션이나 그런거 써서 현재 사용자정보 받아와야됨
		$firebase->set($status_path, "모집중");
		$firebase->set($index_path, $index);
		$firebase->set($wincrease_path, 0);

		$check_path = "/check/signup/".$index."/leader";
		$firebase->set($check_path, $_SESSION['id']);

		?><script>alert("프로젝트 생성 완료!"); location.replace("project_board.php");</script><?php
	}


?>