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
<<<<<<< HEAD
		#message_logo {
			width: 180px;
			height: 80px;
			background-image: url('message_logo.png');
			background-size: cover;
			margin: 5px auto;
		}
		#sendBtn {
			margin: 20px 20px 20px 140px;
			width: 100px;
			height: 50px;
			border: 0;
			border-style: none;
			background-image: url('send_message_small.png');
			background-size: cover;
			float: left;
		}
		#sendBtn:hover {
			background-image: url('send_message_small_hover.png');
		}
		#backBtn {
			margin: 20px 20px;
			width: 100px;
			border: 0;
			border-style: none;
			height: 50px;
			float: left;
			background-image: url('back.png');
			background-size: cover;
		}
		#backBtn:hover {
			background-image: url('back_hover.png');
=======
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
>>>>>>> master
		}
		</style>
	</head>

	<body>

		<?php
			include "db.php";
			$index=$_REQUEST['index'];
			$id=$_SESSION['id'];
			$m_index=$_REQUEST['m_index'];
			$m_i=$_REQUEST['m_i'];
			$userid_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/userid";
			$userid=$firebase->get($userid_path);
			$userid = explode("\"",$userid)[1];
			
		?>

<<<<<<< HEAD
		<div id=message_logo>
		</div>

		<form id=message_form action="send_message_end.php" method="post">
			<table boder="0" style="margin: 0 auto; width: 350px; border-collapse: collapse;">
				<tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
					<th><h3>받는 사람</h3></th>
					<th>
						<input type=hidden id=mid name=mid value="<?php echo $userid?>"><?php echo $userid?>
					</th>
				</tr>
				<tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
					<th><h3>제목</h3></th>
					<th>
						<input id=mtitle name=mtitle type=text>
					</th>
				</tr>
				<tr style="height: 200px; border-bottom: 2px dotted #BDBDBD;">
					<th height="100"><h3>내용</h3></th>
					<th height="100">
						<textarea id=mcontent name=mcontent type=textarea rows=9 cols=20></textarea>
					</th>
				</tr>
			</table>

			<input type="hidden" name="m_index" value="<?php echo $m_index?>">
			<input type="hidden" name="index" value="<?php echo $index?>">

			<input id=sendBtn type=submit value="">
			<input id=backBtn type=button Onclick="history.back();">
=======
		<form id=message_form action="send_message_end.php" method="post">
		<table border="1">
		<tr>
			<th>받는 사람</th>
			<th>
				<input type=hidden id=mid name=mid value="<?php echo $userid?>"><?php echo $userid?>
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
		<input type="hidden" name="m_index" value="<?php echo $m_index?>">
		<input type="hidden" name="index" value="<?php echo $index?>">
		<input id=submit type=submit value="쪽지 보내기">
		<input type=button value="뒤로 가기" Onclick="history.back();">
>>>>>>> master
	</form>

<body>

</body>
</html>