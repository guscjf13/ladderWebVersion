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
			height: 790px;
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
		}
		#left-project-detail {
			width: 200px;
			height: 360px;
			margin-top: 50px;
			margin-left: 20px;
			background-color: white;
			text-align: center;
		}
		#left_project_manage {
			width: 180px;
			height: 50px;
			border: 3px solid black;
			margin-left: 30px;
			background-size: cover;
			background-image: url('left_project_manage.png')
		}
		#left_project_manage:hover {
			background-image: url('left_project_manage_hover.png')			
		}
		
		/*오른쪽 메뉴 스타일들*/
		#right_menu {
			height: 790px;
			float:right;
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
			height: 210px;
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
				<h1 style="margin-top: 20px"><?php echo $pname;?></h1>
			</div>

			<div id=left_project_info>

				<div id=left-project-detail>
					<table border=0 style="width: 200px; height: 340px; border-collapse: collapse;">
						<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
							<th><h2>팀장</h2></th><td><?php echo $leader?></td>
						</tr>
						<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
							<th><h2>목표</h2></th><td><?php echo $goal?></td>
						</tr>
						<tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
							<th colspan=2><?php echo $begin?>&nbsp~<br>&nbsp<?php echo $dead?></th>
						</tr>
						<tr style="height: 100px;">
							<th colspan=2><?php echo $info?></td>
						</tr>
					</table>
				</div>
				<?php if($id == $leader){?>
				<a href=project_manage.php?index=<?php echo $index?>> <div id=left_project_manage></div> </a>
				<?php }?>
			</div>

		</div>

		<div id=right_menu>

			<?php
				make_processbar(56);
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