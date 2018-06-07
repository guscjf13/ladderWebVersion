<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		a {
			text-decoration: none;
			color: black;
		}
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
		#logo_center {
		  display: table-cell;
		  vertical-align: middle;
		  text-align: center;
		}
		table {
			margin: 0 auto;
		}
		th {
			width: 500px;
			height: 50px;
		}
		input {
			width: 490px;
			height: 40px;
		}
		#submit {
			display: block;
			margin: 0 auto;
		}
		pre {
			float: left;
		}
		select {
			width: 400px;
			height: 40px;
			float: left;
		}
		</style>
	</head>

	<body>

		<?php
			include "db.php";
			include "top_menu.php";
		?>

		<img src=logo.png id="logo_center" style="width: 300px; height: auto; margin: 30px auto auto auto; padding: auto">
		<form id=message_form action="send_message_end.php" method="post">
		<table border="1">
		<tr>
			<th>받는 사람</th>
			<th>
				<input id=mid name=mid type=text>
			</th>
		</tr>
		<tr>
			<th>제목</th>
			<th>
				<input id=mtitle name=mtitle type=text>
			</th>
		</tr>
		<tr height="100">
			<th height="100">내용</th>
			<th height="100">
				<input id=mcontent name=mcontent type=text>
			</th>
		</tr>
		</table>
		<input id=submit type=submit value="쪽지 보내기">
	</form>

<body>

</body>
</html>