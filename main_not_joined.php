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
		#logo_center {
		  display: table-cell;
		  vertical-align: middle;
		  text-align: center;
		}
		pre {
			margin: 0;
			font-size: 50px;
			text-align: center;
		}

		</style>
	</head>

	<body>

		<?php
			include "db.php";
			include "top_menu.php";
		?>

		<a href=project_board.php>
		<img src=logo.png id="logo_center" style="width: 600px; height: auto; margin: auto; padding: auto">
		</a>

		<pre style="color: #8C8C8C";> 참여중인 프로젝트가 없습니다. </pre>
	</body>
	<?php
        include "footer.php";
    ?>

</html>