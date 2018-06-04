<?php 
	if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
	include "db.php"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>메인</title>
	<style type="text/css">
		nav {background-color: yellow;}
		#page_wrapper {background-color: blue;padding: 15px; overflow: auto;}
		#project_info {background-color: green;margin: 15px; float: left;}
		td {text-align: center;}
		#progress_bar {background-color: red; float:right; }
		#text {
		position: absolute;
		top: 100px;
		left: 50%;
		margin: 0px 0px 0px -150px;
		font-size: 18px;
		text-align: center;
		width: 300px;}
		#barbox_a {
		position: absolute;
		top: 130px;
		left: 50%;
		margin: 0px 0px 0px -160px;
		width: 304px;
		height: 24px;
		background-color: black;}
		.per {
		position: absolute;
		top: 130px;
		font-size: 18px;
		left: 50%;
		margin: 1px 0px 0px 150px;
		background-color: #FFFFFF;}
		.bar {
		position: absolute;
		top: 132px;
		left: 50%;
		margin: 0px 0px 0px -158px;
		width: 0px;
		height: 20px;
		background-color: #0099FF;}
		.blank {
		background-color: white;
		width: 300px;}
	</style>
</head>
<body>
<!--아마 include로 탑 바탐 나누는게 좋겠지?-->
<nav>
	메뉴자리이이
</nav>
<div id="page_wrapper">
	<aside id="project_info">
		<?php
		//숫자가 프로젝트 번호
		$index_path="/project_board/1/index";
		$title_path="/project_board/1/title";
		$goal_path="/project_board/1/goal";
		$nump_path="/project_board/1/numpeople";
		$maxp_path="/project_board/1/maxpeople";
		$leader_path="/project_board/1/leader";
		$begin_path="/project_board/1/beginline";
		$dead_path="/project_board/1/deadline";
		$status_path="/project_board/1/status";
            

		$index = $firebase->get($index_path);
		$title = $firebase->get($title_path);
		$goal = $firebase->get($goal_path);
		$nump = $firebase->get($nump_path);
		$maxp = $firebase->get($maxp_path);
		$leader = $firebase->get($leader_path);
		$begin = $firebase->get($begin_path);
		$dead = $firebase->get($dead_path);
		$status = $firebase->get($status_path);
		?>
		<div id="logo">
			<a href=><img src=logo.png style="width: 30%; height: auto;" id="logo_img"></a>
		</div>
		<div id="info">
			<table border=1>
				<tr>
					<th>제목</th><td>임시제목</td><th>리더</th><td>임시리더</td>
				</tr>
				<tr>
					<th>목적</th><td colspan="3">임시목적</td>
				</tr>
				<tr>
					<th>인원</th><td colspan="3">5/10</td>
				</tr>
				<tr>
					<th>기간</th><td colspan="3">2018-06-01~2018-06-02</td>
				</tr>
				<tr>
					<td colspan="4">infoinfoinfo</td>
				</tr>
			</table>			
		</div>
	</aside>
	<div id="progress_bar">
		<div id='text'>진행상황</div>
		<div id='barbox_a'></div>
		<div class='bar blank'></div>
		<div class='per'>0%</div>
	</div>
	<section id="card_section">
		
	</section>
	<section id="board_section">
		
	</section>
</div>
</body>
</html>