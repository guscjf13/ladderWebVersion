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

		<form id=error_info action="make_error_end.php" method="post" style="margin-top:30px">
		<table border="1" style="border-collapse: collapse">

			<tr>
				<th>
					<input id=title type=text placeholder="                                오류 제목" name=title style="width: 300px; height: 40px; float: left; margin-left: 30px;"> 
					<pre style="float: left; font-size: 15px;">  긴급사항 </pre>
					<input id=is_urgent type=checkbox value="긴급사항" name=is_urgent style="width: 50px; height: 40px; float:left;"> 
				</th>
			</tr>

			<tr>
				<th>
					<pre>     담당 파트   </pre>
					<select name=part style="width: 350px;">
						<option value="일감 1"> 일감 1 </option>
						<option value="일감 2"> 일감 2 </option>
						<option value="일감 3"> 일감 3 </option>
						<option value="일감 4"> 일감 4 </option>
					</select>
				</th>
			</tr>

			<tr>
				<th>
					발생: 
					<?php 
						$date=date('Y-m-d');
						echo($date) 
					?>   ~     
					마감:<input id=dateFinish type=date name=dateLast style="width: 130px; height: 30px; text-align:center; margin-left: 10px">
				</th>
			</tr>

			<tr>
				<th>
					<textarea id=explaination form=error_info placeholder=" 



			      오류 설명" name=explaination cols="65" rows="10"></textarea>
				</th>
			</tr>
		</table>
		<br>

		<input id=submit type=submit value="오류 등록" style="margin-bottom: 20px;">
		<input id=backBtn type=button Onclick="history.back();" value="뒤로 가기">
		<?php
			include "footer.php";
		?>
	</body>

</html>