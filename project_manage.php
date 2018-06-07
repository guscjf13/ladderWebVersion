<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";
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

		</style>
	</head>

	<body>
		<?php include "top_menu.php";?>
		<h2>프로젝트 관리</h2>
		<?php
		$index = $_REQUEST['index'];
		$path = "/check/signup/".$index."/id/";
		$array = $firebase->get($path);
		$array = explode(",", $array);
		$i=0;
		?>
		<table border="1">
			<tr>
				<th>신청한 사람</th><td></td>
			</tr>
			<?php
				while($array[$i] != null){
					$sign_id = explode("\"",$array[$i])[1];
					$i++;
			?>
			<tr>
				<td><?php echo $sign_id;?></td><td><a href="signup_admit.php?index=<?php echo $index;?>&sign_id=<?php echo $sign_id;?>"><input type="button" name="승인" value="승인"></a></td>
			</tr>
			<?php }?>
		</table>
		<div>
			<h4>팀원 초대</h4>
			<form action="project_invite.php" method="post">
				<input id=invite type=text placeholder="초대할 아이디" name=invite_id>
				<input style="display: none;"id=index name=index value=<?php echo $index;?>>
				<input type="submit" name="초대" value="초대">
			</form>
			
		</div>
		


	</body>

<?php
	include "footer.php";
?>
</html>