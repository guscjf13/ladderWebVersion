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
			background-color: black;
			color: white;
			width: 200px;
			height: 40px;
			display: block;
			margin: 0 50px 0 725px;
			float: left;
		}
		#backBtn {
			background-color: black;
			color: white;
			width: 200px;
			height: 40px;
			line-height: 40px;
			margin: 0 auto;
			text-align: center;
			float: left;
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

		<img src=logo.png id="logo_center" style="width: 200px; height: auto; margin: 30px auto auto auto; padding: auto">

		<form action="make_project_end.php" method="post" style="margin-top:30px; margin-bottom: 115px;">
		<table border="1" style="border-collapse: collapse">

			<tr>
				<th>
					<input id=pname type=text placeholder=" 프로젝트 제목" name=pname> 
				</th>
			</tr>

			<tr>
				<th>
					<input id=goal type=text placeholder=" 목적" name=goal>
				</th>
			</tr>

			<tr>
				<th>
					<pre> 최대 팀원   </pre>
					<select name=maxPeople>
						<option value=1 selected> 1명 </option>
						<option value=2> 2명 </option>
						<option value=3> 3명 </option>
						<option value=4> 4명 </option>
						<option value=5> 5명 </option>
						<option value=6> 6명 </option>
						<option value=7> 7명 </option>
						<option value=8> 8명 </option>
						<option value=9> 9명 </option>
						<option value=10> 10명 </option>
						<option value="noLimit"> 제한없음 </option>
					</select>
				</th>
			</tr>

			<tr>
				<th>
					<input id=beginline type=date name=beginline style="width: 200px; text-align:center; margin-right: 10px">   ~  
					<input id=deadline type=date name=deadline style="width: 200px; text-align:center; margin-left: 10px">
				</th>
			</tr>

			<tr>
				<th>
					<input id=info type=textarea placeholder=" 프로젝트 설명" name=info  cols="50" rows="100">
				</th>
			</tr>
		</table>
		<br>
		<div id=buttons >
			<input id=submit type=submit value="프로젝트 생성">
			<!-- 프로젝트가 1개라도 있는 id면 main_joined.php로, 하나도 없는 id면 main_not_joined.php로 이동-->
			<a href=main_joined.php > <div id=backBtn> 뒤로 가기 </div> </a>
		</div>
	</form>

	
<?php
		include "footer.php";
	?>

	</body>
	
</html>