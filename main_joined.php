<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		a {
			text-decoration: none;
			color: black;
		}
		/*왼쪽 메뉴 스타일들*/
		#left_menu {
			width: 300px;
			height: 850px;
			float:left;
			overflow: hidden;
		}
		#left_project_logo {
			width: 200px;
			height: 200px;
			margin: 30px 50px 30px 50px;
			background-color: red;
			border-radius: 100px;
			text-align: center;
		}
		#left_project_info {
			border-radius: 50px;
			width: 240px;
			height: 540px;
			margin: 30px;
			padding-top: 30px;
			background-color: #686868;
		}
		#left_project_select {
			width: 200px;
			height: 30px;
			margin-left: 20px;
			margin-bottom: 30px;
			background-color: white;
			line-height: 350px;
			text-align: center;			
		}
		#left_project_select_btn {
			width: 50px;
			height: 30px;
			float: left;
		}
		#left-project-detail {
			width: 200px;
			height: 360px;
			margin-left: 20px;
			margin-bottom: 30px;
			background-color: white;
			line-height: 250px;
			text-align: center;
		}
		#left_project_manage {
			width: 180px;
			height: 50px;
			margin-left: 30px;
			line-height: 50px;
			text-align: center;
			background-color: white;
		}

		/*오른쪽 메뉴 스타일들*/
		#right_menu {
			height: 850px;
			float:right;
		}
		#right_project_processbar {
			height: 100px;
			border-radius: 50px;
			background-color: #B2EBF4;
			margin:25px 25px 25px 0;
		}
		#right_make_error {
			border-radius: 100px;
			display: inline-block;
			width: 700px;
			height: 50px;
			background-color: #686868;
			line-height: 50px;
			text-align: center;
			margin-left: 440px;
		}
		#right_project_board {
			border-radius: 50px;
			height: 275px;
			background-color: #CEF279;
			margin:100px 25px 25px 0;
		}

		</style>
	</head>

	<body>

		<?php
			include "db.php";
			include "top_menu.php";
			$index = $_REQUEST['index'];	//REQUEST로 $index 받아서 넣어주고
			$id = $_SESSION['id'];

                $pname_path="/project/".$index."/pInfo/pname";	//path 설정할때 $index 사용함
                $goal_path="/project/".$index."/pInfo/goal";
                $nump_path="/project/".$index."/pInfo/numpeople";
                $maxp_path="/project/".$index."/pInfo/maxpeople";
                $leader_path="/project/".$index."/pInfo/leader";
                $begin_path="/project/".$index."/pInfo/beginline";
                $dead_path="/project/".$index."/pInfo/deadline";
                $status_path="/project/".$index."/pInfo/status";
                $info_path="/project/".$index."/pInfo/info";

                $pname = $firebase->get($pname_path);
                $goal = $firebase->get($goal_path);
                $nump = $firebase->get($nump_path);
                $maxp = $firebase->get($maxp_path);
                $leader = $firebase->get($leader_path);
                $begin = $firebase->get($begin_path);
                $dead = $firebase->get($dead_path);
                $status = $firebase->get($status_path);
                $info = $firebase->get($info_path);

                $pname = explode("\"", $pname)[1];	//"" 붙는거 없애는작업
                $goal = explode("\"", $goal)[1];
                $leader = explode("\"", $leader)[1];
                $begin = explode("\"", $begin)[1];
                $dead = explode("\"", $dead)[1];
                $status = explode("\"", $status)[1];
                $info = explode("\"", $info)[1];
		?>

		<div id=left_menu>

			<div id=left_project_logo>
				<img src=left_project_logo.png style="width: 200px; height:200px; border-radius: 100px;">
				<div><?php echo $pname;?></div>
			</div>

			<div id=left_project_info>
			
				<div id=left_project_select>
					<form action="main_joined_project_select.php" method="post">
						<select name=project_select style="float: left; width: 150px; height: 30px; text-align: center;">
							<option value="1">프로젝트1</option>
							<option value="2">프로젝트2</option>
							<option value="3">프로젝트3</option>
						</select>
						<input type=submit id=left_project_select_btn value=조회> </input>
					</form>
				</div>

				<div id=left-project-detail>
					<table border=1 cellsapcing=0>
						<tr>
							<th>팀장</th><td><?php echo $leader?></td>
						</tr>
						<tr>
							<th>목표</th><td><?php echo $goal?></td>
						</tr>
						<tr>
							<th><?php echo $begin?>&nbsp~&nbsp<?php echo $dead?></th>
						</tr>
						<tr>
							<td><?php echo $info?></td>
						</tr>
					</table>
				</div>
				<?php if($id == $leader){?>
				<a href=project_manage.php?index=<?php echo $index?>> <div id=left_project_manage> 프로젝트 관리 </div> </a>
				<?php }?>
			</div>

		</div>

		<div id=right_menu>

			<div id=right_project_processbar>
			</div>

			<?php
				make_error_card($index);	//파라미터로 현재 프로젝트 번호 넘겨줘야함
			?>

			<a href=make_error.php id=right_make_error class=top_sub>	오류 등록 </a> 

			<div id=right_project_board>
			</div>

		</div>

		<?php
			include "footer.php";
		?>

	</body>

</html>