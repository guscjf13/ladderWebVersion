<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		*   { font-family: 'Jeju Gothic', serif; }
			body {
				margin-bottom: 100px;
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
			select {
				width: 490px;
				height: 40px;
			}
			#logo {
				width: 800px; 
				height: 300px;
				display: block;
				margin: 0 auto;
				padding-top: 50px;
				padding-bottom: 20px;
				text-align: center;
			}
		</style>
	</head>

	<body>

	<div id=logo>
		<a href=login.html><img src=logo.png style="width: 30%; height: auto;" id="logo_img"></a>
	</div>

	<form action="log_in_make_end.php" method="post">
		<table border="1" style="border-collapse: collapse">

			<tr>
				<th>
					<input id=id type=text placeholder=" 아이디" name=ID> 
				</th>
			</tr>

			<tr>
				<th>
					<input id=password type=password placeholder=" 비밀번호 (영문,숫자조합 / 8자리이상)" name=password>
				</th>
			</tr>

			<tr>
				<th>
					<input id=password2 type=password placeholder=" 비밀번호 확인" name=password2>
				</th>
			</tr>

			<tr>
				<th>
					<input id=name type=text placeholder=" 이름" name=name>
				</th>
			</tr>

			<tr>
				<th>
					<select name=question>
						<option value="어릴적 별명은?"> 어릴적 별명은? </option>
						<option value="내 보물 1호는?"> 내 보물 1호는? </option>
						<option value="내 고향은?"> 내 고향은? </option>
						<option value="내가 졸업한 초등학교는?"> 내가 졸업한 초등학교는? </option>
					</select>
				</th>
			</tr>

			<tr>
				<th>
					<input id=answer type=text placeholder=" 답" name=answer>
				</th>
			</tr>
		</table>
		<br>
		<input id=submit type=submit value=회원가입>
	</form>

	</body>

</html>