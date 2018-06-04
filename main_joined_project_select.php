<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
	</head>

	<body>

		<?php
			include "top_menu.php";
			include "db.php";
		?>

		여기서 넘겨받은 project제목을 이용해서 main_joined.php로 다시 넘겨주기

	</body>

</html>