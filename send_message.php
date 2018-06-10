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
			cursor: pointer;
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
			cursor: pointer;
		}
		</style>
	</head>

	<body>

		<?php
			include "db.php";
			$index=$_REQUEST['index'];
			$id=$_SESSION['id'];
			$m_index=$_REQUEST['m_index'];
		?>

		<div id=message_logo>
		</div>

		<form id=message_form action="send_message_end.php" method="post">
			<table boder="0" style="margin: 0 auto; width: 350px; border-collapse: collapse;">

				<tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
					<th><h3>받는 사람</h3></th>
					<th>
						<select id=mid name=mid>
							<?php
								$i=1;

								do{
									$rid_path="/project/".$index."/member/".$i."/id";
									$r_id=$firebase->get($rid_path);
									if("\"".$id."\""!=$r_id){
										$r = explode("\"",$r_id)[1];
										?><option value=<?php echo $r_id;?>><?php echo $r;?></option><?php 
									}
									$i++;
									$m_path="/project/".$index."/member/".$i;
									$m=$firebase->get($m_path);
								}while($m!="null");
							?>
						</select>
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
		</form>

	<body>

</body>
</html>