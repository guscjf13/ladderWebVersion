<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		a {
			text-decoration: none;
			color: black;
		}

		/*top 메뉴 스타일들*/
		#top_menu {
			height:80px;
			background: #000000;
		}
		.top_sub {
			float:left;
			height:80px;
			line-height:80px;
			text-align: center;
			font-size:20px;
			margin-right: 30px;
			color: white;
		}
		#top_space {
			display: inline;
			width: 1300px;
			height: 80px;
		}

		/*왼쪽 메뉴 스타일들*/
		#left_menu {
			width: 300px;
			height: 850px;
			float:left;
		}
		#left_project_logo {
			width: 240px;
			height: 240px;
			margin: 30px;
			background-color: red;
		}
		#left_project_info {
			width: 240px;
			height: 530px;
			margin: 30px;
			background-color: black;
		}

		/*오른쪽 메뉴 스타일들*/
		#right_menu {
			width: 1580px;
			height: 850px;
			float:right;
		}
		#right_project_processbar {
			width: 1550px;
			height: 100px;
			background-color: blue;
			margin:25px 25px 25px 0;
		}
		#right_make_error {
			display: inline-block;
			width: 700px;
			height: 50px;
			background-color: black;
			line-height: 50px;
			text-align: center;
			margin-left: 440px;
		}
		#right_project_board {
			width: 1550px;
			height: 275px;
			background-color: green;
			margin:100px 25px 25px 0;
		}
		#message_board{
			margin: 50px;
		}
		.list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
  		.list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}

		</style>
</head>
<body>
		<?php
			include "db.php";
			include "top_menu.php";
		?>

		</div>
		<img src=logo.png id="logo_center" style="width: 300px; height: auto; margin: 30px auto auto auto; padding: auto">
			<table class="list-table">
				<thead>
					<tr>
						<th width="100">보낸 사람</th>
						<th width="100">제목</th>
						<th width="400">보낸 시각</th>
					</tr>
				</thead>
				<?php
					do{
						$i=1;
						$from_path="/users/".$_SESSION['id']."/message/".$i."/from";
						$title_path="/users/".$_SESSION['id']."/message/".$i."/title";
						$when_path="/users/".$_SESSION['id']."/message/".$i."/when";
						$from=$firebase->get($from_path);
						$title=$firebase->get($title_path);
						$when=$firebase->get($when_path);
				?>
				<tbody>
					<tr>
						<td width="100"><a href="message_content.php"><?php echo $from?></a></td>
						<td width="100"><?php echo $title?></td>
						<td width="400"><?php echo $when?></td>
					</tr>
				</tbody>
				<?php
					$i++;
					$m_path="/users/".$_SESSION['id']."/message/".$i;
					$m=$firebase->get($m_path);
					}while($m!="null");
				?>
				
			</table>
			<a href=send_message.php><input type="button" name="write_btn" value="쪽지 보내기"/></a>
</body>
</html>